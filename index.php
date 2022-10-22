<?php
require __DIR__ . '/Validator.php';

// Form errors
$form_errors = [];

// Check if request method is post?
if ('POST' == $_SERVER['REQUEST_METHOD']) {


    // If you need to pass in another parameter for your constructor,
    // you can modify the following line
    $v = new Validator($_POST);

    $required = array(
        'first_name',
        'last_name',
        'email_address',
        'phone',
        'address',
        'city',
        'postal_code',
        'province',
        'country',
        'password',
        'confirm_password'
    );

    $v->validateRequired($required);
    $v->validateString('first_name'); 
    $v->validateString('last_name');
    $v->validateEmail('email_address');
    $v->validatePhone('phone');
    $v->validatePassword('password');
    $v->validateMatch('password','confirm_password');

    $form_errors = $v->errors();

    if(count($form_errors) == 0){
        // Process the form-data
        echo"<span class='success'>Form Submitted Successfully!</span>";
        die;
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validations</title>
    <style>

        input[type=text], input[type=password], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }

        input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        input[type=submit]:hover {
        background-color: #45a049;
        }

        .form_div{
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        margin: 0 auto;
        width: 50%;
        }

        .text-danger{
          color: #dc3545;
          display:block;
          margin-bottom:10px;
        }
    </style>
</head>
<body>

<div class="form_div">
<h3>PHP Server-side form Validations | Sticky values with PHP Class</h3>
  
  <form action="index.php" method="post">
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" value="<?= $_POST['first_name'] ?>" placeholder="Your first name..">
    <span class="text-danger"><?=isset($form_errors['first_name']) ? $form_errors['first_name'][0] : ''?></span>

    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" value="<?= $_POST['last_name'] ?>"  placeholder="Your last name..">
    <span class="text-danger"><?=isset($form_errors['last_name']) ? $form_errors['first_name'][0] : ''?></span>

    <label for="email_address">Email Address</label>
    <input type="text" id="email_address" name="email_address" value="<?= $_POST['email_address'] ?>" placeholder="Your email address..">
    <span class="text-danger"><?=isset($form_errors['email_address']) ? $form_errors['email_address'][0] : ''?></span>

    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" value="<?= $_POST['phone'] ?>"  placeholder="Your phone number..">
    <span class="text-danger"><?=isset($form_errors['phone']) ? $form_errors['phone'][0] : ''?></span>

    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="<?= $_POST['address'] ?>" placeholder="Your address..">
    <span class="text-danger"><?=isset($form_errors['address']) ? $form_errors['address'][0] : ''?></span>

    <label for="city">City</label>
    <input type="text" id="city" name="city" value="<?= $_POST['city'] ?>" placeholder="Your city name..">
    <span class="text-danger"><?=isset($form_errors['city']) ? $form_errors['city'][0] : ''?></span>

    <label for="postal_code">Postala Code</label>
    <input type="text" id="postal_code" name="postal_code" value="<?= $_POST['postal_code'] ?>" placeholder="Your Postala Code..">
    <span class="text-danger"><?=isset($form_errors['postal_code']) ? $form_errors['postal_code'][0] : ''?></span>

    <label for="province">Province</label>
    <input type="text" id="province" name="province" value="<?= $_POST['province'] ?>" placeholder="Your Province..">
    <span class="text-danger"><?=isset($form_errors['province']) ? $form_errors['province'][0] : ''?></span>

    <label for="country">Country</label>
    <select id="country" name="country">
      <option value="australia" <?= ($_POST['country'] == 'australia') ? 'selected' : '' ?> >Australia</option>
      <option value="canada" <?= ($_POST['country'] == 'canada') ? 'selected' : '' ?> >Canada</option>
      <option value="usa" <?= ($_POST['country'] == 'usa') ? 'selected' : '' ?>>USA</option>
    </select>
    <span class="text-danger"><?=isset($form_errors['country']) ? $form_errors['country'][0] : ''?></span>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Your enter Password..">
    <span class="text-danger"><?=isset($form_errors['password']) ? $form_errors['password'][0] : ''?></span>

    <label for="confirm_password">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Your Confirm Password..">
    <span class="text-danger"><?=isset($form_errors['confirm_password']) ? $form_errors['confirm_password'][0] : ''?></span>

    <input type="submit" value="Submit">
  </form>
</body>
</html>