<?php
session_start();
require_once "config.php";

// direct customer to the login page if they are already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: custWelcome.php");
    exit;
}

// declare and initialize variables
$username = "";
$password = "";
$userError = $passError = $loginError = "";

// process info when page is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if user doesn't enter a username, display error message
    if (empty(trim($_POST["username"]))) {
        $userError = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // if user doesn't enter a password, display error message
    if (empty(trim($_POST["password"]))) {
        $passError = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // search for username and password errors before updating database
    if (empty($userError) && empty($passError)) {
        //connect to database
        $sql = "SELECT id, username, password FROM customers WHERE username = ?";
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $user);

            $user = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // if username exists, verify the password
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashPassword);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashPassword)) {
                            session_start();

                            // store info as session variables
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["loggedin"] = true;

                            // redirect user to welcome page
                            header("location: custWelcome.php");
                        } else {
                            // display error message if password doesn't exist
                            $loginError = "Invalid username or password.";
                        }
                    }
                } else {
                    // display error message if username doesn't exist
                    $loginError = "Invalid username or password.";
                }
            } else {
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
    <title>Login</title>
    <link rel="stylesheet" href="Styles.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="navigationbar">
        <div class="left-side">
            <div class="image-brand"><!-- LOGO-->
                <div><img src="./img/DeftUp1.PNG" alt="DeftUp" width="65" height="65"></div>
            </div>
        </div>

        <div class="right-side"> <!-- LINKS-->
            <div class="link-navbar"><a href="homepage.html">Home</a></div>
            <div class="link-navbar"><a href="register.php">Register</a></div>
            <div class="link-navbar"><a href="categories.php"> Categories </a></div>
            <div class="link-navbar"><a href="AboutUs.html"> About Us </a></div>
            <div class="link-navbar"><a href="Help.html"> Help </a></div>
        </div>
    </div>
</div>

<div class="wrapper">
    <h2>Login</h2>
    <p>Please enter your credentials to login!</p>

    <?php
    if (!empty($loginError)) {
        echo '<div class="loginWarning">' . $loginError . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username"
                   class="form-control <?php echo (!empty($userError)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $username; ?>">
            <span class="errorMessages"><?php echo $userError; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"
                   class="form-control <?php echo (!empty($passError)) ? 'is-invalid' : ''; ?>">
            <span class="errorMessages"><?php echo $passError; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="bt submit" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</div>
</body>
</html>