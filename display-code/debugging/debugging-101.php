// Capture output instead of printing it
ob_start( );
// Call var_dump( ) as usual
var_dump($_POST);
// Store in $output the output generated since calling ob_start( )
$output = ob_get_contents( );
// Go back to regular printing of output
ob_end_clean( );
// Send $output to the error log
error_log($output);