<?php
session_start();
// DB connection
include('db_connect.php');

if (isset($_GET['event_id']) && isset($_GET['user_id'])) {
    $event_id = $_GET['event_id'];
    $user_id = $_GET['user_id'];
    
    // insert into participants
    $sql = "INSERT into participants (event_id, user_id) VALUES ($event_id, $user_id)";

    // query
    // $result = mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        header('Location: ../event.php?id=' . $event_id);
        $_SESSION['added'] = true;
    } else {
        throw new Exception('Failed to add.');
    }
}

// DB close    
include('db_close.php');
