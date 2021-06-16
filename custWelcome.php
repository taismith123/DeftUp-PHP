<?php
session_start();

//direct customer to login page if he/she is not logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: customerlogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="Styles.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        span { color: #fe5900;}
        p {
            display: flex;
            justify-content: space-evenly;
            padding: 20px;
        }

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
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to DEFT<span>UP</span>!</h1>
<p>
    <a href="custResetPass.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn signout">Sign Out of Your Account</a>
</p>
</body>
</html>