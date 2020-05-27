<?php
session_start();

// DB connection
include('../php/db_connect.php');

// Include CRUD file
include('crud.php');

if (isset($_SESSION['loggedin'])) {
    // Check if role = admin
    if (strtolower($_SESSION['role']) == 'admin') {
        $users = '';
        // Get all events
        $sql = "SELECT e.*,u.id as user_id, u.fullname as manager, u.email_id, u.role 
                FROM events e 
                INNER JOIN users u on u.id = e.manager_id";
        $result = mysqli_query($conn, $sql);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Get all users from dropdown
        $sql = "SELECT * from users";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            // Get event by id
            $sql = "SELECT e.*,u.id as user_id, u.fullname as manager, u.email_id, u.role FROM events e 
            INNER JOIN users u on u.id = e.manager_id
            WHERE e.id = $id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $event = mysqli_fetch_assoc($result);
                $name = $event['name'];
                $description = $event['description'];
                $location = $event['location'];
                $date = date('Y-m-d', strtotime($event['date']));
                $ticket_cost = $event['ticket_cost'];
                $manager_id = $event['manager_id'];
                $image_path = $event['image_path'];
                $image_description = $event['image_description'];
            }
        }
    } else {
        // Unauthorized to view
        echo 'Unauthorized!';
    }
} else {
    // logout
    header('location: ../php/logout.php');
}
//TODO JS to set empty image upload
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add/Edit Event</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,800&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/b48c79d594.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../ciudad.css" />
    <script src="../js/createEventValidations.js"></script>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require_once('../php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require_once('../php/side_navbar.php'); ?>
    <main id="main-panel" class="pd45">
        <header class="text-center mt-3">
            <h1 class="my3">Events</h2>
        </header>
        <section class="events-container">
            <?php if (isset($_SESSION['msg'])) : ?>
                <div class="alert success my3">
                    <?php echo $_SESSION['msg'];
                    unset($_SESSION['msg']); ?>
                </div>
            <?php endif ?>
            <!-- Image error -->
            <?php if (!empty($response)) : ?>
                <div class="alert <?php echo $response["type"]; ?>">
                    <?php echo $response["message"]; ?>
                </div>
            <?php endif ?>
            <div class="limiter">
                <!-- Events table -->
                <div class="container-table100">
                    <?php if (empty($events)) : ?>
                        <div class="no-events">
                            <h2 class="text-center">No events added</h2>
                            <div class="event-container my3">
                                <a href="dashboard_events.php">Click here to create a new event..</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="wrap-table100">
                            <div class="table">
                                <form action='create-event.php' method='post'>
                                    <div class="add-event mb3">
                                        <button id="popup" class="btn btn-success" type="button">Add <i class="fas fa-plus"></i></button>
                                    </div>

                                    <div style="overflow-x: auto">
                                        <div class="row header">
                                            <div class="cell">
                                                Name
                                            </div>
                                            <div class="cell">
                                                Date
                                            </div>
                                            <div class="cell">
                                                Location
                                            </div>
                                            <div class="cell">
                                                Manager
                                            </div>
                                            <div class="cell text-center">
                                                <i class="fas fa-lg fa-edit"></i>
                                            </div>
                                            <div class="cell text-center">
                                                <i class="fas fa-lg fa-trash-alt"></i>
                                            </div>
                                            <div class="cell text-center">
                                                Feedback
                                            </div>
                                        </div>
                                        <?php foreach ($events as $event) : ?>
                                            <div class="row">
                                                <div class="cell" data-title="Event Name">
                                                    <?php echo $event['name'] ?>
                                                </div>
                                                <div class="cell" data-title="Date">
                                                    <?php echo date('Y-m-d', strtotime($event['date'])); ?>
                                                </div>
                                                <div class="cell" data-title="Location">
                                                    <?php echo $event['location'] ?>
                                                </div>
                                                <div class="cell" data-title="Manager">
                                                    <?php echo $event['manager'] ?>
                                                </div>
                                                <div class="cell text-center" data-title="Edit Event">
                                                    <a href="create-event.php?edit=<?php echo $event['id'] ?>" class="btn btn-primary">Edit</a>
                                                </div>
                                                <div class="cell text-center" data-title="Delete Event">
                                                    <a href="create-event.php?delete=<?php echo $event['id'] ?>" onclick="return confirm('Are you sure you want to delete \'<?php echo $event['name'] ?>\'')" class="btn btn-danger">Delete</a>
                                                </div>
                                                <div class="cell text-center" data-title="Feedback">
                                                    <a href="event-reviews.php?id=<?php echo $event['id'] ?>" class="btn btn-info">Feedback</a>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </form>
                                <h3 class="text-center my3">Total events: <?php echo count($events) ?></h3>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section>
    </main>
    <!--Edit-->
    <div id="myModal">
        <div class="modal-content">
            <form action='create-event.php' method='post' enctype='multipart/form-data'>
                <div class="modal-header">
                    <div class="input-group">
                        <span class="close">&times;</span>
                        <h2>Edit <span>Event</span></h2>
                    </div>
                </div>
                <hr>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="image_path_old" value="<?php echo $image_path; ?>">
                    <div class="col2">
                        <div class="input-group">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $name ?>">
                        </div>

                        <div class="input-group">
                            <label>Location</label>
                            <input type="text" name="location" value="<?php echo $location ?>">
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Description</label>
                        <textarea id="edit" type="text" name="description">
                        <?php echo htmlspecialchars_decode($description) ?>
                        </textarea>
                    </div>
                    <div class="col2">
                        <div class="input-group">
                            <label>Date</label>
                            <input type="date" name="date" value="<?php echo $date ?>">
                        </div>
                        <div class="input-group">
                            <label>Ticket Cost</label>
                            <input type="number" placeholder="Can be 0" name="ticket_cost" value="<?php echo $ticket_cost ?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="col2">
                            <label>Manager ID:</label>
                            <input type="text" name="manager_id" value="<?php echo $manager_id ?>">
                        </div>
                    </div>
                    <div class="col2">
                        <div class="input-group">
                            <label>Image Path</label>
                            <input type="file" name="image_path" value="<?php echo $image_path ?>">
                        </div>
                        <div class="input-group">
                            <label>Image Caption</label>
                            <input type="text" name="image_description" value="<?php echo $image_description ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <div class="input-group">
                        <button class="btn btn-primary" type="submit" name="update">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Add-->
    <div id="myModalAdd">
        <div class="modal-content">
            <!-- <form action='create-event.php' method='post' enctype='multipart/form-data'> -->
            <form name="createEventForm" action='create-event.php' method='post' enctype='multipart/form-data' onsubmit="return validateCreateEventForm()">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Add <span>Event</span></h2>
                </div>
                <hr>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input type="hidden" name="size" value="1000000">
                    <div class="col2">
                        <div class="input-group">
                            <label>Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="input-group">
                            <label>Location</label>
                            <input type="text" name="location" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Description</label>
                        <input id="add" type="text" name="description">
                    </div>
                    <div class="col2">
                        <div class="input-group">
                            <label>Date</label>
                            <input type="date" name="date" required>
                        </div>
                        <div class="input-group">
                            <label>Ticket Cost</label>
                            <input type="text" name="ticket_cost">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="col2">
                            <label>Manager:</label>
                            <select class="" name="manager">
                                <option value="" disabled selected hidden>Choose a user</option>
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['fullname'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="input-group">
                            <label>Image Path</label>
                            <input type="file" name="image_path">
                        </div>
                        <div class="input-group">
                            <label>Image Caption</label>
                            <input type="text" name="image_description">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <div class="input-group">
                        <button class="btn btn-success" type="submit" name="save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../js/footer.js" type="text/javascript"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModalAdd");

        // Get the element that opens the modal
        var addBtn = document.getElementById("popup");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[1];

        // When the user clicks the button, open the modal 
        addBtn.onclick = function() {
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
    </script>
    <script src="https://cdn.tiny.cloud/1/gkly1t79xzatwd68jh9hbn9ilihxod8wc9zbt0jobmbuuvfi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#add',
            min_height: 200,
            placeholder: 'Add decription..'
        });
        tinymce.init({
            selector: '#edit',
            min_height: 200,
            placeholder: 'Add description..'
        });
    </script>
</body>
<?php

if (isset($_GET['edit'])) {
    echo "<script>
            eventModal();
            </script>
    ";
}

// DB close        
include('../php/db_close.php');
?>

</html>