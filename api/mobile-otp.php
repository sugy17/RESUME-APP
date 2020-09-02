<?php

if(!isset($_GET['otp'])&&isset($_GET['mobile'])){
    $key="_".$_GET['mobile'];
    //if(!isset($_SESSION[$key])){
        $_SESSION[$key] =0;
        $url = 'https://api.extraaedge.com/api/webhook/sendotp';
        //die('{"verified":0}');
        // Create a new cURL resource
        $ch = curl_init($url);
        $mobile=$_GET['mobile'];
        $payload='{"AuthToken": "CMR_AUTH_TOKEN","MobileNumber": "+91'.$mobile.'","OtpExpiryInMin": "5","OtpMessage": "Here is your OTP for Application Form ##OTP## is valid for 5 Minutes Only. Do not share OTP for security reasons. In case OTP has expired then use resend OTP option.","Source": "cmrform"}';
        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json",
        "Accept-Encoding: utf-8",
        "Accept-Language: en-US,en;q=0.9",
        "Connection: keep-alive",
        "Content-type: application/json",
        "Host: api.extraaedge.com",
        "Origin: https://cmrreg.extraaedge.com",
        "Referer: https://cmrreg.extraaedge.com/?inst=4",
        "Sec-Fetch-Dest: empty",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Site: same-site",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36"));
        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);
        //echo $result;
        // Close cURL resource
        curl_close($ch);
        die('{"verified":0}');
   // }
}
elseif(isset($_GET['otp'])&&isset($_GET['mobile'])){
    $key="_".$_GET['mobile'];
    if(!isset($_SESSION[$key])){
        die('{"msg":"illeagal request","verified":0}');
    }
    elseif($_SESSION[$key] == 1){
        die('{"msg":"already verified","verified":1}');
    }

    $url = 'https://api.extraaedge.com/api/webhook/otpVerify';
    // Create a new cURL resource
    $ch = curl_init($url);
    $mobile=$_GET['mobile'];
    $otp=$_GET['otp'];
    $payload='{"AuthToken": "CMR_AUTH_TOKEN","MobileNumber": "+91'.$mobile.'","Otp": "'.$otp.'","Source": "cmrform"}';
    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json",
    "Accept-Encoding: utf-8",
    "Accept-Language: en-US,en;q=0.9",
    "Connection: keep-alive",
    "Content-type: application/json",
    "Host: api.extraaedge.com",
    "Origin: https://cmrreg.extraaedge.com",
    "Referer: https://cmrreg.extraaedge.com/?inst=4",
    "Sec-Fetch-Dest: empty",
    "Sec-Fetch-Mode: cors",
    "Sec-Fetch-Site: same-site",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36"));
    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch); //*/ "{\"message\":\"otp_verified\",\"type\":\"success\"}" ; 
    if(strpos($result, 'success') !== false||strpos($result, 'already_verified') !== false){
        $_SESSION[$key] =1;
    }
    else{
        //echo $result;
        die('{"verified":0,"msg":"'.$result.'"}');
    }
    // Close cURL resource
    curl_close($ch);
}
else
    echo "sorry,url not found";
?>