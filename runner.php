#!/usr/bin/env php
<?php

define('CODE_BASE', __DIR__ . '/code');
if (! is_readable(__DIR__ . '/vendor/autoload.php')) {
    die("No vendor/autoload.php -- perhaps you haven't run 'composer install' yet?\n");
}
if (! is_readable(__DIR__ . '/code/vendor/autoload.php')) {
    die("No code/vendor/autoload.php -- perhaps you haven't run 'cd code && composer install' yet?\n");
}
require __DIR__ . '/vendor/autoload.php';

// Parse commandline options
$options = getopt("", array("chapter::", "code::", "cli:", "bare", "help","fail-first","ignore-net-fail"));

// Set up paths to external programs relied upon
define('FAKETIME', trim(shell_exec("which faketime")));
define('CLI', isset($options['cli']) ? $options['cli'] : trim(shell_exec('which php')));

// Provide help if asked
if (isset($options['help'])) {
    usage();
}

// Figure out which code examples to run
$chapters = chapter_arg_to_chapters($options, 'chapter');
$codes = code_arg_to_codes($options, 'code');

if ((count($chapters) + count($codes)) == 0) {
    usage("No valid chapters or code examples specified.");
}

// Make sure we can execute PHP
if (! is_executable(CLI)) {
    usage("Can't execute PHP interpreter at " . CLI);
}

// These will report differences between actual and expected output
$differs['out'] = make_differ('out');
$differs['err'] = make_differ('err');

// Run all the code examples specified by chapter
foreach ($chapters as $chapter) {
    $files = glob(build_path($chapter, "*", "php"));
    natsort($files);
    foreach ($files as $file) {
        $basename = basename($file, ".php");
        if (! preg_match('/\.(helper|prepend|append)$/', $basename)) {
            try_and_report($options, $differs, $chapter, $basename);
        }
    }
}

// Run all the code examples specified by code example
foreach ($codes as $chapterAndCode) {
    try_and_report($options, $differs, $chapterAndCode[0], $chapterAndCode[1]);
}

// Try one code example and report on its success or failure if desired
function try_and_report($options, $differs, $chapter, $base) {
    $colors = new JakubOnderka\PhpConsoleColor\ConsoleColor;
    $diff = array();
    $ok = try_code($options, $differs, $chapter, $base, $diff);
    if (isset($options['bare'])) {
        return;
    }
    if ($ok === TRUE) {
        print $colors->apply('green','  OK');
        printf(": %s/%s\n", $chapter, $base);
    }
    else if ($ok === FALSE) {
        print $colors->apply('red','FAIL');
        printf(": %s/%s\n", $chapter, $base);
        foreach (array('out','err') as $ext) {
            if ($diff[$ext]) {
                $indented = implode("\n", array_map("indent", explode("\n", $diff[$ext])));
                print $indented;
                print "\n";
            }
        }
        if (isset($options['fail-first'])) {
            exit(-1);
        }
    }
    else {
        print $colors->apply('yellow', 'SKIP');
        printf(": %s/%s\n", $chapter, $base);
    }
}

