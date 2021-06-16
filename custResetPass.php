<?php
session_start();
require_once "config.php";

// if customer is not logged in, redirect him/her to designated login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: customerlogin.php");
    exit;
}

// declare and initialize variables
$newPassword = "";
$confirmPass = "";
$newPassError = "";
$confirmPassError = "";

// process info when page is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // verify user's new password
    if(empty(trim($_POST["new_password"]))){
        $newPassError = "Please enter the new password.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $newPassError = "Password must have at least 6 characters.";
    } else{
        $newPassword = trim($_POST["new_password"]);
    }

    // verify user's confirmed password
    if(empty(trim($_POST["confirm_password"]))){
        $confirmPassError = "Please confirm the password.";
    } else{
        $confirmPass = trim($_POST["confirm_password"]);
        if(empty($newPassError) && ($newPassword != $confirmPass)){
            $confirmPassError = "Passwords did not match.";
        }
    }

    // if no errors are found update the database
    if(empty($newPassError) && empty($confirmPassError)){
        // update new password in database
        $sql = "UPDATE customers SET password = ? WHERE id = ?";
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            $param_password = password_hash($newPassword, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){
                // password has been updated
                session_destroy();
                // redirect to customer login page
                header("location: customerlogin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again.";
            }


            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="Styles.css">
    <style>
        body{ font: 16px sans-serif; }
        .wrapper{ width: 350px; padding: 25px; }
    </style>
</head>
<body>
<div class = "container">
    <div class = "navigationbar">
        <div class = "left-side">
            <div class = "image-brand"><!-- LOGO-->
                <div> <img src="./img/DeftUp1.PNG" alt = "DeftUp" width="65" height="65"> </div>
            </div>
        </div>

        <div class = "right-side"> <!-- LINKS-->
            <div class = "link-navbar"> <a href = "homepage.html">Home</a> </div>
            <div class = "link-navbar"> <a href = "register.php">Register</a> </div>
            <div class = "link-navbar"> <a href = "categories.php"> Categories </a> </div>
            <div class = "link-navbar"> <a href = "AboutUs.html"> About Us </a> </div>
            <div class = "link-navbar"> <a href = "Help.html"> Help </a>  </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <h2>Reset Password</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="newPassword" class="form-control <?php echo (!empty($newPassError)) ? 'is-invalid' : ''; ?>" value="<?php echo $newPassword; ?>">
            <span class="errorMessages"><?php echo $newPassError; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control <?php echo (!empty($confirmPassError)) ? 'is-invalid' : ''; ?>">
            <span class="errorMessages"><?php echo $confirmPassError; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="bt submit" value="Submit">
            <a class="btn cancel" href="custWelcome.php">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>