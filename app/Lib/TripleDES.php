<?php

App::import('Vendor', 'phpseclib/Crypt/TripleDES');

class TripleDES {

	public static function encrypt($text, $key = null) {

		$key = isset($key) ? $key : Configure::read('Security.key');
		
		$cipher = new Crypt_TripleDES(CRYPT_DES_MODE_ECB);
		$cipher->setKey($key);

		return $cipher->encrypt($text);
	}

	public static function decrypt($text, $key = null) {

		$key = isset($key) ? $key : Configure::read('Security.key');
		
		$cipher = new Crypt_TripleDES(CRYPT_DES_MODE_ECB);
		$cipher->setKey($key);

		return $cipher->decrypt($text);
	}
	
	public static function encryptBase64($text, $key = null) {
		return base64_encode(self::encrypt($text, $key));
	}

	public static function decryptBase64($text, $key = null) {
		return self::decrypt(base64_decode($text, $key));
	}

}