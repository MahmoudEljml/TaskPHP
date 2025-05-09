<?php

if (!function_exists("encrypt")) {
    /**
     * encrypt Used to encrypt plan Text
     * @param string $value
     * @return string
     */
    function encrypt($value): string
    {
        $cipher = config('session.encryption_mode');
        $key = config('session.encryption_key');

        $ivLen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivLen);
        $cipherText_raw = openssl_encrypt(
            $value,
            $cipher,
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        $hmac = hash_hmac('sha256', $cipherText_raw, $key, true);
        $cipherText = base64_encode($iv . $hmac . $cipherText_raw);
        return $cipherText;

    }
}

if (!function_exists("decrypt")) {
    /**
     * decrypt Used to decryption plan Text
     * @param string $cipherText
     * @return string
     */
    function decrypt($cipherText): string
    {
        $cipher = config('session.encryption_mode');
        $key = config('session.encryption_key');

        $convert = base64_decode($cipherText);
        $ivLen = openssl_cipher_iv_length($cipher);
        $iv = substr($convert, 0, $ivLen);
        $hmac = substr($convert, $ivLen, 32);
        $cipherText_raw = substr($convert, $ivLen + 32);
        $original_text = openssl_decrypt(
            $cipherText_raw,
            $cipher,
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        $calcMac = hash_hmac('sha256', $cipherText_raw, $key, true);
        if (hash_equals($hmac, $calcMac)) {
            return $original_text;
        } else {
            return '';
        }


    }
}


// $a1 = encrypt(1);
// var_dump($a1);

// $a2 = decrypt($a1);
// var_dump($a2);