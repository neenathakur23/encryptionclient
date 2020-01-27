<?php

namespace exampleaes;

/**
 
 * openssl uses pkcs#7 padding by default 
 */
class AES_CBC_OpenSSL extends AES {

    /** @var string */
    private $aesmode = '';

    private $rawoption;

    public function setKey($key) {
        parent::setKey($key);
        // Transform the key into the bit size and set the openssl mode string
        $this->aesmode = 'aes-'.(8*Util::encryption_strlen($key)).'-cbc';
        
        $this->rawoption = defined('OPENSSL_RAW_DATA') ? OPENSSL_RAW_DATA : true;
    }

    /** @inheritdoc */
    public function encrypt($text) {
        return openssl_encrypt($text, $this->aesmode, $this->getKey(), $this->rawoption, $this->getIv());
    }

    /** @inheritdoc */
    public function decrypt($cipherText) {
        return openssl_decrypt($cipherText, $this->aesmode, $this->getKey(), $this->rawoption, $this->getIv());
    }

}
