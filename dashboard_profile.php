<?php
session_start();

// DB connection
include('php/db_connect.php');

if (isset($_SESSION['loggedin'])) {

    $user_id = $_SESSION['user_id'];
    $user_email =  $_SESSION['email'];
    //Get all added events via user id

    $sql = "SELECT * FROM users WHERE users.email_id= '$user_email'";

    $result = mysqli_query($conn, $sql);
    $myprofile = mysqli_fetch_assoc($result);

    // Image upload
    if (isset($_POST['upload'])) {
        $image = $_FILES['image_path']['name'] ?? $_POST['image_path_old'];

        $fileTmpPath = $_FILES['image_path']['tmp_name'];
        $fileName = $_FILES['image_path']['name'];
        $fileSize = $_FILES['image_path']['size'];
        $fileType = $_FILES['image_path']['type'];
        $fileNameCmps = explode(".", $image);
        $fileExtension = strtolower(end($fileNameCmps));

        // Image validation
        $newFileName = $image;
        // Allowed extensions
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );

        // Validate file input to check if is not empty
        if (empty($image)) {
            $response = array(
                "type" => "error",
                "message" => "Choose image file to upload."
            );
        }    // Validate file input to check if is with valid extension
        else if (!in_array($fileExtension, $allowed_image_extension)) {
            $response = array(
                "type" => "error",
                "message" => "Upload valid images. Only PNG, JPG and JPEG are allowed."
            );
        }    // Validate image file size
        else if (($fileSize > 20000000)) {
            $response = array(
                "type" => "error",
                "message" => "Image size exceeds 20MB"
            );
        } else {

            // directory in which the uploaded file will be moved
            $uploadFileDir = 'images/' . $image;

            $dest_path = $uploadFileDir;
            // echo $dest_path;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // success
                $sql = "UPDATE users SET image = '$image'
                        WHERE id = $user_id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn)) {
                    $_SESSION['msg'] = "Image uploaded successfully!";
                    header("refresh:0");
                } else {
                    // Failed to query
                    echo 'failed';
                }
            } else {
                $response = array(
                    "type" => "error",
                    "message" => "'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'"
                );
            }
        }
    }
} else {
    header('location: inicio.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<title></title>

<head>
    <?php require('php/header.php') ?>
    <!-- JS Validation -->
    <script src="js/profileFormValidations.js"></script>
</head>

<body class="font">
    <!--Top Navbar-->
    <?php require('php/top_navbar.php'); ?>

    <!--Side Navbar-->
    <?php require('php/side_navbar.php'); ?>

    <!-- Form -->
    <main id="main-panel" class="pd45">

        <!-- <h1>My Profile</h1> -->

        <fieldset class="fieldset">
            <!-- Image error -->
            <?php if (!empty($response)) : ?>
                <div class="alert <?php echo $response["type"]; ?>">
                    <?php echo $response["message"]; ?>
                </div>
            <?php endif ?>

            <?php if (isset($_SESSION['msg'])) : ?>
                <div id="alertbox1" class="alert success">
                    <?php echo $_SESSION['msg'];
                    unset($_SESSION['msg']); ?>
                </div>
            <?php endif ?>
            <div id="alertbox" class="alert success">
                The profile has been successfully edited!
            </div>
            <legend class="legend">Edit Profile</legend>

            <?php if ($myprofile) : ?>
                <form action='dashboard_profile.php' method='post' enctype='multipart/form-data'>
                    <div class="pic-container">

                        <?php if (!empty($myprofile['image'])) : ?>
                            <img id="profilePic" src="./images/<?php echo $myprofile['image'] ?>" alt="user" />
                        <?php else : ?>
                            <p>No image found</p>
                        <?php endif ?>

                        <div class="pic-upload">
                            <input type="hidden" name="image_path_old" value="<?php echo $myprofile['image']  ?>">
                            <input type="file" name="image_path">
                            <button name="upload" class="btn btn-primary">Upload</button>
                        </div>

                    </div>
                    <!-- if edit is disabled -->
                </form>
                <form>
                    <div class="form-container2">
                        <div class="row">
                            <div class="firstname-container w45">
                                <label for="txtFirstName"> Name</label>

                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['fullname']); ?></div>
                            </div>
                            <div class="email-container w45">
                                <label for="txtEmail">Email</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['email_id']); ?></div>
                            </div>


                        </div>
                        <div class="row">

                            <div class="phone-container w45">
                                <label for="txtPhone">Phone</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['phone']); ?></div>
                            </div>

                            <div class="address-container w45">
                                <label for="txtAddress">Address</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['address']); ?></div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="city-container w45">
                                <label for="txtCity">City</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['city']); ?></div>
                            </div>

                            <div class="country-container w45">
                                <label for="txtCountry">Country</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['country']); ?></div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="zip-container w45">
                                <label for="txtCity">Zip Code</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['zipcode']); ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="about-container w45">
                                <label for="txtAboutMe">About Me</label>
                                <div class="profileDisplay"> <?php echo htmlspecialchars($myprofile['about']); ?></div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my3" style="margin-left: 15px">
                            <a class="btn btn-primary" id="popup">Edit</a>
                        </div>
                    </div>
                </form>
            <?php endif; ?>

            <!-- Form Ends -->
        </fieldset>

    </main>
    <!-- Footer -->

    <?php require('php/footer.php') ?>
    <script src="js/footer.js"></script>

    <!-- Edit Modal -->
    <form name="profile" action="dashboard_profile.php" method="POST" onsubmit="return validateProfileForm()">
        <div id="myModal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Edit <span>Profile</span></h2>
                </div>
                <hr>
                <div class="modal-body">

                    <!-- Edit form starts here  -->

                    <!-- <div class="form-container2"> -->
                    <?php if ($myprofile) : ?>
                        <div class="row">
                            <div class="firstname-container w45">
                                <label for="txtFirstName"> Name</label>

                                <input type="text" id="txtFirstName" name="fullname" placeholder="First Name" value="<?php echo htmlspecialchars($myprofile['fullname']); ?>" required />
                            </div>

                            <div class="email-container w45">
                                <label for="txtEmail">Email</label>
                                <input type="email" id="txtEmail" name="email" placeholder="Email Id" value="<?php echo htmlspecialchars($myprofile['email_id']); ?>" disabled />
                            </div>

                        </div>
                        <div class="row">

                            <div class="phone-container w45">
                                <label for="txtPhone">Phone</label>
                                <input type="tel" id="txtPhone" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($myprofile['phone']); ?>" required />
                            </div>

                            <div class="address-container w45">
                                <label for="txtAddress">Address</label>
                                <input type="text" id="txtAddress" name="address" placeholder="Address" value="<?php echo htmlspecialchars($myprofile['address']); ?>" />
                            </div>

                        </div>

                        <div class="row">
                            <div class="city-container w45">
                                <label for="txtCity">City</label>
                                <input type="text" id="txtCity" name="city" placeholder="City" value="<?php echo htmlspecialchars($myprofile['city']); ?>" />
                            </div>

                            <div class="country-container w45">
                                <label for="txtCountry">Country</label>
                                <input type="text" id="txtCountry" name="country" placeholder="Country" value="<?php echo htmlspecialchars($myprofile['country']); ?>" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="zip-container w45">
                                <label for="txtCity">Zip Code</label>
                                <input type="text" id="txtCity" name="zipcode" placeholder="Zip Code" value="<?php echo htmlspecialchars($myprofile['zipcode']); ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="about-container w45">
                                <label for="txtAboutMe">About Me</label>
                                <textarea type="text" id="txtAboutMe" name="about" placeholder="About Me"><?php echo htmlspecialchars($myprofile['about']); ?> </textarea>
                            </div>
                        </div>

                    <?php endif; ?>
                    <!-- </div> -->

                    <!-- Edit form ends here  -->
                </div>
                <hr>
                <div class="modal-footer">
                    <button class="btn btn-primary" name="update" type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        // function editFunction(){

        console.log("hello");
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the element that opens the modal
        var editprofile = document.getElementById("popup");
        // 

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        editprofile.onclick = function() {
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
        // }

        // function Editfunction() 
        //     {
        //         document.getElementById("editForm");
        //     }
    </script>

    <?php

    if (isset($_POST['update'])) {

        if (array_filter($errors)) {
            // show errors
        } else {

            //form is valid and send to db

            $name = mysqli_real_escape_string($conn, $_POST['fullname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $country = mysqli_real_escape_string($conn, $_POST['country']);
            $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
            $about = mysqli_real_escape_string($conn, $_POST['about']);



            // sql insert
            $sql = "UPDATE users
                        SET fullname='$name',phone='$phone',address='$address',city='$city',country='$country',zipcode='$zipcode',about='$about'
                        WHERE email_id= '$user_email'";

            // save to db and confirm
            if (mysqli_query($conn, $sql)) {

                echo '<script type="text/javascript">        
            document.getElementById("alertbox").style.display = "block";                 
            </script> ';
                header('location: dashboard_profile.php');
            } else {
                echo 'Failed to save in DB';
                echo mysqli_error($conn);
            }
            echo '<script type="text/javascript">        
            location.reload == -1;   
            </script> ';
        }
    }

    // DB close    
    include('php/db_close.php');

    ?>
</body>

</html>