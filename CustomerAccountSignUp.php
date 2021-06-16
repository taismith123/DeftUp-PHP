<?php
require_once "config.php";

// declare and initialize variables
$username = $password = $confirmPass = "";
$usernameError = $passwordError = $confirmPassError = "";

// process info when page is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // verify username using regex pattern
    if(empty(trim($_POST["username"]))){
        $usernameError = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $usernameError = "Your username can only contain numbers, letters, and underscores.";
    } else{
        // create a select statement and connect to link database
        $sql = "SELECT id FROM customers WHERE username = ?";
       $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $user);

            $user = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $usernameError = "Sorry, this username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    // verify user's password
    if(empty(trim($_POST["password"]))){
        $passwordError = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $passwordError = "Your password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    //  verify user's confirmed password
    if(empty(trim($_POST["confirm_password"]))){
        $confirmPassError = "Please confirm the password.";
    } else{
        $confirmPass = trim($_POST["confirm_password"]);
        if(empty($passwordError) && ($password != $confirmPass)){
            $confirmPassError = "The passwords did not match.";
        }
    }

    // search for errors before updating database
    if(empty($usernameError) && empty($passwordError) && empty($confirmPassError)){

        $sql = "INSERT INTO customers (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $user, $pass);


            $user = $username;
            //hash password
            $pass = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                // redirect customer to designated login page
                header("location: customerlogin.php");
            } else{
                echo "Sorry! Something went wrong. Please try again.";
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
    <title>Customer Account Sign Up</title>
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
    <h2>Customer Account Sign Up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($usernameError)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="errorMessages"><?php echo $usernameError; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="errorMessages"><?php echo $passwordError; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirmPassError)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmPass; ?>">
            <span class="errorMessages"><?php echo $confirmPassError; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="bt submit" value="Submit">
            <input type="reset" class="bt reset" value="Reset">
        </div>
        <p>Already have an account? <a href="customerlogin.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>