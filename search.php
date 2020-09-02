<?php session_start();
// If there is no username, they are logged out, so show them the login link
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>
<html>
<style>
    .main-loader {
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        background-color: rgba(255, 255, 255, 0.5);
    }

    html {
        overflow-y: scroll;
        scroll-behavior: smooth;
    }

    body {
        background-image: url('assets/logo.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-width: 900px;
        background-size: 100% 100%;
        opacity: 0.95;
    }

    body label {
        color: black;
        font-size: 13px;
    }


    .outside {
        border: none;
        height: 70%;
        white-space: pre;
    }

    .download {
        background-color: DodgerBlue;
        border: none;
        color: white;
        padding: 5px 5px;
        cursor: pointer;
        font-size: 15px;
    }

    /* Darker background on mouse-over */
    .download:hover {
        background-color: RoyalBlue;
    }

    table {
        border-collapse: collapse;
        border-collapse: separate;
        border-spacing: 0 15px;

    }

    tbody tr:hover {
        border: 2px solid black;
        background-color: #cce6ff;


    }

    tbody tr {
        max-width: 750px;
        height: 50px;

        border: 2px solid rgba(24, 34, 45, 0.4);

    }

    thead tr {
        background-color: #e6ffcc;
        max-width: 750px;
        margin: 2rem auto;
        border: 2px solid #e74c3c;

    }

    img {
        max-width: 100%;
        max-height: 100%;

    }

    .portrait {
        height: 100%;
        width: 100%;
        max-width: 60px;
    }
</style>

<head>

    <title>Resume Portal-Home</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->

    <script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
    <script src="javascript/search.js"></script>
</head>

<body>
    <div class="main-loader" id="loading" style="display:none">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo left" style="padding: 0px 0px 0px 7px;"><i class="material-icons">cloud</i>Resume Portal</a>
            <ul id="nav-mobile" class="right ">
                <li><a href="logout.php"><i class="material-icons right">exit_to_app</i>logout</a></li>
                <li><a href="reset-password.php"><i class="material-icons right">build</i>reset password</a></li>
                <li><a href="register.php"><i class="material-icons right">accessibility</i>add user</a></li>
                <li><a href="search.php"><i class="material-icons right">refresh</i>refresh</a></li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container" style="width:100% !important">
        <div class="z-depth-4 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 85px 48px; border: 1px solid #EEE;width:100%;">
            <!--List items begins here-->
            <div id="row-container" style="width:100% !important">
                <div class="row">
                    <div class="col s5"><label class="right">Select type:<br>(default:ALL) </label></div>
                    <div class="col s2">
                        <!--First List items-->
                        <label>
                            <input type="checkbox" id="new-tick" class="filled-in" value="0" name="seen" />
                            <span>UNSEEN</span>
                        </label>
                    </div>
                    <div class="col s3">
                        <!--First List items-->
                        <label>
                            <input type="checkbox" id="old-tick" class="filled-in" value="1" name="seen" />
                            <span>SEEN</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3"><label class="right">APPLICATION DATE:</label></div>
                    <div class="input-field col l3 m3 s6 ">
                        <label for="from">FROM DATE:</label>
                        <input id="from" name="from" min="2020-01-01" type="text" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                    </div>
                    <div class="input-field col l3 m3 s6 ">
                        <label for="to">TO DATE:</label>
                        <input id="to" name="to" min="2020-01-01" type="text" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                    </div>
                    <div class="col s1 l1 m1 hide-on-small-only"></div>
                    <div class="col l2 m2 s12">
                        <!--First List items-->
                        <label>Logical operator</label>
                        <select class="browser-default" name="operator">
                            <option value="AND">AND</option>
                            <option value="OR">OR</option>
                        </select>
                    </div>
                </div>
            </div>
            <p align="center"> <a class="waves-effect waves-light btn" name="search_button" id="search_button" onclick="page=0;hide_back();fillTable();"><i class="material-icons right">search</i>search</a></p>
            <br>
            <ul class="pagination left" id="pagination_top" style="display:none">
                <li class="waves-effect" style="display:none" id="pagination_top_<"><a onclick="previouspage()"><i class="material-icons">chevron_left</i></a></li>
                <li style="cursor:default;" class="active"><a id="page_no_top">page : 1</a></li>
                <li class="waves-effect" id="pagination_top_>"><a onclick="nextpage()"><i class="material-icons">chevron_right</i></a></li>
            </ul>
            <table id="result_table" style="display:none">
                <thead>
                    <tr>
                        <th class="outside"></th>
                        <th class="outside"></th>
                        <th>App-ID</th>
                        <th>Name</th>
                        <th>Post</th>
                        <th>UG MARKS</th>
                        <th>PG MARKS</th>
                        <th>Experience</th>
                        <th>Resume</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <ul class="pagination left" id="pagination_bottom" style="display:none">
                <li class="waves-effect" style="display:none" id="pagination_bottom_<"><a onclick="previouspage()"><i class="material-icons">chevron_left</i></a></li>
                <li style="cursor:default;" class="active"><a id="page_no_bottom">page : 1</a></li>
                <li class="waves-effect" id="pagination_bottom_>"><a onclick="nextpage()"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>
</body>

</html>