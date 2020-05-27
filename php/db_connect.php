<?php
// Credentials
// define('host', 'localhost:3306');
// define('user', 'gauravut_gauravdeep');
// define('password', 'Gaurav@May1996');
// define('database', 'gauravut_event_management');

// Credentials
define('host', 'localhost');
define('user', 'gaurav');
define('password', 'GauravdeepTest');
define('database', 'gauravut_event_management');

try {
    // Connect to DB
    $conn = mysqli_connect(host, user, password, database);
} catch (Exception $ex) {
    echo 'Caught exception: ' . $ex->getMessage() . '<br/>';
    echo ' Stack Trace: ';
    print_r($ex->getTrace()) . '<br/>';

    echo 'Connection error: ' . mysqli_connect_error();
}
