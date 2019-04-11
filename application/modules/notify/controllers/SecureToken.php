<?php
/*
 * A simple method for communicating key->data sets accross
 * requests/machines along with some meta-data regarding
 * lifetime of the data as well as owner.
 * 
 * For example, assume a token is emailed to individuals that 
 * allow them to access some particular data/functionality
 * for a specific period of time. By providing a URL for them
 * to click that has the token embedded, you can verify the data
 * when they do attempt to access it without much fear that
 * the url will be manipulated.
 * 
 * The same scenario could be used across services/servers. One might
 * provide access, and ownership of the valid token allows access on
 * the other.
 * 
 */
//------------------- BEGIN Example Command Line Script --------------------
$myLabel = "TestLabel";
$myData = "Some really cool test data!";
$myKey = "My Secret Key Is Cool!";
$myGlue = ":myglue:";
$myLifetime = "60";
$myOwner = "Me!";
$thisEncodedToken = generateToken($myLabel, $myData, $myKey, $myGlue, $myLifetime, $myOwner);
$thisDecodedToken = NULL;
if (verifyToken($thisEncodedToken, $myLabel, $myKey, $myGlue, $myOwner, $thisDecodedToken)) {
    print_r($thisDecodedToken);
} else {
    print "The Token was not verified.";
}
exit();
//------------------- END Example Command Line Script --------------------
/**
 * 
 * Used to generate a secure, expiring token.
 * 
 * @param string  $label  The label for this token. Some might call it a key
 *                        but we have a key for encryption.
 * @param string  $data	  The data we are transfering.
 * @param string  $key	  The encryption key to use. This will be needed
 *                        when decoding the token as well.
 * @param string  $glue	  The glue used to tie all this together. This will be needed
 *                        when decoding the token as well. Important that it be a string
 *                        that is not natively found in any other fields.
 * @param integer $lifetimeInterval  How long this token is valid. In Seconds.
 * @param string  $owner  The host this token belongs to.
 */
function generateToken(
    $label,
    $data = NULL,
    $key = 'secretword',
    $glue = ';',
    $lifetimeInterval = 0,
    $owner = NULL
) {
    // Make sure we have what we need.
    verifyFunctionality();

    // If we didn't get a custom host passed in
    if (is_null($owner)) {
        // Lets use this
        $owner = $_SERVER['SERVER_NAME'];
    }

    // Create the payload. 
    $payloadData = array();

    // Gets now() and maintains TimeZone information
    $expires = new DateTime();

    // Default expires immediately / prevents HaX0rs making their own.
    $intervalInSeconds = $lifetimeInterval;

    // Set expiration time 
    $expires->add(new DateInterval('PT' . $intervalInSeconds . 'S')); // adds seconds

    // Populate Payload                
    $payloadData[0] = serialize($expires); // Expiration
    $payloadData[1] = $owner; // Host this Token Belongs to
    $payloadData[2] = $label; // Token Label
    $payloadData[3] = $data; // Arbitraty Token Data

    // Convert the payload to a string
    $payload = implode($glue, $payloadData);

    //Encrypt and Base64 Encode the payload into a Token
    $token = base64_encode(mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        md5($key),
        $payload,
        MCRYPT_MODE_CBC,
        md5(md5($key))
    ));

    return $token;
}
/**
 * 
 * Used to verify a valid token:
 * 1) It has not expired.
 * 2) It is the type (label) of token expected.
 * 3) It belongs to the wwwHost expected.
 * 
 * @param string  $label  The label for this token. Some might call it a key
 *                        but we have a key for encryption.
 * @param string  $data	  The data we are transfering.
 * @param string  $key    The encryption key to use. This will be needed
 *                        when decoding the token as well.
 * @param string  $glue	  The glue used to tie all this together. This will be needed
 *                        when decoding the token as well.
 * @param integer $lifetimeInterval  How long this token is valid.
 * @param string  $owner  The host this token belongs to.
 * @param array   $payloadData If passed in, this will hold a reference to decoded data.
 */
function verifyToken(
    $token,
    $label,
    $key = 'secretword',
    $glue = ';',
    $owner = NULL,
    &$payloadData = NULL
) {
    // If we didn't get a custom host passed in
    if (is_null($owner)) {
        // Lets use this
        $owner = $_SERVER['SERVER_NAME'];
    }

    // Decode the token
    $payloadData = decodeToken($token, $key, $glue);

    // Verify that:
    // 1) the token has not expired
    // 2) it is for the correct website
    // 3) it is the correct token
    if (
        $payloadData['expiration'] > new DateTime() &&
        $payloadData['owner'] == $owner &&
        $label == $payloadData['label']
    ) {
        return true;
    }
    return false;
}
/**
 * 
 * Used to return an array with the decoded data from the token
 * 
 * @param string  $token  The Token to decode.
 * @param string  $key	  The encryption key to use. Must match the encoding key.
 * @param string  $glue	  The glue used to tie all this together.  Must match the encoding glue.
 */
function decodeToken($token, $key = 'secretword', $glue = ';')
{
    // Make sure we have what we need.
    verifyFunctionality();
    // Base64 decode, then decrypt the token into a string
    $payload = rtrim(mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        md5($key),
        base64_decode($token),
        MCRYPT_MODE_CBC,
        md5(md5($key))
    ), "\0");

    // Convert the string to an array
    $payloadData = explode($glue, $payload);

    // Instanstiate an Expiration DateTime object
    $payloadData[0] = unserialize($payloadData[0]);

    $payloadData['expiration'] = $payloadData[0];
    $payloadData['owner'] = $payloadData[1];
    $payloadData['label'] = $payloadData[2];
    $payloadData['data'] = $payloadData[3];

    return $payloadData;
}
function verifyFunctionality()
{
    if (function_exists('mcrypt_encrypt') && function_exists('mcrypt_decrypt')) {
        if (in_array(MCRYPT_RIJNDAEL_256, mcrypt_list_algorithms()) && in_array(MCRYPT_MODE_CBC, mcrypt_list_modes())) {
            return true;
        } else {
            trigger_error("MCRYPT_RIJNDAEL_256 or MCRYPT_MODE_CBC not enabled.", E_USER_ERROR);
        }
    }
    trigger_error("mcrypt_encrypt or mcrypt_decrypt unavailable.", E_USER_ERROR);
}
