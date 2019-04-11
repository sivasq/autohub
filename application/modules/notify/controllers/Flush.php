<?php
//-----------Method 1----------------//
// ob_end_clean();
// header("Connection: close");
// ignore_user_abort(); // optional
// ob_start();
// echo ('Text the user will see');
// $size = ob_get_length();
// header("Content-Length: $size");
// ob_end_flush(); // Strange behaviour, will not work
// flush();            // Unless both are called !
// session_write_close(); // Added a line suggested in the comment
// // Do processing here 
// echo ('Text user will never see');

// $myFile = "demo.txt";
// $message = "welcome message";
// if (file_exists($myFile)) {
//     $fh = fopen($myFile, 'a');
//     fwrite($fh, $message . "\n");
// } else {
//     $fh = fopen($myFile, 'w');
//     fwrite($fh, $message . "\n");
// }
// fclose($fh);


//-----------Method 2----------------//
$body = "testing";
$responseCode = 200;

// Cause we are clever and don't want the rest of the script to be bound by a timeout.
// Set to zero so no time limit is imposed from here on out.
set_time_limit(0);

// Client disconnect should NOT abort our script execution
ignore_user_abort(true);

// Clean (erase) the output buffer and turn off output buffering
// in case there was anything up in there to begin with.
ob_end_clean();

// Turn on output buffering, because ... we just turned it off ...
// if it was on.
ob_start();

echo $body;

// Return the length of the output buffer
$size = ob_get_length();

// send headers to tell the browser to close the connection
// remember, the headers must be called prior to any actual
// input being sent via our flush(es) below.
header("Connection: close\r\n");
header("Content-Encoding: none\r\n");
header("Content-Length: $size");
// Set the HTTP response code
// this is only available in PHP 5.4.0 or greater
http_response_code($responseCode);
// Flush (send) the output buffer and turn off output buffering
ob_end_flush();
// Flush (send) the output buffer
// This looks like overkill, but trust me. I know, you really don't need this
// unless you do need it, in which case, you will be glad you had it!
@ob_flush();
// Flush system output buffer
// I know, more over kill looking stuff, but this
// Flushes the system write buffers of PHP and whatever backend PHP is using
// (CGI, a web server, etc). This attempts to push current output all the way
// to the browser with a few caveats.
flush();

$myFile = "demo.txt";
$message = "welcome weee";
if (file_exists($myFile)) {
    $fh = fopen($myFile, 'a');
    fwrite($fh, $message . "\n");
} else {
    $fh = fopen($myFile, 'w');
    fwrite($fh, $message . "\n");
}
fclose($fh);
