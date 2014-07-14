<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Encrypt and return the passed in value.
function encryptIt($val, $crypt_key = 'jSAC03eFfCu7MM2iN03gs') {

    $val_encoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $crypt_key ), $val, MCRYPT_MODE_CBC, md5( md5( $crypt_key ) ) ) );
   
   return $val_encoded;

} // end of - function encrypeIt

// Decrypt and return the passed in value.
function decryptIt($val, $crypt_key = 'jSAC03eFfCu7MM2iN03gs') {

    $val_decoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $crypt_key ), base64_decode( $val ), MCRYPT_MODE_CBC, md5( md5( $crypt_key ) ) ), "\0");
    
    return $val_decoded;

} // end of - function decryptIt


/* End of file MY_security_helper.php */
/* Location: ./application/helpers/MY_security_helper.php */