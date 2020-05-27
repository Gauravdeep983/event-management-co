<?php
session_start();

// DB connection
include('php/db_connect.php');


if (isset($_SESSION['loggedin'])) {
    $user_id = $_SESSION['user_id'];
    // Get all events participated by the user
    $sql = "SELECT r.id as review_id, r.rating, r.feedback, r.posted_on, 
                    e.id as event_id, e.name as event_name, e.description, e.location, e.date, e.ticket_cost, e.manager_id,e.image_path,e.image_description,
                    p.id as participant_id, p.user_id 
    FROM participants p
    INNER JOIN events e ON e.id = p.event_id
    INNER JOIN review r ON r.event_id = p.event_id
    WHERE p.user_id = $user_id";

    $result = mysqli_query($conn, $sql);
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    header('location: php/logout.php');
}

// DB close    
include('php/db_close.php');
?>

<!DOCTYPE html>
<html lang="en">

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
        <header class="text-center mt-3">
            <h1 class="my3">My Reviews</h2>
        </header>
        <div class="limiter">
            <div class="container-table100">
                <?php if (empty($events)) : ?>
                    <div class="no-events">
                        <h2 class="text-center">No feedback found :/</h2>
                        <div class="event-container my3">
                            <a href="dashboard_events.php">Click here to add events..</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="wrap-table100">
                        <div class="table">
                            <div class="row header">
                                <div class="cell">
                                    Event Name
                                </div>
                                <div class="cell">
                                    Rating
                                </div>
                                <div class="cell">
                                    Comment
                                </div>
                                <div class="cell">
                                    Posted On
                                </div>
                            </div>
                            <?php foreach ($events as $event) : ?>
                                <div class="row">
                                    <div class="cell" data-title="Event Name">
                                        <?php echo $event['event_name'] ?>
                                    </div>
                                    <div class="cell" data-title="Rating">
                                        <?php echo $event['rating'] ?> / 5 <i class="far fa-star"></i>
                                    </div>
                                    <div class="cell" data-title="Feedback">
                                        <?php echo htmlspecialchars_decode($event['feedback']) ?>
                                    </div>
                                    <div class="cell" data-title="POSTED on">
                                        <?php echo  date('d M Y', strtotime($event['posted_on'])) ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                <?php endif ?>
            </div>
            <h3 class="text-center my3">Total reviews: <?php echo count($events) ?></h3>
        </div>
    </main>

    <!-- Footer -->
    <?php require('php/footer.php') ?>
    <script src="js/footer.js"></script>

</body>

</html>