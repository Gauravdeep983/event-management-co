<?php
$email = '';
$fullname = '';
$telephone = '';
$location = '';

// errors
$errors = array('email' => '', 'fullname' => '', 'password' => '', 'telephone' => '', 'confirm_password' => '', 'location' => '', 'password_login' => '', 'email_login' => '');
//  Registration Module
if (isset($_POST['submit'])) {
    // Email Validation
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    } else {
        $email = htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalid format';
        } else {
            // Check if already exists
            $sql = "SELECT * FROM users WHERE email_id = '$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $errors['email'] = 'Email already exists';
            }
        }
    }
    // Fullname validation
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = 'Name required';
    } else {
        $fullname = htmlspecialchars($_POST['fullname']);
    }
    //Password validation
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    } else {
        $password = htmlspecialchars($_POST['password']);
        // Validate password strength with regex
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 5) {
            $errors['password'] = 'Password should be at least 5 characters in length and should include at least one upper case letter, one number, and one special character.';
        } else {
            $confirm_password = htmlspecialchars($_POST['confirm_password']);
            if ($password !== $confirm_password) {
                $errors['password'] = 'Passwords do not match!';
            }
        }
    }
    // Confirm Password validation
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Confirm password required';
    } else {
        $confirm_password = htmlspecialchars($_POST['confirm_password']);
    }
    // Telephone validation
    if (preg_match('/^[\d -]+$/', $_POST['telephone'])) {
        $telephone = $_POST['telephone'];
    } else {
        $errors['telephone'] = 'Telephone can only include numeral digits';
    }
}
