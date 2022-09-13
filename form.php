<?php

// Form errors
$form_errors = [];

// Check if request method is post?
if ('POST' == $_SERVER['REQUEST_METHOD']) {

  // Trim and Check all fields are filled
  foreach ($_POST as $field => $value) {
    $_POST[$field] = trim($value);
    if (empty($_POST[$field])) {
      $form_errors[$field][] = "Please enter ".humanReadbleField($field);
    }
  }

  // Validate first name
  if (!preg_match('/^[A-z\s\'\-]{2,}$/', $_POST['first_name'])) {
    $form_errors['first_name'][] = "First Name must contain only letters, spaces, hyphens or apostrophies";
  }

// Validate last name
  if (!preg_match('/^[A-z\s\'\-]{2,}$/', $_POST['last_name'])) {
    $form_errors['last_name'][] = "Last Name must contain only letters, spaces, hyphens or apostrophies";
  }

// Validate phone number
  $phone_number = preg_replace('/[^\d]/', '', $_POST['phone']); // remove everything and just keep numbers
  if (!preg_match('/^[\d]{10}$/', $phone_number)) {
    $form_errors['phone'][] = 'Please enter 10 digit phone number.';
  }

  // Validate email address
  if (!filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL)) {
    $form_errors['email_address'][] = 'Please enter a valid email address';
  }

  if (!preg_match('/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/', $_POST['postal_code'])) {
    $form_errors['postal_code'][] = 'Please enter valid postal code.';
  }

  if (!preg_match('/^\S*(?=\S{6,})(?=\S*\d)(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[!@#$%^&*? ])\S*$/', $_POST['password'])) {
    $form_errors['password'][] = 'Password must have minimum 6 character, 
                                  at least 1 capital letter, 
                                  at least 1 small letter 
                                  and at least 1 special character.';
  }

  // compare Password & confirm password
  if (!empty($_POST['password']) && ($_POST['password'] !== $_POST['confirm_password'])) {
    $form_errors['confirm_password'][] = 'Password does not match';
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
    </style>
</head>
<body>

<div class="form_div">
<h3>PHP Server-side form Validations</h3>
  <form action="form.php" method="post">
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" placeholder="Your first name..">

    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" placeholder="Your last name..">

    <label for="email_address">Email Address</label>
    <input type="text" id="email_address" name="email_address" placeholder="Your email address..">

    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" placeholder="Your phone number..">

    <label for="address">Address</label>
    <input type="text" id="address" name="address" placeholder="Your address..">

    <label for="city">City</label>
    <input type="text" id="city" name="city" placeholder="Your city name..">

    <label for="postal_code">Postala Code</label>
    <input type="text" id="postal_code" postal_code="postal_code" placeholder="Your Postala Code..">

    <label for="province">Province</label>
    <input type="text" id="province" postal_code="province" placeholder="Your Province..">

    <label for="country">Country</label>
    <select id="country" name="country">
      <option value="australia">Australia</option>
      <option value="canada">Canada</option>
      <option value="usa">USA</option>
    </select>

    <label for="password">Password</label>
    <input type="password" id="password" postal_code="password" placeholder="Your enter Password..">

    <label for="confirm_password">Confirm Password</label>
    <input type="password" id="confirm_password" postal_code="confirm_password" placeholder="Your Confirm Password..">
  
    <input type="submit" value="Submit">
  </form>
</body>
</html>