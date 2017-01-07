Learning PHP
==========

## What Is This?

This is the example code that from [Learning PHP](http://shop.oreilly.com/product/0636920043034.do) by David Sklar.

See an error? Report it [here](http://oreilly.com/catalog/errata.csp?isbn=0636920043034), or simply fork and send us a pull request.

If you want a copy of all of the example code snippets in this repo, click the Download Zip button to the right to download everything.

## How do I use this code?

Each subdirectory in the `display-code` directory corresponds to one chapter of the book. Each chapter directory has a `toc.txt` file that lists the files in the directory in the order they appear in the book. The first column in `toc.txt` lists the example number of the piece of code (if any). The second column is the filename. For example, net/toc.txt begins as follows:

    1	fgc-get.php
    -	fgc-get.out
    2	fgc-query-params.php
    -	fgc-query-params.out

This means that the contents of Example 11-1 are in `net/fgc-get.php`. The next code excerpt that appears in the book isn't PHP code, but showing the output of a program. That's in `net/fgc-get.out`. Then comes Example 11-2, whose contents you can find in `net/fgc-query-params.php`, and then what's in `net/fgc-query-params.out`.

The files under `display-code` are useful because they mirror exactly what appears in the book but they are not directly runnable for a number of reasons -- most don't include `<?php` PHP start tags and lots of them depend on other files that contain necessary code to be included.

The `code` directory provides runnable versions of each code snippet. It is organized the same way (with the same `toc.txt` files). The `runner.php` program runs one or more code examples. runner.php --help tells you how to use it:

```
runner.php [--chapter=CHAPTER] [--code=CODE] [--bare] [--fail-first] [--ignore-net-fail] [--cli=CLI]

Runs one or more code examples and reports on success/failure.

  --chapter=CHAPTER     Run code examples from chapter CHAPTER
  --code=CODE           Run code example CODE
  --cli=CLI             Use PHP binary installed at CLI
  --bare                Just run the code, don't report on success/failure
  --fail-first          Exit after first code failure
  --ignore-net-fail     Ignore failures that seem to be from a lack of network

PHP binary configured to run code examples:
   /usr/local/bin/php

--chapter and --code and each be specified more than once.

CHAPTER and CODE are interpreted as shell globs.

CHAPTER should just be the name of a chapter file without
extension, e.g. "datetime".

CODE should be the name of a chapter code directory, then /,
then the basename of the code example, e.g. "datetime/interval"
```
## Preconditions

### Install software

In order to run the examples you'll need
* [PHP](http://php.net/downloads.php) - with certain extensions enabled and XML support (e.g. php7.0-xml on linux-based systems)
* [Composer](https://getcomposer.org/download/) - a dependency management tool for PHP
installed on your local system.

In order to verify things are working fine, issue the commands and check their output respectively:
```
# This is example output on a linux-based system:

$ php composer.phar 
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 1.3.1 2017-01-07 18:08:51
.....

$ php -v
PHP 7.0.8-0ubuntu0.16.04.3 (cli) ( NTS )
Copyright (c) 1997-2016 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2016 Zend Technologies
    with Zend OPcache v7.0.8-0ubuntu0.16.04.3, Copyright (c) 1999-2016, by Zend Technologies
...
```

### Download dependencies

In order to fully start the examples, you need to download all dependencies with the help of composer:
```
$ ./composer.phar install
Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 2 installs, 0 updates, 0 removals
  - Installing jakub-onderka/php-console-color (0.1) Downloading: 100%         
  - Installing sebastian/diff (1.3.0) Downloading: 100%         
Generating autoload files
```

To download all dependencies necessary issue:
```
$ cd code
$ $ ../composer.phar install
Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 26 installs, 0 updates, 0 removals
  - Installing jakub-onderka/php-console-color (0.1) Loading from cache
  - Installing phpdocumentor/reflection-docblock (2.0.4) Downloading: 100%         
  - Installing phpunit/php-token-stream (1.4.8) Downloading: 100%         
  - Installing symfony/yaml (v2.7.5) Downloading: 100%         
  - Installing sebastian/version (1.0.6) Downloading: 100%         
  - Installing sebastian/global-state (1.1.0) Downloading: 100%         
  - Installing sebastian/recursion-context (1.0.1) Downloading: 100%         
  - Installing sebastian/exporter (1.2.1) Downloading: 100%         
  - Installing sebastian/environment (1.3.2) Downloading: 100%         
  - Installing sebastian/diff (1.3.0) Loading from cache
  - Installing sebastian/comparator (1.2.0) Downloading: 100%         
  - Installing phpunit/php-text-template (1.2.1) Downloading: 100%         
  - Installing doctrine/instantiator (1.0.5) Downloading: 100%         
  - Installing phpunit/phpunit-mock-objects (2.3.8) Downloading: 100%         
  - Installing phpunit/php-timer (1.0.7) Downloading: 100%         
  - Installing phpunit/php-file-iterator (1.4.1) Downloading: 100%         
  - Installing phpunit/php-code-coverage (2.2.4) Downloading: 100%         
  - Installing phpspec/prophecy (v1.5.0) Downloading: 100%         
  - Installing phpunit/phpunit (4.8.11) Downloading: 100%         
  - Installing symfony/var-dumper (v2.7.5) Downloading: 100%         
  - Installing symfony/console (v2.7.5) Downloading: 100%         
  - Installing nikic/php-parser (v1.4.1) Downloading: 100%         
  - Installing jakub-onderka/php-console-highlighter (v0.3.2) Downloading: 100%         
  - Installing dnoegel/php-xdg-base-dir (0.1) Downloading: 100%         
  - Installing psy/psysh (v0.5.2) Downloading: 100%         
  - Installing swiftmailer/swiftmailer (v5.4.1) Downloading: 100%         
phpdocumentor/reflection-docblock suggests installing dflydev/markdown (~1.0)
phpdocumentor/reflection-docblock suggests installing erusev/parsedown (~1.0)
sebastian/global-state suggests installing ext-uopz (*)
phpunit/phpunit-mock-objects suggests installing ext-soap (*)
phpunit/php-code-coverage suggests installing ext-xdebug (>=2.2.1)
phpunit/phpunit suggests installing phpunit/php-invoker (~1.1)
symfony/var-dumper suggests installing ext-symfony_debug ()
symfony/console suggests installing psr/log (For using the console logger)
symfony/console suggests installing symfony/event-dispatcher ()
symfony/console suggests installing symfony/process ()
psy/psysh suggests installing ext-pdo-sqlite (The doc command requires SQLite to work.)
Generating autoload files
```
before running any examples with the help of `runner.php`

### Verify your setup

If all dependencies are met, feel free to use one example:
```
$ ./runner.php --code=datetime/interval
  OK: datetime/interval
```

## Working with the examples

For example, you can try `runner.php --code=datetime/interval` or `runner.php --chapter=datetime`. `runner.php` depends on a few things installable by Composer. Run `composer install` from the same directory that `runner.php` is in to install them. A lot of the code examples depend on other things installed by Composer as well. Run `composer install` from the `code` subdirectory to install them.

Normally, `runner.php` runs a code snippet and checks that it emitted the correct output (or the expected errors, if the code snippet is illustrating some error scenario). `runner.php` employs a number of auxiliary files to determine the expected output or errors and settings to use when running the code.

For a given code example in, say, `code/some-chapter/some-code.php`, the following additional files control the behavior of `runner.php`:


#### Files that control expected output or error output
| File | Purpose
| --- | ---
| `code/some-chapter/some-code.out` | expected output from running the code
| `code/some-chapter/some-code.err` | expected error output from running the code
| `code/some-chapter/some-code.out.regex` | a regular expression that is expected to match the output from running the code
| `code/some-chapter/some-code.err.regex` | a regular expression that is expected to match the error output from running the code
| `code/some-chapter/some-code.out.strip` | remove all newlines from `some-code.out` before considering it as expected output

#### Files that control settings that are active when running the code
| File | Purpose
| --- | ---
| `code/some-chapter/some-code.prepend.php` | `auto_prepend_file` to use when running the code
| `code/some-chapter/some-code.append.php` | `auto_append_file` to use when running the code
| `code/some-chapter/some-code.stdin` | data to pass on standard input to the running code
| `code/some-chapter/some-code.args` | commandline args (one per line) to provide to php when running the code
| `code/some-chapter/some-code.faketime` | use libfaketime to set the time to the timespec in this file when running the code

#### Other files that do things
| File | Purpose
| --- | ---
| `code/some-chapter/some-code.server` | start a PHP server listening on port 7000 running the code in this file before running the code
| `code/some-chapter/some-code.server.ini` | key=value configuration directive settings, one per line, to use when running the server
| `code/some-chapter/some-code.skip` |      don't actually execute the code, just check its syntax

`*.out` and `*.err` can also contain a few special things to make matching expected output easier. The string `{{*}}` in `*.out` or `*.err` matches the full path to the executing code file. The string `{{d}}` matches the directory of the executing code file (with a trailing `/`). The string `{{!}}` matches any path starting with `/.`

If you want `runner.php` to run a piece of code and not check the expected output/errors, provide the `--bare` commandline argument. That still uses the various files to set ini values, args, and so forth, but then just outputs anything the code snippet does instead of checking to see if it matches expected values.

##### Special Things to Note About Running Code Snippets

Some the code snippets in the `datetime` directory use [libfaketime](https://github.com/wolfcw/libfaketime) and `.faketime` files to specify that the system time should be a certain value when running the code snippet. This makes for predictable output that can be checked. If you want this to work, install libfaketime. If libfaketime is not present, `runner.php` will just skip the snippets that require it.

Some of the code snippets in the `net` directory use `php7.example.com` as a hostname for a server to connect to. This is not a real, functioning server name. The "server" in question is another script started by `runner.php` because of a `*.server` files. To make these code snippets function properly, you need to tell your computer to map the hostname `php7.example.com` to your computer. One way to do this is to add a line such as the following to your `/etc/hosts` file:

```
127.0.0.1	localhost  php7.example.com
```
