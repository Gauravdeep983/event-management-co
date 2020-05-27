<?php

// Initialize variables
$name = '';
$description = '';
$location = '';
$date = '';
$ticket_cost = '';
$manager_id = '';
$image_path = '';
$image_description = '';

// Insert 
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $ticket_cost = $_POST['ticket_cost'];
    $manager_id = $_POST['manager'];
    $image_description = $_POST['image_description'];

    // Upload image with validation
    include('../php/upload_image.php');

    $sql = "INSERT INTO `events`(`id`, `name`, `description`, `location`, `date`, `ticket_cost`, `manager_id`, `image_path`,`image_description`) 
        VALUES (NULL,'$name','$description','$location','$date','$ticket_cost','$manager_id','$image_path','$image_description')";
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "Event added successfully!";
        // header('Location: ../admin/create-event.php');
    } else {
        // Failed to query
    }
}

// Update
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $ticket_cost = mysqli_real_escape_string($conn, $_POST['ticket_cost']);
    $manager_id = mysqli_real_escape_string($conn, $_POST['manager_id']);
    // $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);
    $image_description = mysqli_real_escape_string($conn, $_POST['image_description']);
    // Upload image with validation
    include('../php/upload_image.php');

    $sql = "UPDATE `events` SET        
        `name`= '$name', 
        `description`= '$description', 
        `location`= '$location', 
        `date`= '$date', 
        `ticket_cost`= $ticket_cost, 
        `manager_id`= $manager_id, 
        `image_path`= '$image', 
        `image_description`= '$image_description'
        
        WHERE `id`= $id ";
    // echo $sql;

    $result = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "Event updated successfully!";
        // header('Location: ../admin/create-event.php');
    } else {
        // Failed to query
    }
}
// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE from `events` WHERE `id` = $id";

    $result = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "Event deleted successfully!";
        // header('Location: ../admin/create-event.php');
    } else {
        // Failed to query
    }
}
