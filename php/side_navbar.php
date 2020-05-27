<aside class="sidenav" id="mySidenav">
    <a class="closebtn" onclick="closeNav()">&times;</a>
    <hr>
    <?php if (strtolower($_SESSION['role']) == 'admin') : ?>
        <a href="create-event.php"><i class="fas fa-fw fa-calendar-alt"></i>&ensp;&ensp;Manage Events</a>
        <hr>
        <a href="all-users.php"><i class="fas fa-fw fa-users"></i>&ensp;&ensp;View Customers</a>
        <hr>
        <a href="contact-queries.php"><i class="fas fa-fw fa-user"></i>&ensp;&ensp;Contact Issues</a>
        <hr>
    <?php else : ?>

        <a href="dashboard_events.php"><i class="fas fa-fw fa-calendar-alt"></i>&ensp;&ensp;Events</a>
        <hr>
        <a href="dashboard_profile.php"><i class="fas fa-fw fa-user"></i>&ensp;&ensp;My Profile</a>
        <hr>
        <a href="added-events.php"><i class="fas fa-fw fa-calendar-alt"></i>&ensp;&ensp;My Events</a>
        <hr>
        <a href="my-reviews.php"><i class="fas fa-fw fa-star"></i>&ensp;&ensp;My Reviews</a>
        <hr>
    <?php endif ?>
</aside>