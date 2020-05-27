<?php
session_start();

// DB connection
include('php/db_connect.php');

//Error array
$errors = array('comment' => '');
$participant = '';
$participant_id = '';

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['event_id'])) {
        //Variable initialization
        $user_id = $_SESSION['user_id'];
        $event_id = mysqli_real_escape_string($conn, $_GET['event_id']);
        $participant = '';
        $participant_id = '';

        // Get all comments via event id
        $sql = "SELECT u.fullname,u.email_id,u.location,u.image,dc.id as comment_id, dc.participant_id, dc.comment, dc.event_id, dc.date from discussion_comments dc
        INNER JOIN participants p ON p.id = dc.participant_id
        INNER JOIN users u ON u.id = p.user_id
        WHERE dc.event_id = " . $event_id . "
        ORDER BY dc.date ASC";

        $result = mysqli_query($conn, $sql);
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // print_r($comments);

        // No comments: Get participant id based on event id and user id

        $sql1 = "SELECT * FROM participants WHERE event_id = $event_id AND user_id = $user_id";
        $result1 = mysqli_query($conn, $sql1);
        $participant = mysqli_fetch_assoc($result1);
        $participant_id = htmlspecialchars($participant['id']);
        // echo $participant_id;

        // Get event details
        if (isset($_GET['event_id'])) {
            $event_id = $_GET['event_id'];
            $sql = "SELECT * FROM events where `id` = $event_id";
            $result = mysqli_query($conn, $sql);
            $event = mysqli_fetch_assoc($result);
        }
        if (isset($_POST['submit'])) {
            if (empty($_POST['comment'])) {
                $errors['comment'] = 'Comment cannot be empty';
            } else {
                $comment = htmlspecialchars($_POST['comment']);
                $date = htmlspecialchars(date("Y-m-d H:i:s"));

                if (!empty($participant)) {
                    $participant_id = $participant['id'];
                    $sql2 = "INSERT into discussion_comments (participant_id, comment, event_id, date) VALUES ($participant_id, '$comment', $event_id,  '$date')";
                    // echo $sql2;
                    if (mysqli_query($conn, $sql2)) {
                        header("refresh:0");
                    } else {
                        $errors['comment'] = "Error saving in DB.";
                    }
                } else {
                    // echo 'nope';
                    // die;
                }
            }
        } else {
            //echo 'Submission error';
        }
    } else {
        //if event id is not available
        header('Location: php/404.php');
    }
} else {
    header('location: ../inicio.php');
}
//TODO: Css, JS validation on textarea, wysiwyg editor

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('php/header.php') ?>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require_once('php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require_once('php/side_navbar.php'); ?>

    <main id="main-panel" class="pd45">
        <header class="event-head text-center">
            <div id="banner-image">
                <div class="banner-text">
                    <h1>
                        <?php echo htmlspecialchars($event['name']) ?>
                    </h1>
                </div>
            </div>
        </header>
        <div id="wrapper">
            <h1 class="text-center my3">Discussion Board</h1>
            <h3 class="my3">
                <i class="fas fa-map-marker-alt"></i><span>&ensp;<?php echo htmlspecialchars($event['location']) ?></span>
            </h3>
            <h4 class="mb3">
                <i class="fas fa-calendar-alt"></i><span>&ensp;<?php $date = strtotime($event['date']);
                                                                echo date('d F Y', $date);
                                                                ?></span>
            </h4>
            <section class="discussion-container">
                <form action="discussion.php?event_id=<?php echo $event_id ?>" method="post">
                    <?php if (!empty($comments)) : ?>
                        <ul>
                            <?php foreach ($comments as $comment) : ?>
                                <li class="chat-bubble">
                                    <div class="comment-user">
                                        <?php if (!empty($comment['image'])) : ?>
                                            <img src="images/<?php echo $comment['image']  ?>">
                                        <?php else : ?>
                                            <img src="https://picsum.photos/100">
                                        <?php endif ?>
                                    </div>
                                    <div class="comment-area">
                                        <h4><?php echo $comment['fullname'] ?></h4>
                                        <hr>
                                        <span><?php echo htmlspecialchars_decode($comment['comment'])  ?></span>
                                        <hr>
                                        <div>
                                            <small><?php echo date('d M y', strtotime($comment['date'])) ?></small>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <div class="my3">
                            <textarea name="comment" id="commentarea"></textarea>
                            <p style="color:brown;"><?php echo $errors['comment']  ?></p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </div>
                    <?php else : ?>
                        <div class="first-one text-center">
                            <h2 class="mb3">Hmm.. seems like no one is here. <i class="far fa-meh"></i></h2>
                            <h3>Be the first one to start the discussion <i class="far fa-smile-beam"></i></h3>
                        </div>
                        <div class="my3">
                            <textarea name="comment" id="commentarea"></textarea>
                            <p style="color:brown;"><?php echo $errors['comment']  ?></p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </div>
                    <?php endif ?>
                </form>
            </section>
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/gkly1t79xzatwd68jh9hbn9ilihxod8wc9zbt0jobmbuuvfi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#commentarea',
            min_height: 300,
            placeholder: 'Add comment here..'
        });
    </script>
    <!-- Footer -->
    <?php require('php/footer.php') ?>
    <script src="js/footer.js"></script>
    <?php
    if (isset($_GET['event_id'])) {

        echo "<script type='text/javascript'>
        var banner = document.getElementById('banner-image');
        banner.style.backgroundImage =
      \"url('images/" . $event['image_path'] . "')\";
      </script>";
    }
    // DB close    
    include('php/db_close.php');
    ?>
</body>

</html>