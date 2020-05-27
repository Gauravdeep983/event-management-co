<?php
session_start();

// DB connection
include('../php/db_connect.php');

if (isset($_SESSION['loggedin'])) {
    // Check if role = admin
    if (strtolower($_SESSION['role']) == 'admin') {
        // Get all users
        $sql = "SELECT * from users
                WHERE role <> 'admin'
                ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <title>All Users</title>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require_once('../php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require_once('../php/side_navbar.php'); ?>
    <main id="main-panel" class="pd45">
        <header class="text-center mt-3">
            <h1 class="my3">All Customers</h2>
        </header>

        <h4 class="my3 text-center">*non-admin users</h4>
        <section>
            <div class="limiter">
                <!-- Events table -->
                <div class="container-table100">
                    <?php if (empty($users)) : ?>
                        <div class="no-events">
                            <h2 class="text-center">No users have registered yet</h2>
                        </div>
                    <?php else : ?>
                        <div class="wrap-table100">
                            <div class="table">
                                <div class="row header">
                                    <div class="cell">
                                        Full Name
                                    </div>
                                    <div class="cell">
                                        Email ID
                                    </div>
                                    <div class="cell">
                                        Location
                                    </div>
                                    <div class="cell">
                                        Phone
                                    </div>
                                </div>
                                <?php foreach ($users as $user) : ?>
                                    <div class="row">
                                        <div class="cell" data-title="Fullname">
                                            <?php echo $user['fullname'] ?>
                                        </div>
                                        <div class="cell" data-title="Email Id">
                                            <?php echo $user['email_id'] ?>
                                        </div>
                                        <div class="cell" data-title="Location">
                                            <?php echo $user['location'] ?>
                                        </div>
                                        <div class="cell" data-title="Phone">
                                            <?php echo $user['phone'] ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <h3 class="text-center my3">Total Users: <?php echo count($users) ?></h3>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section>
    </main>
    <script src="../js/footer.js" type="text/javascript"></script>
</body>
<?php

// DB close        
include('../php/db_close.php');
?>
</body>

</html>