// Run one code example, taking into account various options set by
// related files and report on its success as well as actual and
// expected output and error output
function try_code($options, $differs, $chapter, $base, &$diff) {
    $exts = array('out', 'err');
    $diff = array();
    $expected = array();
    foreach ($exts as $ext) { $diff[$ext] = ''; }

    $code = build_readable_path($chapter, $base, 'php');
    if (! $code) {
        return false;
    }

    $expected = array();
    $forced_skip = false;
    $all_cmd = [];
    $client_cmd = [];

    // *.skip file means "check syntax only"
    if (build_readable_path($chapter, $base, 'skip')) {
        $client_cmd[] = '-l';
        $expected['out'] = "No syntax errors detected in $code\n";
    }
    else {
        if (! isset($options['bare'])) {
            foreach ($exts as $ext) {
                if ($p = build_readable_path($chapter, $base, "$ext.regex")) {
                    $expected["$ext.regex"] = file_get_contents($p);
                }
                else if ($p = build_readable_path($chapter, $base, $ext)) {
                    $expected[$ext] = file_get_contents($p);
                }
                else {
                    $expected[$ext] = '';
                }
            }
            if (build_readable_path($chapter, $base, 'out.strip')) {
                $expected['out'] = str_replace(PHP_EOL, '', $expected['out']);
            }
        }
    }


    if ($p = build_readable_path($chapter, $base, 'faketime')) {
        if (is_executable(FAKETIME)) {
            $all_cmd[] = FAKETIME;
            $all_cmd[] = '-f';
            $all_cmd[] = trim(file_get_contents($p));
        } else {
            $forced_skip = true;
        }
    }

    $all_cmd[] = CLI;
    $all_cmd[] = '-d';
    $all_cmd[] = 'log_errors=on';
    $all_cmd[] = '-d';
    $all_cmd[] = 'error_reporting=2147483647';

    // If xdebug is installed, turn off stack-trace-on-error
    $client_cmd[] = '-d';
    $client_cmd[] = 'xdebug.default_enable=0';

    // auto-prepend and auto-append files, if available
    foreach (array('prepend', 'append') as $pend) {
        if ($p = build_readable_path($chapter, $base, "$pend.php")) {
            $client_cmd[] = '-d';
            $client_cmd[] = "auto_{$pend}_file=$p";
        }
    }

    // Extra .ini args
    $client_cmd = array_merge($client_cmd,
                              ini_from_file(build_path($chapter, $base, "ini")));

    // The code file to run
    $client_cmd[] = $code;

    // Any extra args if available
    if ($p = build_readable_path($chapter, $base, 'args')) {
        $client_cmd = array_merge($client_cmd,
                                  nonblank_lines_from_file($p));
    }

    if ($p = build_readable_path($chapter, $base, 'stdin')) {
        $stdin = array('file', $p, 'r');
        $stdin_bare = " < $p";
    } else {
        $stdin = array('pipe', 'r');
        $stdin_bare = '';
    }

    if (! $forced_skip) {
        $cmd_parts = array_merge($all_cmd, $client_cmd);
        if (isset($options['bare'])) {
            $ok = try_bare($code, array_merge($cmd_parts, [$stdin_bare]));
        } else {
            /** Request mode for things that need to be via a request/response
             * cycle
             */
            list($server, $server_pipes) = start_server_if_necessary($chapter, $base, $all_cmd);
            if ($server === false) {
                $diff['out'] = "Can't start server $p";
                return false;
            }

            $pipes = array();
            $p = proc_open(make_command_from_parts($cmd_parts),
                           array($stdin,
                                 array('pipe','w'),
                                 array('pipe','w')),
                           $pipes, dirname($code));

            if (is_resource($p)) {
                $actual = array();
                foreach ($exts as $ext) { $actual[$ext] = ""; }
                list($actual['out'], $actual['err']) = run_til_done($p, $pipes);
                $ok = true;
                stop_server_if_necessary($server, $server_pipes);

                // Check all the possibilities for how expected output
                // or errors are expressed
                foreach (array_keys($expected) as $ext) {
                    if (substr($ext, -6) == '.regex') {
                        $type = substr($ext, 0, -6);
                        $ok = check_regex_diff($expected[$ext], $actual[$type],
                                               $type, $diff);
                    }
                    else {
                        // Code filename
                        $expected[$ext] = str_replace('{{*}}', $code, $expected[$ext]);
                        // Code directory
                        $expected[$ext] = str_replace('{{d}}', dirname($code) .'/', $expected[$ext]);
                        // Arbitrary paths
                        if (strpos($expected[$ext], '{{!}}') !== false) {
                            $parts = array_map(function($s) { return preg_quote($s,'/'); }, preg_split('/\{\{!\}\}/', $expected[$ext]));
                            // Other filenames
                            $pattern = '/' . implode('\/\S+', $parts) . '/s';
                            $ok = check_regex_diff($pattern, $actual[$ext],
                                                   $ext, $diff);
                        } else {
                            if ($actual[$ext] !== $expected[$ext]) {
                                $diff[$ext] = $differs[$ext]->diff($expected[$ext], $actual[$ext]);
                                $ok = false;
                            }
                        }
                    }
                }
            }
            // If proc_open() couldn't execute the PHP then it's
            // a failure
            else {
                $ok = false;
            }
        }
        if (($ok == false) && is_skippable_network_failure($options,$actual)) {
            $ok = null; // skip
        }
    } else {
        $ok = null; // skip if forced skip
    }

    return $ok;
}

function arg_to_array($args, $index) {
    if (isset($args[$index])) {
        if (is_string($args[$index])) {
            return array($args[$index]);
        } else if (is_array($args[$index]) && count($args[$index])) {
            return $args[$index];
        }
    }
    return array();
}

function chapter_arg_to_chapters($args, $index) {
    // Map chapter names to path names
    $chapters = array();
    foreach (arg_to_array($args, $index) as $chapter) {
        foreach (glob(CODE_BASE . '/' . $chapter) as $c) {
            if (is_dir($c)) {
                $chapters[] = basename($c);
            }
        }
    }
    return $chapters;
}

function code_arg_to_codes($args, $index) {
    // Map code sample names to dir + path
    $codes = array();
    foreach (arg_to_array($args, $index) as $code) {
        foreach (glob(CODE_BASE . '/' . $code . '.php') as $file) {
            $codes[] = array(basename(dirname($file)), basename($file, ".php"));
        }
    }
    return $codes;
}

