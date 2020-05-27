<?php

session_start();

// DB connection
include('php/db_connect.php');

// Registration Module
require('php/registration.php');

// Login Module
require('php/login.php');


?>

<!DOCTYPE html>
<html lang="en">
<title>Inicio</title>

<head>
    <?php require('php/header.php'); ?>
    <!-- js -->
    <script src="js/registerFormValidations.js"></script>
    <script src="js/loginFormValidations.js"></script>
</head>

<body>
    <!-- Navigation bar -->
    <?php require('php/top_navbar_main.php') ?>
    <!-- Alert -->
    <?php if (isset($_SESSION['msg'])) : ?>
        <div id="alertbox" class="alert success">
            <?php echo $_SESSION['msg'];
            unset($_SESSION['msg']); ?>
        </div>
    <?php endif ?>
    <?php if (isset($_SESSION['error'])) : ?>
        <div id="alertbox1" class="alert danger text-center">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif ?>
    <div id="banner2">
        <img src="images/objects.png" alt="objects" id="objects" />
        <div class="caption">
            <h1>GENTE</br>
                <span>Y CIUDAD</span></h1>
            <h6>
                Buscamos marcar un punto de partida para la transformación de nuestras dificultades y diferencias en cimientos firmes que, desde las ciudades,
                requieren nuestros países latinoamericanos para convertirse en los mejores lugares para vivir, ya no solo por las bellezas y riquezas de nuestras tierras, sino
                por lo decisión de su gente de aportar lo mejor de si para mejorar su calidad de vida y asegurar los derechos de las futuras generaciones.
            </h6>

        </div>
    </div>
    <!-- Objectives -->
    <section class="obj-container">
        <div class="obj-box">
            <h2>Objetivos</h2>
            <p>
                Realizar investigaciones, estudios y propuestas legislativas,
                relacionados con la gestión de los gobierno locales para el desarrollo
                sostenible.Formular proyectos para promover la participación ciudadana
                en iniciativas locales para la sostenibilidad. Desarrollar programas
                de capacitación en las áreas de participación ciudadana local y
                gobierno abierto para la sostenibilidad. Promover iniciativas de
                responsabilidad social y voluntariado, como espacios de participación
                ciudadanaImplementar campañas de sensibilización para motivar en la
                audiencia el ejercicio activo de la ciudadanía como eje fundamental
                para la transformación de las ciudades.
            </p>
        </div>
    </section>
    <!-- Nuestros Valores -->
    <div id="wrapper">
        <section class="values-container">
            <h2 class="mb3">Nuestros <span>Valores</span></h2>
            <ul class="values-grid">
                <li>
                    <h2>CALIDAD</h2>
                    <div id="glitch" class="mb3"></div>
                    <p>
                        Es la práctica de los integrantes de Gente & Ciudad que fomenta
                        una mejora continua para alcanzar la misión de la organización.
                    </p>
                </li>
                <li>
                    <h2>CONFIANZA</h2>
                    <div id="glitch" class="mb3"></div>
                    <p>
                        Es la seguridad que Gente & Ciudad genera a través de sus actos.
                    </p>
                </li>
                <li>
                    <h2>COHERENCIA</h2>
                    <div id="glitch" class="mb3"></div>
                    <p>
                        Todas las actuaciones de Gente & Ciudad estarán en consonancia con
                        sus valores institucionales.
                    </p>
                </li>
                <li>
                    <h2>COMPROMISO</h2>
                    <div id="glitch" class="mb3"></div>
                    <p>
                        Los integrantes de Gente & Ciudad asumen como propio el
                        cumplimiento de las obligaciones de la institución.
                    </p>
                </li>
                <li>
                    <h2>COOPERACIÓN</h2>
                    <div id="glitch" class="mb3"></div>
                    <p>
                        En Gente & Ciudad se promueve la suma de fuerzas para lograr
                        objetivos compartidos.
                    </p>
                </li>
                <li>
                    <h2>TRANSPARENCIA</h2>
                    <div id="glitch" class="mb3"></div>
                    <p>
                        Es la cualidad que caracteriza y promueve Gente & Ciudad que
                        permite conocer claramente nuestro planteamientos y acciones.
                    </p>
                </li>
            </ul>
        </section>
    </div>
    <!-- Register -->
    <section class="signup-container">
        <div class="register-container">
            <div class="advert">
                <ul class="advert-list">
                    <li>
                        <i class="fas fa-3x fa-microphone"></i>
                        <p>18 FOROS</p>
                    </li>
                    <li>
                        <i class="fa fa-3x fa-users"></i>
                        <p>50 + PASTICIPANTES</p>
                    </li>
                    <li>
                        <i class="fas fa-3x fa-book"></i>
                        <p>30 EVENTOS</p>
                    </li>
                    <li>
                        <i class="fas fa-3x fa-calendar-alt"></i>
                        <p>3 EVENTOS POR DIAS</p>
                    </li>
                </ul>
            </div>

            <!-- <form class="regform" action="inicio.php" method="POST"> -->
            <form name="register" class="regform" action="inicio.php" method="POST" onsubmit="return validateRegisterForm()">
                <div class="form-container">
                    <h2>Registrate con <span>Nosotros</span></h2>
                    <p>Para estas informado de nuestas actividades y eventos</p>
                </div>
                <div class="form-left">
                    <div class="registerForm">
                        <input type="text" name="fullname" placeholder="Nombre Completo" class="reg-textbox" required value="<?php echo htmlspecialchars($fullname) ?>" />
                    </div>
                    <div class="form-error registerForm">
                        <?php
                        echo $errors['fullname'];
                        ?>
                    </div>
                    <div class="registerForm">
                        <input type="password" name="password" placeholder="Clave" class="reg-textbox" required />
                    </div>
                    <div class="form-error registerForm">
                        <?php
                        echo $errors['password'];
                        ?>
                    </div>
                    <div class="registerForm">
                        <input type="tel" name="telephone" placeholder="Telefono" class="reg-textbox" maxlength="10" value="<?php echo htmlspecialchars($telephone) ?>" />
                        <div>
                            <small>Only 10 digits number allowed</small>
                        </div>
                    </div>
                    <div class="form-error registerForm">
                        <?php
                        echo $errors['telephone'];
                        ?>
                    </div>

                </div>
                <div class="form-right">
                    <div class="registerForm">
                        <input type="email" name="email" placeholder="Correo" class="reg-textbox" required value="<?php echo htmlspecialchars($email) ?>" />
                    </div>
                    <div class="form-error registerForm">
                        <?php
                        echo $errors['email'];
                        ?>
                    </div>
                    <div class="registerForm">
                        <input type="password" name="confirm_password" required placeholder="Confirmar clave" class="reg-textbox" />
                    </div>
                    <div class="form-error registerForm">
                        <?php
                        echo $errors['confirm_password'];
                        ?>
                    </div>
                    <div class="registerForm">
                        <select name="location">
                            <option value="" disabled selected hidden>Cuidad de origen</option>
                            <option value="Texas">Texas</option>
                            <option value="California">California</option>
                            <option value="New York">New York</option>
                            <option value="Washington">Washington</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <button class="registerbutton" type="submit" name="submit">Registrar Ahora</button>
                </div>
            </form>
            <!-- </div> -->

        </div>
        <div class="sponsor-container">
            <h2 class="mb3">Nuestros Aliados <span>Estrategicos</span></h2>
            <div class="sponsor-img">
                <img src="images/image3.jpg" alt="sponsor 1" width="250px" height="150px" />
                <img src="images/i.jpg" alt="sponsor 2" width="250px" height="150px" />
            </div>
        </div>
    </section>
    <!-- Blog -->
    <section class="blog-container">
        <div class="blog">
            <h2 class="mb3">Nuestro <span>Blog</span></h2>
            <p>
                Esta sección esta pensada para integrar a los ciudadanos y poder tener
                un feedback directo con nuestra comunidad.
            </p>
            <ul class="blog-articles my3">
                <li>
                    <div class="article">
                        <div class="img-container">
                            <img src="images/image1.jpg" alt="image-1" />
                        </div>
                        <!-- <hr> -->
                        <div class="article-date">03<br />Mar</div>

                        <div class="article-info">
                            <h3>¿Ciudadanos?</h3>
                            <hr />
                            <div class="meta-info">
                                <div><i class="far fa-user"></i><span>Admin</span></div>
                                <div><i class="far fa-heart"></i><span>350</span></div>
                                <div><i class="far fa-bookmark"></i><span>30</span></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="article">
                        <div class="img-container">
                            <img src="images/image2.png" alt="image-1" />
                        </div>
                        <!-- <hr> -->
                        <div class="article-date">23<br />May</div>

                        <div class="article-info">
                            <h3>Efecto espejo: Calidad de vida</h3>
                            <hr />
                            <div class="meta-info">
                                <div><i class="far fa-user"></i><span>Admin</span></div>
                                <div><i class="far fa-heart"></i><span>350</span></div>
                                <div><i class="far fa-bookmark"></i><span>30</span></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="article">
                        <div class="img-container">
                            <img src="images/image3.jpg" alt="image-1" />
                        </div>
                        <!-- <hr> -->
                        <div class="article-date">13<br />May</div>

                        <div class="article-info">
                            <h3>Evolución ciudadana (opinión)</h3>
                            <hr />
                            <div class="meta-info">
                                <div><i class="far fa-user"></i><span>Admin</span></div>
                                <div><i class="far fa-heart"></i><span>350</span></div>
                                <div><i class="far fa-bookmark"></i><span>30</span></div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <form name="login" action="inicio.php" method="post" onsubmit="return validateLoginForm()">
        <?php include('php/login_modal.php'); ?>
    </form>

    <!-- Footer -->
    <?php include('php/footer_main.php'); ?>

    <?php
    if (isset($_POST['submit'])) {
        // After form validation
        if (array_filter($errors)) {
            // show errors
        } else {

            //form is valid and send to db
            $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $location = mysqli_real_escape_string($conn, $_POST['location']);
            $role = 'customer';  // default role
            $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);

            // sql insert
            $sql = "INSERT INTO users (id, fullname, email_id, password, location, role, phone) 
                    VALUES (NULL, '$fullname', '$email', '$password', '$location', '$role', '$telephone')";

            // save to db and confirm
            if (mysqli_query($conn, $sql)) {
                $_SESSION['msg'] = "Registration successful! Please check your registered email for login credentials.";
                // Send email upon confirmation
                // $to      =  $email;
                // $subject = 'Thank you for registering with us';
                // $message = 'Hello. This is to confirm that we have successfully created your account. Please login using Username: ' . $email . ' Password: ' . $password;
                // $headers = 'From: webmaster@example.com' . "\r\n" .
                //     'Reply-To: webmaster@example.com' . "\r\n" .
                //     'X-Mailer: PHP/' . phpversion();
                // try {
                //     mail($to, $subject, $message, $headers);
                // } catch (Exception $e) {
                //     echo $e . " :Error Message";
                // }
            } else {
                echo 'Failed to save in DB';
            }
        }
    }
    // DB close        
    include('php/db_close.php');
    ?>
</body>

</html>