<?php
session_start();

// DB connection
include('php/db_connect.php');

// Login Module
require('php/login.php');

// php validation
require('php/contactValidation.php');

?>
<!DOCTYPE html>
<html lang="en">
<title>Contacto</title>

<head>
    <?php require('php/header.php'); ?>
    <!-- JS Validation -->
    <script src="js/contactFormValidations.js"></script>
</head>

<body>
    <!-- Navigation bar -->
    <?php require('php/top_navbar_main.php') ?>

    <div id="alertbox" class="alert success text-center">
        Your issue has been sent to the team. Thank you!
    </div>
    <?php if (isset($_SESSION['error'])) : ?>
        <div id="alertbox1" class="alert danger text-center">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif ?>
    <!-- Page Banner -->
    <div id="banner" class="h250">
        <div class="caption">
            <h1>Contact Us</h3>
                <h4>Inicio > Contact Us</h3>
        </div>
    </div>
    <!-- Wrapper -->
    <div id="wrapper">
        <main class="contact-main">
            <section class="left">
                <header>
                    <h2>Nuestras <span>Redes <br />Sociales</span>
                    </h2>
                    <div id="glitch"></div>
                </header>
                <div class="contact">
                    <ul>
                        <li>
                            <div class="icon-container">
                                <i class="fab fa-3x fa-instagram"></i>
                                <p>@genteyciudadorg</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-container">
                                <i class="fab fa-3x fa-twitter"></i>
                                <p>@genteyciudadorg</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-container">
                                <i class="fas fa-3x fa-phone-alt"></i>
                                <p>001 346 714 3892
                                    <br>
                                    058 414 8225881
                                    <br>
                                    056 933948007
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-container">
                                <i class="fas fa-3x fa-envelope"></i>
                                <p>info@genteyciudad.org</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="right">
                <header>
                    <h2>Formulario de <br /><span>Contacto</span>
                    </h2>
                    <div id="glitch"></div>
                </header>

                <form class="contact-form" name="contactForm" action="contacto.php" method="POST" onsubmit="return validateContactForm()">
                    <div class="contactForm">
                        <label>Tu Nombre (requerido)</label><br>
                        <input type="text" placeholder="Tu Nombre" name="name" required>
                        <div class="form-error">
                            <?php
                            echo $errors['name'];
                            ?>
                        </div>
                    </div>

                    <div class="contactForm">
                        <label>Tu Correro (requerido)</label><br>
                        <input type="email" placeholder="Tu Correro" name="email" required>
                        <div class="form-error">
                            <?php
                            echo $errors['email'];
                            ?>
                        </div>
                    </div>

                    <div class="contactForm">
                        <label>Asunto</label><br>
                        <input type="text" placeholder="Asunto" name="issue">
                    </div>

                    <div class="contactForm">
                        <label>Asunto</label><br>
                        <textarea style="height:150px;" rows="10" name="issue_detail"></textarea>
                    </div>


                    <button class="button" name="submitContactForm" type="submit">ENVIAR</button>
                </form>

            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer>
        <div id="banner">
            <div class="footer-caption">
                <h2><span>Escríbenos, te invitamos a brindar lo mejor de ti para el bien común,</span> queremos conocer
                    acerca de tus ideas para mejorar.</h2>
            </div>
        </div>
        <div class="social">
            <div class="social-container">
                <button><i class="fas fa-envelope"></i></button>
                <button><i class="fab fa-twitter"></i></button>
                <button><i class="fab fa-instagram"></i></button>
            </div>
        </div>
        <div class="copyright">
            <h5><span>DiazApps</span> &copy; 2020 All Right Reserved</h5>
            <button onclick="scrollToTop()"><i class="fas fa-lg fa-chevron-up"></i></button>
        </div>
    </footer>
    <form action="contacto.php" method="POST">
        <?php include('php/login_modal.php'); ?>
    </form>
    <?php

    if (isset($_POST['submitContactForm'])) {

        if (array_filter($errors)) {
            // show errors
        } else {

            //form is valid and send to db

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $issue = mysqli_real_escape_string($conn, $_POST['issue']);
            $issue_detail = mysqli_real_escape_string($conn, $_POST['issue_detail']);

            // sql insert
            $sql = "INSERT INTO contact (contact_id, name, email, issue, issue_detail) VALUES (NULL, '$name', '$email', '$issue', '$issue_detail')";

            // save to db and confirm
            if (mysqli_query($conn, $sql)) {

                echo '<script type="text/javascript">        
                        document.getElementById("alertbox").style.display = "block";  
                        console.log("saved to database");      
                        </script> ';
            } else {
                echo 'Failed to save in DB';
                echo mysqli_error($conn);
            }
        }
    }

    ?>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the element that opens the modal
        var login = document.getElementById("popup");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        login.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        // Scroll to top function
        function scrollToTop() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
</body>

</html>
<?php

// DB close        
include('php/db_close.php');
?>