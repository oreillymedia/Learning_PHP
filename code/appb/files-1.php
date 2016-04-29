<?php

$now = new DateTime();
// Express the vars as simply as possible, just key => value
$vars = array('title' => 'Man Bites Dog',
              'headline' => 'Man and Dog Trapped in Biting Fiasco',
              'byline' => 'Ireneo Funes',
              'article' => <<<_HTML_
<p>While walking in the park today, Bioy Casares took a big juicy
bite out of his dog, Santa's Little Helper. When asked why he did
it, Mr. Casares said, "I was hungry."</p>
_HTML_
              ,
              'date' => $now->format('l, F j, Y'));

// Make a version of $vars to match the templating syntax, with
// {} around the keys
$template_vars = array();
foreach ($vars as $k => $v) {
    $template_vars['{'.$k.'}'] = $v;
}
// Load the template
$template = file_get_contents('template.html');
if ($template === false) {
    die("Can't read template.html: $php_errormsg");
}
// If given an array of strings to look for and an array of replacements,
// str_replace() does all the replacements at once for you
$html = str_replace(array_keys($template_vars),
                    array_values($template_vars),
                    $template);
// Write out the new HTML page
$result = file_put_contents('article.html', $html);
if ($result === false) {
    die("Can't write article.html: $php_errormsg");
}