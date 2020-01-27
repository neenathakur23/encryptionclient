<?php

class AESTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider validKeys
     */
    public function testValidKey($key) {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->setKey($key);
        $this->assertAttributeEquals($key, 'key', $stub);
    }

    public function validKeys() {
        return array(
            array('1234567890123456'),
            array('123456789012345612345678'),
            array('12345678901234561234567890123456'),
            // You'll note that the UTF-8 characters cound as 2 bytes, thus the "character" count is one less.
            array('ä34567890123456'),
            array('ä3456789012345612345678'),
            array('ä345678901234561234567890123456'),
        );
    }

    /**
     * @dataProvider invalidKeyLengths
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Key length must be 16, 24, or 32 bytes
     */
    public function testInvalidKeyLength($key) {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->setKey($key);
    }

    public function invalidKeyLengths() {
        return array(
            array('x1234567890123456'),
            array('x123456789012345612345678'),
            array('x12345678901234561234567890123456'),
            // this may look like 32 bytes, but in UTF8, it's really 64!
            array('ääääääääääääääääääääääääääääääää'),
            // Again, looks even closer (16 characters!), but this is 17 bytes
            array('ä234567890123456'),
        );
    }

    /**
     * @dataProvider invalidKeyTypes
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Key must be a string
     */
    public function testInvalidKeyType($key) {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->setKey($key);
    }

    public function invalidKeyTypes() {
        return array(
            array(1),
            array(false),
            array(true),
            array(1.23),
            array(new stdClass()),
        );
    }

    /**
     * @dataProvider validIvs
     */
    public function testValidIv($iv) {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->setIv($iv);
        $this->assertAttributeEquals($iv, 'iv', $stub);
    }

    public function validIvs() {
        return array(
            array('1234567890123456'),
            array('6s54df8sef838f6d'),
            array('OLJ(&O(&UF)(*$GY'),
            array('0000000000000000'),
            // Here we have utf8 characters which takes up 2 bytes each, thus the character count is lower
            array('ä34567890123456'),
            array('äs54df8sef838f6'),
            array('äLJ(&O(&UF)(*$G'),
            array('ä00000000000000'),
            array('ääääääää'),
        );
    }

    /**
     * @dataProvider invalidIvLengths
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage IV length must be 16 bytes
     */
    public function testInvalidIvLength($iv) {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->setIv($iv);
    }

    public function invalidIvLengths() {
        return array(
            array('x1234567890123456'),
            array('x12345678901234'),
            array('x1234567890123456123456'),
            // UTF8 characters take up 2 bytes
            array('ä3456789012345'),
            array('ä345678901234567'),
        );
    }

    /**
     * @dataProvider invalidIvTypes
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage IV must be a string
     */
    public function testInvalidIvType($iv) {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->setIv($iv);
    }

    public function invalidIvTypes() {
        return array(
            array(1),
            array(false),
            array(true),
            array(1.23),
            array(new stdClass()),
        );
    }

    /**
     * @expectedException        LogicException
     * @expectedExceptionMessage The key is not set, call setKey() prior to usage
     */
    public function testNotSetKey() {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->getKey();
    }

    /**
     * @expectedException        LogicException
     * @expectedExceptionMessage The iv is not set, call setIv() prior to usage
     */
    public function testNotSetIv() {
        /** @var \exampleaes\Aes $stub */
        $stub = $this->getMockForAbstractClass('\\exampleaes\\AES');
        $stub->getIv();
    }

}
