<?php
session_start();

// DB connection
include('php/db_connect.php');

if (isset($_SESSION['loggedin'])) {
    // check GET request id param
    if (isset($_GET['id'])) {
        // escape sql chars
        $event_id = mysqli_real_escape_string($conn, $_GET['id']);
        $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

        // select statement
        $sql = "SELECT * FROM events WHERE id = $event_id";

        // get the query result
        $result = mysqli_query($conn, $sql);
        $event = mysqli_fetch_assoc($result);

        // Check to see if event has already been added
        $sql2 = "SELECT * FROM participants WHERE user_id = $user_id AND event_id = $event_id";
        $result = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($result) == 1) {
            // Get total participants
            $sql = "SELECT count(id) as count FROM `participants` WHERE event_id = $event_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                $count = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
            $event_added = true;
        } else {
            $event_added = false;
        }
    } else {
        header('location: php/logout.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<title></title>

<head>
    <?php require('php/header.php') ?>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require('php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require('php/side_navbar.php'); ?>

    <!-- Form -->
    <main id="main-panel" class="pd45">
        <header class="event-head text-center">
            <div id="banner-image">
                <div class="banner-text">
                    <h1>
                        <?php echo htmlspecialchars($event['name']) ?>
                    </h1>
                </div>
            </div>
        </header>
        <div id="wrapper">
            <form action="event.php?id=<?php echo $event_id ?>" method="post">
                <?php if ($event) : ?>
                    <div id="alertbox" class="alert success my3">
                        <strong>Success!</strong> Event added.
                    </div>

                    <h3 class="my3">
                        <i class="fas fa-map-marker-alt"></i><span>&ensp;<?php echo $event['location'] ?></span>
                    </h3>
                    <h4 class="mb3">
                        <i class="fas fa-calendar-alt"></i><span>&ensp;<?php $date = strtotime($event['date']);
                                                                        echo date('d F Y', $date);
                                                                        ?></span>
                    </h4>
                    <h4>
                        <?php if ($event['ticket_cost'] == 0) : ?>
                            <i class="fas fa-money-bill"></i><span>&ensp;FREE</span>
                        <?php else : ?>
                            <i class="fas fa-money-bill"></i><span>&ensp;<?php echo $event['ticket_cost'] ?> <i class="fas fa-dollar-sign"></i></span>
                        <?php endif ?>
                    </h4>
                    <br>
                    <hr>
                    <span class="my3">
                        <?php echo htmlspecialchars_decode($event['description']) ?>
                    </span>
                    <hr>
                    <?php if (isset($count)) : ?>
                        <h4 class="my3 text-center">Total Participants: <?php echo $count['count'] ?></h4>
                    <?php else : ?>
                        <h4 class="my3 text-center">Total Participants: 0</h4>
                    <?php endif ?>
                    <div class="attend-event-container">
                        <?php if (!$event_added) : ?>
                            <a href="php/attend.php?event_id=<?php echo $event['id']; ?>&user_id=<?php echo $user_id; ?>" class="btn btn-success">Attend event <i class="fas fa-plus"></i></a>

                        <?php else : ?>
                            <button type="button" class="btn btn-success" disabled>Event added to list <i class="fas fa-check"></i></button>
                            <div class="my3">
                                <a href="added-events.php">Click here to view added events..</a>
                            </div>
                        <?php endif ?>

                        <!-- <button name="attend" type="submit" class="btn btn-success">Attend event <i class="fas fa-plus"></i></button> -->

                    </div>
                <?php else : ?>
                    <h1 class="text-center my3">Event not found.</h1>
                <?php endif ?>
            </form>
        </div>
    </main>
    <!-- Footer -->
    <?php require('php/footer.php') ?>
    <script src="js/footer.js"></script>

    <?php
    if (isset($_GET['id'])) {
        echo "<script type='text/javascript'>
        var banner = document.getElementById('banner-image');
        banner.style.backgroundImage =
          \"url('images/" . $event['image_path'] . "')\";
        </script>";
    }
    if (isset($_SESSION['added'])) {
        echo '<script type="text/javascript">        
        document.getElementById("alertbox").style.display = "block";        
        </script> ';
        unset($_SESSION['added']);
    }
    // DB close    
    include('php/db_close.php');
    ?>
</body>

</html>