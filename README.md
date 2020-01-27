# encryptionclient


* Acceptance Criteria*

* Provide an Encryption Client which would use any cryto library like OpenSSL or mcrypt to encrypt the given text. Example: Cipher::encrypt(), Cipher::decrypt().
* The cryto libraries being used should follow a standard interface and should be easily pluggable in the encryption client. (Read how provider design pattern works) https://msdn.microsoft.com/en-us/library/ms972319.aspx
* Provide a factory to create instances of crypto libraries. http://www.phptherightway.com/pages/Design-Patterns.html
* Add relevant unit test cases
* Language Preferred: PHP
* Should follow PSR4 autoloading
* Should follow PSR2 coding guidelines
* An example of how it is done in .net framework: https://msdn.microsoft.com/en-us/library/system.security.cryptography(v=vs.110).aspx. This could be used as a good reference.

References -

https://aesencryption.net/
https://laravel.com/docs/5.7/encryption
https://deliciousbrains.com/php-encryption-methods/
https://phptherightway.com/pages/Design-Patterns.html
https://www.valuebound.com/resources/blog/understanding-phpunit-and-how-to-write-unit-test-cases

Run tests -

php vendor/phpunit/phpunit/phpunit
