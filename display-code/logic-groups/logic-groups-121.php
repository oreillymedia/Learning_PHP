// One optional argument: it must be last
function page_header5($color, $title, $header = 'Welcome') {
    print '<html><head><title>Welcome to ' . $title . '</title></head>';
    print '<body bgcolor="#' . $color . '">';
    print "<h1>$header</h1>";
}
// Acceptable ways to call this function:
page_header5('66cc99','my wonderful page'); // uses default $header
page_header5('66cc99','my wonderful page','This page is great!'); // no defaults

// Two optional arguments: must be last two arguments
function page_header6($color, $title = 'the page', $header = 'Welcome') {
    print '<html><head><title>Welcome to ' . $title . '</title></head>';
    print '<body bgcolor="#' . $color . '">';
    print "<h1>$header</h1>";
}
// Acceptable ways to call this function:
page_header6('66cc99'); // uses default $title and $header
page_header6('66cc99','my wonderful page'); // uses default $header
page_header6('66cc99','my wonderful page','This page is great!'); // no defaults


// All optional arguments
function page_header7($color = '336699', $title = 'the page', $header = 'Welcome') {
    print '<html><head><title>Welcome to ' . $title . '</title></head>';
    print '<body bgcolor="#' . $color . '">';
    print "<h1>$header</h1>";
}
// Acceptable ways to call this function:
page_header7( ); // uses all defaults
page_header7('66cc99'); // uses default $title and $header
page_header7('66cc99','my wonderful page'); // uses default $header
page_header7('66cc99','my wonderful page','This page is great!'); // no defaults