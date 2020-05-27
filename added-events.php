<?php
session_start();

// DB connection
include('php/db_connect.php');

if (isset($_SESSION['loggedin'])) {

    $user_id =  $_SESSION['user_id'];

    //Get all added events via user id
    $sql = "SELECT e.id as event_id, e.name as event_name, e.description, e.location, e.date, e.ticket_cost, e.manager_id, e.image_path, p.id as participant_id, p.user_id 
	FROM participants p
    INNER JOIN events e ON e.id = p.event_id
    WHERE p.user_id = " . $user_id . "
    ORDER BY e.date DESC";

    $result = mysqli_query($conn, $sql);
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // 
    if (isset($_GET['event_id']) && isset($_GET['participant_id'])) {
        $event_id = $_GET['event_id'];
        $participant_id = $_GET['participant_id'];
    }
    // Feedback submission
    if (isset($_POST['submit'])) {
        $event_id = $_POST['event_id'];
        $participant_id = $_POST['participant_id'];
        $rating = $_POST['star'];
        $comment = htmlspecialchars($_POST['comment']);
        $posted_on = date("Y-m-d H:i:s");

        // SQL insert
        $sql = "INSERT into review (rating, feedback, event_id, participant_id, posted_on) 
                VALUES ($rating, '$comment', $event_id, $participant_id, '$posted_on')";

        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['msg'] = "Feedback saved. Thank you!";
            header('location: added-events.php');
        }
    }
} else {
    header('location: inico.php');
}

// DB close    
include('php/db_close.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('php/header.php') ?>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require('php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require('php/side_navbar.php'); ?>
    <main id="main-panel" class="pd45">
        <header class="text-center mt-3">
            <h1 class="my3">My Events</h2>
        </header>
        <section class="events-container">
            <div id="alertbox" class="alert success my3">
                Event deleted successfully.
            </div>
            <div class="limiter">
                <div class="container-table100">
                    <?php if (empty($events)) : ?>
                        <div class="no-events">
                            <h2 class="text-center">No events found :/</h2>
                            <div class="event-container my3">
                                <a href="dashboard_events.php">Click here to add events..</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="wrap-table100">
                            <div class="table">
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
                                        <i class="fas fa-lg fa-comments"></i>
                                    </div>
                                    <div class="cell">
                                        <i class="fas fa-lg fa-trash-alt"></i>
                                    </div>
                                    <div class="cell">
                                        <i class="fas fa-lg fa-comment-alt"></i>
                                    </div>
                                </div>
                                <?php foreach ($events as $event) : ?>
                                    <div class="row">
                                        <div class="cell" data-title="Event Name">
                                            <?php echo $event['event_name'] ?>
                                        </div>
                                        <div class="cell" data-title="Date">
                                            <?php echo  date('d M Y', strtotime($event['date'])) ?>
                                        </div>
                                        <div class="cell" data-title="Location">
                                            <?php echo $event['location'] ?>
                                        </div>
                                        <div class="cell" data-title="Discussion Board">
                                            <a href="discussion.php?event_id=<?php echo $event['event_id'] ?>" type="submit" class="btn btn-primary">Discussion</a>
                                        </div>
                                        <div class="cell" data-title="Remove Event">
                                            <a href="php/delete.php?event_id=<?php echo $event['event_id'] ?>&participant_id=<?php echo $event['participant_id'] ?>" name="delete" type="submit" class="btn btn-danger">Delete</a>
                                        </div>
                                        <div class="cell" data-title="Feedback">
                                            <a href="added-events.php?event_id=<?php echo $event['event_id'] ?>&participant_id=<?php echo $event['participant_id'] ?>" class="btn btn-info">Feedback</a>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <h3 class="text-center my3">Total events: <?php echo count($events) ?></h3>

                    <?php endif ?>
                </div>
            </div>
            <div id="myModal">
                <form action="added-events.php" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Add <span>Feedback</span></h2>
                        </div>
                        <br>
                        <hr>
                        <div class="modal-body">
                            <div class="my3">
                                <input type="hidden" name="event_id" value="<?php echo $event_id ?>">
                                <input type="hidden" name="participant_id" value="<?php echo $participant_id ?>">
                            </div>
                            <div class="stars my3">
                                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                                <label class="star star-1" for="star-1"></label>
                            </div>
                            <div class="feedback-comment my3">
                                <textarea id="commentarea" name="comment"></textarea>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="modal-footer">
                            <div class="submit-button my3">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="https://cdn.tiny.cloud/1/gkly1t79xzatwd68jh9hbn9ilihxod8wc9zbt0jobmbuuvfi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#commentarea',
            min_height: 300,
            placeholder: 'Add comment here..'
        });
    </script>

    <!--Footer-->
    <?php require('php/footer.php') ?>
    <script src="js/footer.js"></script>
    <!-- <script>
        // Get the modal
        var modal = document.getElementById("myModal");

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
    </script> -->

    <?php
    if (isset($_SESSION['deleted'])) {
        echo '<script type="text/javascript">        
                document.getElementById("alertbox").style.display = "block";        
                </script> ';
        unset($_SESSION['deleted']);
    }
    if (isset($_GET['event_id']) && isset($_GET['participant_id'])) {
        $event_id = $_GET['event_id'];
        $participant_id = $_GET['participant_id'];
        echo '<script type="text/javascript">        
                eventModal();        
            </script> ';
    }
    ?>
</body>

</html>