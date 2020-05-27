<?php
$name = '';
$email = '';


// errors
$errors = array('name' => '', 'email' => '');
//  Registration Module
if (isset($_POST['submit'])) {
    // Email Validation
    if (empty($_POST['email'])) {
        $errors['email'] = 'Please enter the email';
    } else {
        $email = htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is invalid';
        }
    }
    // Fullname validation
    if (empty($_POST['name'])) {
        $errors['name'] = 'Please enter the name';
    } else {
        $fullname = htmlspecialchars($_POST['name']);
    }
}
