<nav class="navbar">
    <a onclick="openNav()"><i class="fas fa-lg fa-bars"></i></a>
    <?php if ($_SESSION['loggedin']) { ?>
        <?php if (strtolower($_SESSION['role']) == 'customer') : ?>
            <span class="dropdown">
                <a class="dropbtn float-right" onclick="myFunction()" style="text-transform: capitalize;"><i class="fas fa-user"></i>&ensp;<?php echo $_SESSION['fullname'] ?>&ensp; <i class="fa fa-caret-down"></i>
                </a>
                <div class="dropdown-content" id="myDropdown">
                    <!-- <a href="dashboard_profile.php">My Profile</a>
                    <a href="added-events.php">My Events</a> -->
                    <a href="php/logout.php" title="Logout">Logout</a>
                </div>
            </span>
        <?php else : ?>
            <span class="dropdown">
                <a class="dropbtn float-right" onclick="myFunction()" style="text-transform: capitalize;"><i class="fas fa-user"></i>&ensp;<?php echo $_SESSION['fullname'] ?>&ensp; <i class="fa fa-caret-down"></i>
                </a>
                <div class="dropdown-content" id="myDropdown">
                    <a href="../php/logout.php" title="Logout">Logout</a>
                </div>
            </span>
        <?php endif ?>
    <?php } else {
        header('location: inicio.php');
    } ?>
</nav>