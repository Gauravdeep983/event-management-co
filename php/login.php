<?php
// Login.php validates email and password and saves certain credentials in session after successfull login

// Declare variables as null
$email_login = '';
$password_login = '';

// Login errors array
$login_errors = array('email_login' => '', 'password_login' => '');

if (isset($_POST['login'])) {
    $email_login = mysqli_real_escape_string($conn, $_POST['email_login']);
    $password_login = mysqli_real_escape_string($conn, $_POST['password_login']);

    // Validation
    if (empty($email_login)) {
        $login_errors['email_login'] = 'Email ID is required.';
    } else {
        if (!filter_var($email_login, FILTER_VALIDATE_EMAIL)) {
            $login_errors['email_login'] = 'Invalid format';
        }
    }
    if (empty($password_login)) {
        $login_errors['password_login'] = 'Password is required.';
    }
    if (array_filter($login_errors)) {
        echo 'error logging in';
        // error exists
    } else {
        $sql = "SELECT id,fullname,email_id,role from users WHERE email_id = '$email_login' AND password = '$password_login'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if (!empty($row)) {
            // successful login
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $email_login;
            $_SESSION['role'] = $row['role'];
            $_SESSION['loggedin'] = true;

            if ($_SESSION['role'] == 'admin') {
                header("location: admin/create-event.php");
            } else {
                header("location: dashboard_events.php");
            }
        } else {
            $_SESSION['error'] = 'Invalid username/password combination';
            
        }
    }
} else {
    unset($_SESSION['fullname']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['loggedin']);
}
