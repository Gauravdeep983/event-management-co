<?php
session_start();
// DB connection
include('php/db_connect.php');
// Login Module
require('php/login.php');

//Get 

$sql = "SELECT * FROM team WHERE team.level= 1";
$sql1 = "SELECT * FROM team WHERE team.level= '2'";

$result = mysqli_query($conn, $sql);
$levelFirst = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result1 = mysqli_query($conn, $sql1);
$levelSecond = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<title>Nosotros</title>

<head>
  <?php require('php/header.php'); ?>
</head>

<body>
  <!-- Navigation bar -->
  <?php require('php/top_navbar_main.php') ?>

  <?php if (isset($_SESSION['error'])) : ?>
    <div id="alertbox1" class="alert danger text-center">
      <?php echo $_SESSION['error'];
      unset($_SESSION['error']); ?>
    </div>
  <?php endif ?>
  <!-- Page Banner -->
  <div id="banner" class="h250">
    <div class="caption">
      <h1>NUESTROS EQUIPOS</h1>
      <h4>INICIO > NUESTROS EQUIPOS</h4>
    </div>
  </div>
  <!-- Wrapper -->
  <div id="wrapper">
    <main>
      <section>
        <div class="equipo">
          <header class="equipo_header">
            <h2>Equipo de <span> Direccion</span></h2>
          </header>

          <?php foreach ($levelFirst as $team1) : ?>

            <div class="border">
              <img class="equipoImage1" src="<?php echo $team1['image']; ?>" alt="image" /><br />
              <?php echo $team1['name']; ?><br />
              <small><?php echo $team1['country']; ?></small>
            </div>

          <?php endforeach ?>


          <header class="equipo_header">
            <h2>Equipo de<span>Trabajo Multidisciplina</span></h2>
          </header>

          <?php foreach ($levelSecond as $team2) : ?>

            <div class="border1">
              <img class="equipoImage2" src="<?php echo $team2['image']; ?>" alt="image" /><br />
              <?php echo $team2['name']; ?><br />
              <small><?php echo $team2['country']; ?></small>
            </div>

          <?php endforeach ?>


        </div>
      </section>
    </main>
  </div>

  <form action="equipos.php" method="post">
    <?php include('php/login_modal.php'); ?>
  </form>
  <!-- Footer -->
  <?php include('php/footer_main.php'); ?>
</body>

</html>
<?php

// DB close        
include('php/db_close.php');
?>