<?php
session_start();
// DB connection
include('db_connect.php');

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    if (isset($_GET['participant_id'])) {
        $participant_id = $_GET['participant_id'];

        // delete from participants
        $sql = "DELETE from participants WHERE id = $participant_id";

        if (mysqli_query($conn, $sql)) {
            header('Location: ../added-events.php');
            $_SESSION['deleted'] = true;
            die;
        } else {
            throw new Exception('Failed to delete.');
        }
    }
}

// DB close    
include('db_close.php');
