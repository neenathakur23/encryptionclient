<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/data.php';


$aescbc = new exampleaes\AES_CBC_OpenSSL();
$util   = new exampleaes\Util();

foreach ($keys as $keylen => $key) {
    $aescbc->setKey($key);
    $aescbc->setIv($iv);
    foreach ($testTexts as $plainText) {
        $cipherText  = $aescbc->encrypt($plainText);
        $decodedText = $aescbc->decrypt($cipherText);
		echo "-------------------------------------------------------";
		echo "</br>";
        echo "               Key: ($keylen) $key";
		echo "</br>";
        echo "         Plaintext: $plainText";
		echo "</br>";
        echo " Plaintext (bytes): ". $util->bytestring($plainText);
		echo "</br>";
        echo "Ciphertext (bytes): ". $util->bytestring($cipherText);
		echo "</br>";
        echo "  Ciphertext (len): ". strlen($cipherText);
		echo "</br>";
        echo "     Decryptedtext: $decodedText";
		echo "</br>";
		echo "</br>";
    }
}
