<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: search.php");
  exit;
}

// Include config file
require_once "include/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username like '$username' COLLATE utf8mb4_bin";
    
    if ($result = mysqli_query($link, $sql)) {
        // Check if username exists, if yes then verify password
        //$row=mysqli_fetch_row($result);
        if ($row=mysqli_fetch_row($result)) {
            if (password_verify($password, $row[2])) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;

              // Redirect user to welcome page
              header("location: search.php");
            } else {
              // Display an error message if password is not valid
              $password_err = "Incorrect password";
            }
        } else {
          // Display an error message if username doesn't exist
          $username_err = "User name dosent exist!";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.".mysqli_error($link);
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
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
  <script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
</head>

<body>
  <nav>
    <div class="nav-wrapper">
      <a href="#!" style="padding: 0px 0px 0px 7px;" class="brand-logo left"><i class="material-icons">cloud</i>Resume Portal</a>
    </div>
  </nav>

  </head>

  <body>
    <div class="section"></div>
    <main>
      <center>
        <img class="responsive-img" style="width: 150px;" src="https://i.pinimg.com/originals/88/6b/15/886b1598b09c5c588004570c4fd1e28c.gif" />
        <div class="section"></div>

        <div class="section"></div>

        <div class="container">
          <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;width:500px;">
            <h3 class="indigo-text">Login</h3>
            <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class='row'>
                <div class='col s12'>
                </div>
              </div>

              <div class='row'>
                <div class='input-field col s12'>
                  <input class='validate' type='text' name='username' id='username' />
                  <label for='username'>Enter your username</label>
                  <span class="help-block"><?php echo $username_err; ?></span>
                </div>
              </div>

              <div class='row'>
                <div class='input-field col s12'>
                  <input class='validate' type='password' name='password' id='password' />
                  <label for='password'>Enter your password</label>
                  <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <!--<label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label>-->
              </div>

              <br />
              <center>
                <div class='row'>
                  <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo' value="Login">Login</button>
                </div>
              </center>
            </form>
          </div>
        </div>
      </center>

      <div class="section"></div>
      <div class="section"></div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
  </body>

</html>