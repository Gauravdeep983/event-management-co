<?php
session_start();

// DB connection
include('../php/db_connect.php');


if (isset($_SESSION['loggedin'])) {
    $user_id = $_SESSION['user_id'];
    // Get all events participated by the user
    $sql = "SELECT * from contact";

    $result = mysqli_query($conn, $sql);
    $contact = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    header('location: ../php/logout.php');
}

// DB close    
include('../php/db_close.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,800&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/b48c79d594.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../ciudad.css" />
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require('../php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require('../php/side_navbar.php'); ?>

    <!-- Form -->

    <main id="main-panel" class="pd45">
        <header class="text-center mt-3">
            <h1 class="my3">Contact Us Issues</h2>
        </header>
        <div class="limiter">
            <div class="container-table100">
                <?php if (empty($contact)) : ?>
                    <div class="no-events">
                        <h2 class="text-center">No issues found :/</h2>
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
                                    Issue
                                </div>
                                <div class="cell">
                                    Issue Detail
                                </div>
                            </div>
                            <?php foreach ($contact as $c) : ?>
                                <div class="row">
                                    <div class="cell" data-title="Name">
                                        <?php echo $c['name'] ?>
                                    </div>
                                    <div class="cell" data-title="EMAIL ID">
                                    <?php echo $c['email'] ?>
                                    </div>
                                    <div class="cell" data-title="Issue">
                                        <?php echo htmlspecialchars_decode($c['issue']) ?>
                                    </div>
                                    <div class="cell" data-title="Details">
                                    <?php echo htmlspecialchars_decode($c['issue_detail']) ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                <?php endif ?>
            </div>
            <h3 class="text-center my3">Total issues: <?php echo count($contact) ?></h3>
        </div>
    </main>

    <!-- Footer -->
    <?php require('../php/footer.php') ?>
    <script src="../js/footer.js"></script>

</body>

</html>