<?php

/**
 * Run this file to test your validator Class.
 */


require __DIR__ . '/Validator.php';

// Example form POST

$_POST = array(
    'first_name' => '!Developer',  // invalid
    'last_name' => 'Doe',  // invalid
    'age' => '78d',  // invalid
    'email1' => 'davey@',  // invalid
    'email2' => 'davey@hotmail.com',  // valid
    'postal_code1' => 'R3G 2J4', // valid
    'postal_code2' => 'r3g2j4', // valid
    'postal_code3' => 'rg32j4', // invalid
    'phone1' => '204-123-1234', // valid
    'phone2' => '', // invalid
    'phone3' => '204-1231234', // valid
    'phone4' => '204.123-1234', // valid
    'phone5' => '2041231234', // valid
    'phone6' => '204 123 1234', // valid
    'phone7' => '204.123.1234', // valid
    'phone8' => '204123123', // invalid
    'phone9' => '2-04-123-1234', // invalid
    'password1' => 'P@ssw0rd1', // valid
    'password2' => '#passworD1', // valid
    'password3' => 'passWord1!', // valid
    'password4' => 'password1', // invalid
    'password5' => 'password' // invalid
);


// If you need to pass in another parameter for your constructor,
// you can modify the following line
$v = new Validator($_POST);

$required = array(
	'first_name', 'last_name', 'age', 'email1', 'email2',
	'postal_code1', 'postal_code2', 'postal_code3', 
	'phone1', 'phone2', 'phone3', 'phone4', 'phone5', 'phone6',
	'phone7', 'phone8', 'phone9', 'password1', 'password2',
	'password3', 'password4', 'password5'
);

$v->validateRequired($required);

$v->validateString('first_name'); 

$v->validateString('last_name');

$v->validateNumber('age'); 

$v->validateEmail('email1');

$v->validateEmail('email2');

$v->validatePostalcode('postal_code1');

$v->validatePostalcode('postal_code2');

$v->validatePostalcode('postal_code3');

$v->validatePhone('phone1');

$v->validatePhone('phone2');

$v->validatePhone('phone3');

$v->validatePhone('phone4');

$v->validatePhone('phone5');

$v->validatePhone('phone6');

$v->validatePhone('phone7');

$v->validatePhone('phone8');

$v->validatePhone('phone9');

$v->validatePassword('password1');

$v->validatePassword('password2');

$v->validatePassword('password3');

$v->validatePassword('password4');

$v->validatePassword('password5');

echo '<pre>';

$errors = $v->errors();

print_r($errors);


