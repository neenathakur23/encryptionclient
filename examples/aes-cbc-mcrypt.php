<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/data.php';

$pkcs7 = new exampleaes\PKCS7();
$aescbc = new exampleaes\AES_CBC_Mcrypt($pkcs7);
$util   = new exampleaes\Util();

foreach ($keys as $keylen => $key) {
    $aescbc->setKey($key);
    $aescbc->setIv($iv);
    foreach ($testTexts as $plainText) {
        $cipherText  = $aescbc->encrypt($plainText);
        $padded = $pkcs7->pad($plainText, 16);
        $decodedText = $aescbc->decrypt($cipherText);
        echo "-------------------------------------------------------";
		echo "</br>";
        echo "               Key: ($keylen) $key";
		echo "</br>";
        echo "         Plaintext: $plainText";
		echo "</br>";
        echo " Plaintext (bytes): ". $util->bytestring($plainText);
		echo "</br>";
        echo "    Padded (bytes): ". $util->bytestring($padded);
		echo "</br>";
        echo "      Padded (hex): ". bin2hex($padded);
		echo "</br>";
        echo "      Padded (len): ". strlen($padded);
		echo "</br>";
        echo "Ciphertext (bytes): ". $util->bytestring($cipherText);
		echo "</br>";
        echo "  Ciphertext (hex): ". bin2hex($cipherText);
		echo "</br>";
        echo "  Ciphertext (len): ". strlen($cipherText);
		echo "</br>";
        echo "     Decryptedtext: $decodedText";
		echo "</br>";
    }
}
