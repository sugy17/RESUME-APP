<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<style>
    html {
        min-width: 384px;
    }

    .form>label {
        float: left;
        clear: right;
    }

    .form>input {
        float: right;
    }

    img {
        max-width: 100%;
        max-height: 100%;
        align-content: center !important;
    }

    .portrait {
        height: 100px;
        width: 100px;
        align-self: center !important;

    }

    ul.stepper.horizontal {
        min-height: 100%;
        height: 100%;
        overflow-y: visible !important;
    }

    #toast-container {
        min-width: 60% !important;
        max-width: 60% !important;
        top: 10%;
        left: 20% !important;
        right: 20% !important;
        width: 50% !important;
        position: fixed;
        display: block !important;
        align-self: center !important;
        text-align: center !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .main-loader {
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: 1010;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.7);
    }
</style>

<head>
    <meta charset="utf-8">
    <title>Resume Portal-Apply</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <!-- <link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css"
        media="screen,projection" /> -->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
    <link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script> -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div id="modal1" class="modal" style="max-width: 400px;min-width: 300px;">
        <div class="modal-content center">
            <h4>Mobile Verification</h4>
            <div id="otp-form">
                Please enter 4 digit OTP sent to Your Mobile Number.We want to make sure it's you before we can contact you.
                <div class="row">
                    <input type="text" id="otp_inp" maxLength="4" size="4" class="validate center" placeholder="Enter the OTP" pattern="[0-9]{4}" required>
                    <span id="otp-info" data-wrong="otp entered is incorrect! please enter the correct otp" class="helper-text"></span>
                    <!-- <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" /> -->
                </div>

                <div class="row">
                    <button id="regenerate-otp" class="waves-effect waves-dark btn red" onClick="generateOTP();">Resend</button>
                    <!-- &nbsp; -->
                    <button id="submit-otp" class="waves-effect waves-dark btn green" onClick="verifyOTP();">Submit</button>

                    <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>			 -->
                </div>
            </div>
            <p>Otp is valid for 5 minutes,click on resend if not recieved within 5 minutes.</p>
        </div>
        <!-- <div class="modal-footer">
           
        </div> -->
    </div>
    <div class="error"></div>
    <div class="success"></div>

    <br><br>
    <div class="container">

        <!-- <div class="col s12"> -->

        <div class="card">
            <div class="card-content">

                <form method="post" action="api/store.php" name="my-form" onsubmit="return submit_form()" enctype="multipart/form-data">
                    <div class="card-content">
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
                        <ul class="stepper linear" id="horizontal">
                            <li class="step">
                                <div class="step-title waves-effect waves-dark">Select Post</div>
                                <div class="step-content">
                                    <div class="row">
                                        <input type="text" id="selpost-req" style="display:none" required />
                                        <div class="col l6 m6 s12">
                                            <div class="card ">
                                                <div class="card-content black-text">
                                                    <span class="card-title">Teaching</span>
                                                    <p></p>
                                                </div>
                                                <div class="card-action" id="teaching-posts">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col l2 m2">
                                          <p class="center">
                                        OR     
                                        </p> 
                                    </div> -->
                                        <div class="col l6 m6 s12">
                                            <div class="card ">
                                                <div class="card-content black-text">
                                                    <span class="card-title">Non Teaching</span>
                                                    <p></p>
                                                </div>
                                                <div class="card-action" id="non-teaching-posts">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <!-- <div class=" input-field col l2 m3 s5"> -->
                                            <!-- <label for="department">prefered department:</label> -->
                                            <select id="department" name="department" class="browser-default" required>
                                                <option value="" disabled selected value>--Prefered Department--</option>
                                                <option value="ISE">ISE</option>
                                                <option value="CSE">CSE</option>
                                                <option value="Civil">Civil</option>
                                                <option value="ME">ME</option>
                                                <option value="EEE">EEE</option>
                                                <option value="Architecture">Architecture</option>
                                                <option value="MCA">MCA</option>
                                            </select>
                                        <!-- </div>     -->
                                    </div>
                                    <div class="step-actions">
                                        <button class="waves-effect waves-dark btn blue next-step" style="display:none" name="next-step">Next</button>
                                        <button class="waves-effect waves-dark btn blue" onclick="checkSelectPost();checkActive(false)">Proceed</button>
                                    </div>
                                </div>
                            </li>
                            <li class="step" >
                                <div class="step-title waves-effect waves-dark">Personal info
                                </div>
                                <div class="step-content">
                                    <div class="row">

                                        <div class="input-field  col l5 s12">
                                            <i class="material-icons prefix">email</i>
                                            <input id="email" name="email" type="email" class="validate" required>
                                            <label class="active" for="email">Your E-mail</label>
                                            <!-- <span class="helper-text left" data-error="invalid email" data-success="">Helper text</span> -->
                                        </div>
                                        <div class="input-field col l5 s12">
                                            <i class="material-icons prefix">phone</i>
                                            <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>
                                            <label class="active" for="mobile">Mobile number:</label>
                                            <!-- <span class="helper-text left" data-error="wrong" data-success="right">Helper text</span> -->
                                        </div>
                                        <div class="col s4 hide-on-large-only"></div>
                                        <div class="input-field col l2 s3">
                                            <button onclick="generateOTP();" id="verify-button" class="waves-effect waves-dark btn modal-trigger green">Verify</button>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col s4 hide-on-med-and-up"></div>
                                        <div class="input-field col l2 m3 s5">
                                            <label for="title"></label>
                                            <select id="title" name="title-select" class="browser-default" required>
                                                <option value="" disabled selected value>--Title--</option>
                                                <option value="Mr">Mr.</option>
                                                <option value="Ms">Ms.</option>
                                                <option value="Dr">Dr.</option>
                                            </select>
                                        </div>
                                        <div class="input-field col l4 m9 s12">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input type="text" id="name" style="text-transform: uppercase;" name="name" onkeyup="this.value = this.value.toUpperCase();" required>
                                            <label class="active" for="name">Name:</label>
                                        </div>
                                        <div class="input-field col l6 m6 s12">
                                            <div class="row">
                                                <!-- <label for="photo">Photo:</label><br> -->
                                                <div class="input-field col l6 m6 s12">
                                                    Photo : Accepted formats- <b>JPEG / PNG with size less than 1MB</b>:
                                                    <input type="file" name="photo" id="photo" accept=".jpeg ,.png" required>
                                                </div>
                                                <div class="input-field col l6 m6 s12">
                                                    <div class="portrait">
                                                        <img id="blah" style="display:none" src="#" alt="your image" class="circle responsive-img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l3 m3 hide-on-med-and-down"></div>
                                        <div class="input-field col l3 m3 s6">
                                            <label for="gender"></label>
                                            <!-- <span class="left">gender:</span> -->
                                            <select id="gender" name="gender-select" class="browser-default" required>
                                                <option value="" disabled selected value>--Gender--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>

                                        </div>
                                        <div class="input-field col l3 m3 s6 scale-transition">
                                            <label for="dob">DOB:</label>

                                            <!-- make required on not required on different devices -->
                                            <input id="dob" name="dob" min="1920-01-01" type="text" class="hide-on-small-only" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" >
                                            <label class="hide-on-med-and-up" for="dob_m">DOB:</label>
                                            <input id="dob_m" type="date" name="dob_m" min="1920-01-01" class="hide-on-med-and-up">
                                            <script>
                                                var d = new Date();
                                                dob.max = new Date( d.getFullYear() - 15, d.getMonth(), d.getDate()).toISOString().split("T")[0];
                                                dob_m.max=dob.max;
                                                //dob.max = c.toISOString().split("T")[0];
                                            </script>
                                        </div>
                                    </div>
                                    <div class="step-actions">
                                        <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                        <button class="waves-effect waves-dark btn blue next-step" style="display:none" name="next-step" type="submit">Next</button>
                                        <button class="waves-effect waves-dark btn blue" value="check_active" onclick="checkActive(true);">Next</button>
                                    </div>
                                </div>
                            </li>
                            <li class="step" >
                                <div class="step-title waves-effect waves-dark">Academics & Career</div>
                                <div class="step-content">
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="marks_10">10th marks (%):</label>
                                            <input type="number" step="0.01" id="marks_10" name="marks_10" min="0" max="100" required>
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="marks_12">12th marks (%):</label>
                                            <input type="number" step="0.01" id="marks_12" name="marks_12" min="0" max="100" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="yearofpassing_10">Year-of-Passing-10th:</label>
                                            <input type="number" id="yearofpassing_10" name="yearofpassing_10" required>
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="yearofpassing_12">Year-of-Passing-12th:</label>
                                            <input type="number" id="yearofpassing_12" name="yearofpassing_12" pattern="[1-2][0-9]{3}" required>
                                        </div>
                                    </div>

                                    <!-- <label for="undergraduate">
                                UnderGraduate:<small><small><br>*required*</small></small>
                            </label> -->
                                    <div class="row">
                                        <div class="input-field col l6 m6 s12">
                                            <label for="degree_ug">UG Degree:</label>
                                            <input type="text" id="degree_ug" name="degree_ug">
                                        </div>
                                        <div class="input-field col l6 m6 s12">
                                            <label for="university_ug">UG University:</label>
                                            <input type="text" id="university_ug" name="university_ug">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l12 m12 s12">
                                            <label for="branch_ug">UG Branch/Area of Specialization:</label>
                                            <input type="text" id="branch_ug" name="branch_ug">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="marks_ug">UG percentage : </label>
                                            <input type="number" step="0.01" id="marks_ug" name="marks_ug" min="0" max="100">
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="yearofpassing_ug">Year-of-Passing(UG):</label>
                                            <input type="number" id="yearofpassing_ug" name="yearofpassing_ug" pattern="[1-2][0-9]{3}">
                                        </div>
                                    </div>
                                    <!-- 
                            <label for="postgraduate">
                                PostGraduate:<small><small><br>*fill only if applicable*</small></small>
                            </label> -->
                                    <div class="row">
                                        <div class="input-field col l6 m6 s12">
                                            <label for="degree_pg">PG Degree:</label>
                                            <input type="text" id="degree_pg" name="degree_pg">
                                        </div>
                                        <div class="input-field col l6 m6 s12">
                                            <label for="university_pg">PG University:</label>
                                            <input type="text" id="university_pg" name="university_pg">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l12 m12 s12">
                                            <label for="branch_pg">PG Branch/Area of Specialization:</label>
                                            <input type="text" id="branch_pg" name="branch_pg">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="marks_pg">PG percentage : </label>
                                            <input type="number" step="0.01" id="marks_pg" name="marks_pg" min="0" max="100">
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="yearofpassing_pg">Year-of-Passing(PG):</label>
                                            <input type="number" id="yearofpassing_pg" name="yearofpassing_pg" pattern="[1-2][0-9]{3}">
                                        </div>
                                    </div>
                                    <!-- 
                            <label for="phd">
                                Ph.D:<small><small><br>*fill only if applicable*</small></small>
                            </label> -->
                                    <div class="row">
                                        <div class="input-field col l6 m6 s12">
                                            <label for="university_phd">phD University:</label>
                                            <input type="text" id="university_phd" name="university_phd">
                                        </div>
                                        <div class="input-field col l3 m3 s6">
                                            <label>
                                                <input type="radio" class="with-gap" id="parttime" name="part-fulltime" value="0">
                                                <span>part-time
                                                </span></label>
                                        </div>
                                        <div class="input-field  col l3 m3 s6">
                                            <label>
                                                <input type="radio" class="with-gap" id="fulltime" name="part-fulltime" value="1">
                                                <span>Full-time
                                                </span></label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col l12 m12 s12">
                                            <label for="areaofspecialization">Ph.D Area of Specialization:</label>
                                            <input type="text" id="areaofspecialization" name="areaofspecialization">
                                        </div>
                                    </div>
                                    <div class="row">Status:</div>
                                    <div class="row">
                                        <div class="  col l4 m4 s12">
                                            <label>
                                                <input type="radio" class="with-gap" id="pursing" name="status" value="0" onclick="createInputForOthers();document.getElementById('yearofcomp').style.display='none';document.getElementById('yearofcompletion_phd').required=false">
                                                <span>Ongoing
                                                </span></label>
                                        </div>
                                        <div class=" col l4 m4 s12">
                                            <label>
                                                <input type="radio" class="with-gap" id="completed" name="status" value="1" onclick="createInputForOthers();document.getElementById('yearofcomp').style.display='';document.getElementById('yearofcompletion_phd').required=true">
                                                <span>Completed
                                                </span></label>
                                        </div>
                                        <div class="  col l4 m4 s12">
                                            <label>
                                                <input type="radio" class="with-gap" id="phd_status" name="status" value="2" onclick="createInputForOthers();document.getElementById('yearofcomp').style.display='none';document.getElementById('yearofcompletion_phd').required=false">
                                                <span>Others(specify)
                                                </span></label>
                                        </div>
                                    </div>
                                    <div class="row" style="display:none" id="status_textbox">
                                        <div class="input-field  col l12 m12 s12">
                                            <label for="status_others">status details</label>
                                            <input type="text" id="status_others" name="status_others" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l6 m6 s12">
                                            <label for="yearofreg_phd">Year-of-registration:</label>
                                            <input type="number" id="yearofreg_phd" name="yearofreg_phd" pattern="[1-2][0-9]{3}">
                                        </div>
                                        <div class="input-field col l6 m6 s12" id="yearofcomp" style="display:none">
                                            <label for="yearofcompletion_phd">Year-of-completion-phD:</label>
                                            <input type="number" id="yearofcompletion_phd" name="yearofcompletion_phd" pattern="[1-2][0-9]{3}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <h2>Career summary</h2> -->
                                        Total Work Experience:
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="total_exp_years">Number of years:</label>
                                            <input type="number" id="total_exp_years" name="total_exp_years" value=0 min=0>
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="total_exp_months">Number of months:</label>
                                            <input type="number" id="total_exp_months" name="total_exp_months" value=0 min=0>
                                        </div>
                                    </div>
                                    Teaching Work Experience:
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="teaching_exp_years">Number of years:</label>
                                            <input type="number" id="teaching_exp_years" name="teaching_exp_years" value=0 min=0>
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="teaching_exp_months">Number of months:</label>
                                            <input type="number" id="teaching_exp_months" name="teaching_exp_months" value=0 min=0>
                                        </div>
                                    </div>
                                    Non-Teaching Work Experience:
                                    <div class="row">
                                        <div class="input-field col l6 m6 s6">
                                            <label for="non-teaching_exp_years">Number of years:</label>
                                            <input type="number" id="non-teaching_exp_years" name="non-teaching_exp_years" value=0 min=0>
                                        </div>
                                        <div class="input-field col l6 m6 s6">
                                            <label for="non-teaching_exp_months">Number of months:</label>
                                            <input type="number" id="non-teaching_exp_months" name="non-teaching_exp_months" value=0 min=0>
                                        </div>
                                    </div>
                                    <div class="step-actions">
                                        <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                        <button class="waves-effect waves-dark btn blue next-step" style="display:none" name="next-step">Next</button>
                                        <button class="waves-effect waves-dark btn blue" onclick="checkActive(true)">Next</button>
                                    </div>
                                </div>
                            </li>
                            <li class="step">
                                <div class="step-title waves-effect waves-dark">Resume</div>
                                <div class="step-content center">
                                    <h2>Upload Resume</h2>
                                    <div class="row">
                                        <div class="col l12 m12 s12">
                                            Accepted formats- <b>PDF / doc / docx with size less than 1MB</b>:
                                            <input type="file" name="resume_file" id="resume_file" accept=".doc,.docx,.pdf" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <center>
                                            <div class="g-recaptcha" id="g-recaptcha" data-callback="recaptcha_callback" data-expired-callback="captcha_expired_callback" data-sitekey="6LdrTK0ZAAAAACtSto97TiC6ygyniTkxmiZH3a9z"></div>
                                        </center>
                                    </div>
                                    <br>
                                    <!-- <div class="step-actions"> -->
                                    <input type="hidden" id="uid" name="uid" value="-1">
                                    <button class="waves-effect waves-dark btn blue" value="submit" type="submit">SUBMIT</button>
                                    <!-- </div> -->
                                </div>
                            </li>
                        </ul>
                </form>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <!-- page content -->
    <script src="javascript/form.js"></script>
</body>

</html>