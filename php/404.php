<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>404</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,800&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/b48c79d594.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../ciudad.css" />
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require_once('top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require_once('side_navbar.php'); ?>

    <main id="main-panel" class="fourofour-container pd45">
        <h1>404</h1>
        <h3>Page not found.</h3>
        <br>
        <a href="javascript:history.go(-1)">Click here to go back..</a>
    </main>

    <!-- Footer -->
    <?php require('footer.php') ?>
    <script src="../js/footer.js"></script>

</html>