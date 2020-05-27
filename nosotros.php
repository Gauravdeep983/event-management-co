<?php
session_start();
// DB connection
include('php/db_connect.php');
// Login Module
require('php/login.php');
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
      <h1 class="font-lighter">Nosotros</h1>
      <h4 class="font-lighter">Inicio > Nosotros</h4>
    </div>
  </div>
  <!-- Wrapper -->
  <div id="wrapper">
    <main>
      <section class="misvis">
        <div class="left">
          <div class="mission">
            <h2>Nuestra <span>MISIÓN</span></h2>
            <div id="glitch" class="mb3"></div>
            <p>
              Somos una Corporación no gubernamental en Estados Unidos, sin
              fines de lucro, que tiene el propósito de contribuir con el
              Desarrollo Sostenible de las ciudades, a través de
              investigaciones, asesorías, formulación de Proyectos, planes de
              formación, iniciativas de responsabilidad social y voluntariado.
            </p>
          </div>
        </div>
        <div class="right">
          <div class="vision">
            <h2>Nuesta <span>VISIÓN</span></h2>
            <div id="glitch" class="mb3"></div>
            <p>
              Ser reconocida como un instrumento facilitador para promover el
              Desarrollo Sustentable de la colectividad. Nuestra filosofía de
              trabajo contempla la búsqueda concertada de soluciones de
              distintos actores sociales con la participación de la
              ciudadanía.
            </p>
          </div>
        </div>
      </section>
      <section class="quotes">
        <div class="quotes-container">
          <!-- Quotes -->
          <div class="quote">
            <blockquote>
              Asesorías a los políticos y gobernantes dispuestos a impulsar la
              sostenibilidad dispuestos a llevar adelante una gestión al
              servicio de su ciudadanía desde el punto de vista de la
              gobernanza y el gobierno confiable basado en la calidad a partir
              del modelo de gestión de gobierno sostenible local de los
              estándares de las normas ISO para gobiernos.
            </blockquote>
            <p>QUÉ BRINDAMOS?</p>
          </div>

          <div class="quote">
            <blockquote>
              Proyectos innovadores en función de generar beneficios para la
              ciudad a partir de su gente, a partir de la participación
              ciudadana organizada y efectiva. Vivir en Ciudades dignas al
              servicio de las necesidades reales de la ciudadanía es posible,
              en “Gente y Ciudad” trabajamos para convertir los sueños
              colectivos en realidad.
            </blockquote>
            <p>QUÉ DESARROLLAMOS?</p>
          </div>
          <div class="quote">
            <blockquote>
              Para sumar a todo aquel dispuesto a brindar su mejor aporte para
              formar ciudadanos y comunicar cómo lograr esas ciudades
              sostenibles al servicio de la ciudadanía. Nos organizamos para
              poner en práctica todas las metodologías que hacen posible la
              sostenibilidad local, partimos de la base, desde la gente, para
              convertirla en ciudadano a partir de la formación y la
              comunicación estratégica, la sostenibilidad es posible si hay
              participación ciudadana y hay participación ciudadana si existen
              ciudadanos.
            </blockquote>
            <p>PARA QUÉ TRABAJAMOS?</p>
          </div>
        </div>
      </section>
      <!-- Nuestros Valores -->
      <!-- <div id="wrapper"> -->
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
              Todas las actuaciones de Gente & Ciudad estarán en consonancia
              con sus valores institucionales.
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

      <!-- </div> -->
    </main>
  </div>
  <form action="nosotros.php" method="post">
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