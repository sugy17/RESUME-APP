<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    html {
        overflow-y: scroll;
    }

    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

    body {
        background-image: url('assets/logo.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        opacity: 0.95;
    }


    .input-field input[type=date]:focus+label,
    .input-field input[type=text]:focus+label,
    .input-field input[type=email]:focus+label,
    .input-field input[type=password]:focus+label {
        color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
        border-bottom: 2px solid #e91e63;
        box-shadow: none;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#!" style="padding: 0px 0px 0px 7px;" class="brand-logo left"><i class="material-icons">cloud</i>Resume Portal</a>
            <ul id="nav-mobile" class="right ">
                <li><a href="logout.php"><i class="material-icons right">exit_to_app</i>logout</a></li>
                <li><a href="reset-password.php"><i class="material-icons right">build</i>reset password</a></li>
                <li><a href="register.php"><i class="material-icons right">accessibility</i>add user</a></li>
                <li><a href="search.php"><i class="material-icons right">home</i>home</a></li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 100px 48px; border: 1px solid #EEE;width:800px;">
            <h2>Reset Password</h2>
            <p>Please fill out this form to reset your password.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class='row'>
                    <div class='input-field col s12'>
                        <input type="password" name="new_password" id="new_password" class='validate' value="<?php echo $new_password; ?>">
                        <label for="new_password">New Password</label>
                        <span class="help-block"><?php echo $new_password_err; ?></span>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12'>
                        <input class='validate' type="password" name="confirm_password" id='confirm_password'>
                        <label for="confirm_password">Confirm Password</label>
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-link" href="search.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>