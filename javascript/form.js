getAvaliablePosts();


function generateOTP() {
    //display loading
    event.preventDefault();
    if (!(document.getElementById('email').reportValidity() && document.getElementById('mobile').reportValidity()))
        return;
    xhttp_ctr += 1;
    display_loading();
    var mob = document.getElementById('mobile').value;
    var email = document.getElementById('email').value;
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            if (data['verified'] == 0) {
                M.Modal.getInstance(document.getElementById('modal1')).open();
                m_verified = 0;
            } else {
                //activate verified
                m_verified = 1;
                document.getElementById('uid').value = data['uid'];
                document.getElementById('verify-button').innerHTML = "Verified";
            }
            xhttp_ctr -= 1;
            display_loading();
        }
    };
    xhttp.open("GET", "api/get-uid.php?mobile=" + mob + "&email=" + email, true);
    xhttp.send();
}

function verifyOTP() {
    var mob = document.getElementById('mobile').value;
    var email = document.getElementById('email').value;
    var otp = document.getElementById('otp_inp').value;
    if(!document.getElementById('otp_inp').reportValidity())
        return;
    xhttp_ctr += 1;
    display_loading();
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            xhttp_ctr -= 1;
            display_loading();
            try{
                var data = JSON.parse(this.responseText);
                if (data['verified'] == 1) {
                    //success
                    m_verified = 1;
                    try{
                    M.Modal.getInstance(document.getElementById('modal1')).close();
                    }
                    catch(err){}
                    document.getElementById('uid').value = data['uid'];
                    //change button to verified
                    document.getElementById('verify-button').innerHTML = "Verified";
                    //fillDetails(data);
                } else {
                    //fail
                    m_verified = 0;
                    alert("Entered incorrect otp!!Please enter the correct otp");
                }
            }
            catch(err){
                m_verified = 0;
                alert("Entered incorrect otp!!Please enter the correct otp"+err.message);
            }
        }
    };
    xhttp.open("GET", "api/get-uid.php?mobile=" + mob + "&otp=" + otp + "&email=" + email, true);
    xhttp.send();
}

function fillDetails(data) {
    for (var i in data) {
        //alert(data[i]);
    }
}

function ifPostStillAvaliable() {

}





var m_verified = 0;

document.getElementById('blah').style.display = "none";

var stepper = document.querySelector('.stepper');
var stepperInstace = new MStepper(stepper, {
// options
firstActive: 0 // this is the default
})

function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function(e) {
    $('#blah').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]); // convert to base64 string
}
}

$("#photo").change(function() {
readURL(this);
});


document.addEventListener('DOMContentLoaded', function() {
M.Modal.init(document.getElementById('modal1'), {
opacity: 0.7
});
});
//         $(document).ready(function() {
//       alert("document ready occurred!");
// });

function createInputForOthers() {
var chkYes = document.getElementById("phd_status");
var status_textbox = document.getElementById("status_textbox");
status_textbox.style.display = chkYes.checked ? "" : "none";
document.getElementById("status_others").required = chkYes.checked
}

var enableSubmit = false;

function recaptcha_callback() {
enableSubmit = true;
}

function captcha_expired_callback() {
enableSubmit = false;
}

function submit_form() {
if (!enableSubmit) {
event.preventDefault();
alert("Please fill captcha!!");
} else if (m_verified != 1) {
event.preventDefault();
alert("Please Verify Mobile number!!");
}
}
var resumeUploadField = document.getElementById("resume_file");

resumeUploadField.onchange = function() {
if (this.files[0].size > 1048576) {
alert("File is too big! Size has to be < 1MB");
this.value = "";
};
};

var imageUploadField = document.getElementById("photo");
imageUploadField.onchange = function() {
if (this.files[0].size > 1048576) {
alert("File is too big! Size has to be < 1MB");
document.getElementById('blah').style.display = "none";
this.value = "";
} else
document.getElementById('blah').style.display = "";

};


function getAvaliablePosts() {
var ui_holder = {
'teaching': document.getElementById("teaching-posts"),
'non-teaching': document.getElementById("non-teaching-posts")
};
var xhttp;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    var data = JSON.parse(this.responseText);
    var ctr = 0;
    for (var i in data) {
        ctr += 1
        post_type = data[i]['teaching'] == 0 ? 'non-teaching' : 'teaching';
        ui_holder[post_type].innerHTML += ('<div class="row"> \
                            <a class="left"><label for="' + data[i]['post_id'] + '">\
                                <input type="radio" onchange="removeRequired()" class="with-gap"\
                                    id="' + data[i]['post_id'] + '"\
                                     value="' + data[i]['post_id'] + '" name="post_id">\
                                <span>' + data[i]['post_select'] + '\
                                </span></label></a>\
                        </div>')
    }
}
};
xhttp.open("GET", "api/get-posts.php", true);
xhttp.send();
}


function checkActive(verifyMob) {
event.preventDefault();
eles = document.getElementsByClassName('step active')[0].getElementsByTagName('input');
for (var ele in eles) {
try {
    if (!eles[ele].reportValidity())
        return;
    //console.log(eles[ele].name, eles[ele].reportValidity());
} catch (err) {

}
}
eles = document.getElementsByClassName('step active')[0].getElementsByTagName('select');
for (var ele in eles) {
try {
    if (!eles[ele].reportValidity())
        return;
    //console.log(eles[ele].name + eles[ele].reportValidity());
} catch (err) {

}
}
if(verifyMob && !m_verified){
alert("verify mobile number first!!");
return;
}
document.getElementsByClassName('step active')[0].getElementsByClassName('next-step')[0].click();
}

function removeRequired(){
document.getElementById('selpost-req').required = false;
}

function checkSelectPost() {
event.preventDefault();
eles = document.getElementsByTagName('input');
for (var i in eles)
if (eles[i].checked) {
    document.getElementById('selpost-req').required = false;
    document.getElementsByClassName('step active')[0].getElementsByClassName('next-step')[0].click();
    return;
}
M.toast({
html: '<center>Please select a post to continue!<center>',
classes: 'rounded center'
});

}


var xhttp_ctr = 0;

async function display_loading() {
if (xhttp_ctr == 0) {
await new Promise(r => setTimeout(r, 350));
document.getElementById('loading').style.display = "none";
//console.log("stop loading");
} else {
document.getElementById('loading').style.display = "";
//console.log("start loading");
}
}

//         $(function() {
//   'use strict';

//   var body = $('#otp-form');

//   function goToNextInput(e) {
//     var key = e.which,
//       t = $(e.target),
//       sib = t.next('input');

//     if (key != 9 && (key < 48 || key > 57)) {
//       e.preventDefault();
//       return false;
//     }

//     if (key === 9) {
//       return true;
//     }

//     if (!sib || !sib.length) {
//       sib = body.find('input').eq(0);
//     }
//     sib.select().focus();
//   }

//   function onKeyDown(e) {
//     var key = e.which;

//     if (key === 9 || (key >= 48 && key <= 57)) {
//       return true;
//     }

//     e.preventDefault();
//     return false;
//   }

//   function onFocus(e) {
//     $(e.target).select();
//   }

//   body.on('keyup', 'input', goToNextInput);
//   body.on('keydown', 'input', onKeyDown);
//   body.on('click', 'input', onFocus);

// })


