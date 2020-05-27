<?php
session_start();

// DB connection
include('php/db_connect.php');

if (isset($_SESSION['loggedin'])) {
    $fullname = $_SESSION['fullname'];
    // $email = $_SESSION['email'];

    $query = "SELECT `id`, `name`, `description`, `location`, `date`, `ticket_cost`, `manager_id`, `image_path`, `image_description` from `events` ORDER BY `date` DESC";
    // Execute sql query
    $result = mysqli_query($conn, $query);
    // Fetch results(events) as an associative array
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
}

//TODO: Dynamic images

// DB close        
include('php/db_close.php');
?>

<!DOCTYPE html>
<html lang="en">
<title>Events</title>

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
            <h1 class="my3">Events</h2>
        </header>
        <section id="event-container">
            <div id="wrapper">
                <ul class="event-list">
                    <?php foreach ($events as $event) : ?>
                        <li>
                            <div class="article">
                                <div class="img-container">
                                    <a href="event.php?id=<?php echo htmlspecialchars($event['id']) ?>">
                                        <!--Banner Image -->
                                        <?php if (empty($event['image_path'])) : ?>
                                            <img src="images/Career-Fair-1.jpg" alt="image-1" />
                                        <?php else : ?>
                                            <img src="images/<?php echo $event['image_path'] ?>" alt="<?php echo $event['image_description'] ?>" />
                                        <?php endif ?>
                                    </a>
                                </div>
                                <!-- <hr> -->
                                <div class="article-date"><b><?php $date = strtotime($event['date']);
                                                                echo date('d', $date);
                                                                ?></b><br /><?php $month = strtotime($event['date']);
                                                                            echo date('M', $month); ?></div>
                                <div class="article-info">
                                    <h3 class="mb3 text-center"><a href="event.php?id=<?php echo htmlspecialchars($event['id']) ?>"><?php echo htmlspecialchars($event['name']) ?></a></h3>
                                    <p><?php $description = strip_tags(htmlspecialchars_decode($event['description'])); echo substr($description, 0, 100) ?> </p>
                                    <hr />
                                    <div class="meta-info text-center">
                                        <i class="fas fa-map-marker-alt"></i><span><?php echo htmlspecialchars($event['location']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
                <h3 class="text-center">Total events: <?php echo count($events); ?></h3>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <?php require('php/footer.php') ?>
    <script src="js/footer.js"></script>

</body>

</html>