function build_path($chapter, $base, $ext) {
    return CODE_BASE . "/$chapter/$base.$ext";
}

function build_readable_path($chapter, $base, $ext) {
    if (is_readable($p = build_path($chapter, $base, $ext))) {
        return $p;
    }
    else {
        return NULL;
    }
}

function usage($err = null) {
    $cli = CLI;
    $exitCode = 0;
    if (! is_null($err)) {
        print "Error: $err\n\n";
        $exitCode = -1;
    }
    print<<<_USAGE_
{$_SERVER['SCRIPT_NAME']} [--chapter=CHAPTER] [--code=CODE] [--bare] [--fail-first] [--ignore-net-fail] [--cli=CLI]

Runs one or more code examples and reports on success/failure.

  --chapter=CHAPTER     Run code examples from chapter CHAPTER
  --code=CODE           Run code example CODE
  --cli=CLI             Use PHP binary installed at CLI
  --bare                Just run the code, don't report on success/failure
  --fail-first          Exit after first code failure
  --ignore-net-fail     Ignore failures that seem to be from a lack of network

PHP binary configured to run code examples:
   $cli

--chapter and --code and each be specified more than once.

CHAPTER and CODE are interpreted as shell globs.

CHAPTER should just be the name of a chapter file without
extension, e.g. "datetime".

CODE should be the name of a chapter code directory, then /,
then the basename of the code example, e.g. "datetime/interval"

_USAGE_;
    exit($exitCode);
}

function try_bare($code, $command_parts) {
    $cwd = getcwd();
    chdir(dirname($code));
    print shell_exec(make_command_from_parts($command_parts));
    chdir($cwd);
    return true;
}

function start_server_if_necessary($chapter, $base, $command_parts) {
    $server = null;
    $server_pipes = array();
    if (is_readable($p = build_path($chapter, $base, 'server'))) {
        $command_parts = ini_from_file(build_path($chapter, $base, 'server.ini'));
        $command_parts[] = "-S";
        $command_parts[] = "localhost:7000";
        $command_parts[] = $p;
        $server_command = make_command_from_parts($command_parts);
        $server = proc_open($server_command, array(array('pipe','r'),
                                                   array('pipe','w'),
                                                   array('pipe','w')),
                            $server_pipes, CODE_BASE);
        if (! is_resource($server)) {
            $server = false;
        }
    }
    return array($server, $server_pipes);
}

function run_til_done($p, $pipes) {
    $out = $err = '';
    do {
        $out .= stream_get_contents($pipes[1]);
        $err .= stream_get_contents($pipes[2]);
        $status = proc_get_status($p);
    } while ($status['running'] === TRUE);

    return [$out, $err];
}

function stop_server_if_necessary($server, $server_pipes) {
    if ($server) {
        // from comment on http://www.php.net/manual/en/function.proc-terminate.php
        $status = proc_get_status($server);
        if ($status['running'] == true) {
            fclose($server_pipes[0]);
            fclose($server_pipes[1]);
            fclose($server_pipes[2]);
            $ppid = $status['pid'];
            //use pgrep to get all the children of this process, and kill them, since that works the same on bsd and linux
            $pids = preg_split('/\s+/', `pgrep -P $ppid`);
            foreach($pids as $pid) {
                if(is_numeric($pid)) {
                    posix_kill($pid, 9); // 9 is the SIGKILL signal
                }
            }
            posix_kill($ppid,9);
            proc_close($server);
        }
    }
}

function is_skippable_network_failure($options, $actual) {
    return  isset($options['ignore-net-fail']) &&
        ((false !== strpos($actual['err'], 'php_network_getaddresses: getaddrinfo failed: nodename nor servname provided, or not known'))||
         (false !== strpos($actual['out'], 'cUrl error: Could not resolve host:')));
}


function indent($line, $count = 5) {
    return str_repeat(' ', $count) . $line;
}


function ini_from_file($f) {
    $args = [];
    if (is_readable($f)) {
        foreach (nonblank_lines_from_file($f) as $arg) {
            $args[] = '-d';
            $args[] = $arg;
        }
    }
    return $args;
}

function nonblank_lines_from_file($file) {
    return array_filter(array_map('trim', file($file)), 'strlen');
}

function make_command_from_parts($parts) {
    return implode(' ', array_map('escapeshellarg', $parts));
}

function check_regex_diff($expected, $actual, $type, &$diff) {
    if (! preg_match($expected, $actual)) {
        $diff[$type] = <<<_DIFF_
--- Expected pattern:
{$expected}
+++ Actual $type:
{$actual}
_DIFF_;
        return false;
    }
    else {
        return true;
    }
}

function make_differ($ext) {
    return new SebastianBergmann\Diff\Differ("--- Expected $ext\n+++ Actual $ext\n");
}
