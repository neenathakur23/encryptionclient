<?php

// Strings
$testTexts = array(
    'A',
    'A message',
    'A 15 byte mesag',
    'A 16 byte messag',
    'A 17 byte message',
    'A 31 byte messsage goes in here',
    'A 32 byte messsage for gives pad',
);

// Example keys of right length
$keys = array(
    '16' => '1234567890123456',
    '24' => '123456789012345678901234',
    '32' => '12345678901234567890123456789012',
);

// In practice the IV should always be as unique
$iv = 'x234567890123456';
