<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: search.php");
            } else {
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
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
            <h2>Add User</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class='row'>
                    <div class='input-field col s12'>
                        <input type="text" name="username" id="username" class="validate">
                        <label for="username">Username</label>
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12'>

                        <input type="password" name="password" id="password" class="validate">
                        <label for="password">Password</label>
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12'>
                        <input type="password" name="confirm_password" id="confirm_password" class="validate">
                        <label for="confirm_password">Confirm Password</label>
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary" value="Submit">&nbsp;&nbsp;&nbsp;
                <a href="login.php" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>