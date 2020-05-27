<?php
session_start();

// DB connection
include('../php/db_connect.php');

if (isset($_SESSION['loggedin'])) {
    // Check if role = admin
    if (strtolower($_SESSION['role']) == 'admin') {
        $event_id = $_GET['id'];
        // Get event by id
        $sql = "SELECT r.*,u.fullname,u.email_id,e.name, e.date, e.location, e.image_path from review r 
        inner join participants p ON p.id = r.participant_id
        inner join users u ON u.id = p.user_id
        inner join events e ON e.id = r.event_id
        where r.event_id = $event_id";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $feedbacks = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
} else {
    // logout
    header('location: ../php/logout.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,800&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/b48c79d594.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../ciudad.css" />
    <title>Event Reviews</title>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require_once('../php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require_once('../php/side_navbar.php'); ?>
    <main id="main-panel" class="pd45">
        <section>
            <header class="event-head text-center">
                <div id="banner-image">
                    <div class="banner-text">
                        <h1>
                            <?php echo $feedbacks[0]['name'] ?>
                        </h1>
                    </div>
                </div>
            </header>
            <div class="limiter">
                <?php if (!empty($feedbacks)) : ?>
                    <div class="my3">
                        <h3 class="mb3"><i class="fas fa-map-marker-alt"></i> Location: <?php echo $feedbacks[0]['location'] ?></h3>
                        <h4><i class="fas fa-calendar-alt"></i> Date: <?php echo date('Y-m-d', strtotime($feedbacks[0]['date']))
                                                                        ?></h4>
                    </div>
                <?php endif ?>
                <!-- Events table -->
                <div class="container-table100">
                    <?php if (empty($feedbacks)) : ?>
                        <div class="no-events text-center">
                            <h2>Users have not rated the event yet..</h2>
                        </div>
                    <?php else : ?>
                        <div class="wrap-table100">
                            <div class="table">
                                <div class="row header">
                                    <div class="cell">
                                        Name
                                    </div>
                                    <div class="cell">
                                        Email ID
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
                                <?php foreach ($feedbacks as $feedback) : ?>
                                    <div class="row">
                                        <div class="cell" data-title="Fullname">
                                            <?php echo $feedback['fullname'] ?>
                                        </div>
                                        <div class="cell" data-title="Email Id">
                                            <?php echo $feedback['email_id'] ?>
                                        </div>
                                        <div class="cell" data-title="Rating">
                                            <?php echo $feedback['rating'] ?> / 5
                                        </div>
                                        <div class="cell" data-title="Comment">
                                            <?php echo htmlspecialchars_decode($feedback['feedback']) ?>
                                        </div>
                                        <div class="cell" data-title="Posted On">
                                            <?php echo $feedback['posted_on'] ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <h3 class="text-center my3">Total reviews: <?php echo count($feedbacks) ?></h3>
                        </div>
                    <?php endif ?>
                </div>

                <h4><a href="create-event.php">Click here to go back..</a></h4>
            </div>
        </section>
    </main>
    <script src="../js/footer.js" type="text/javascript"></script>
</body>
<?php
if (isset($_GET['id'])) {
    echo "<script type='text/javascript'>
    var banner = document.getElementById('banner-image');
    banner.style.backgroundImage =
      \"url('../images/" . $feedbacks[0]['image_path'] . "')\";
    </script>";
}
// DB close        
include('../php/db_close.php');
?>
</body>

</html>