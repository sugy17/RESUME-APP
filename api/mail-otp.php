<?php


// API URL
$url = 'https://api.sendgrid.com/v3/mail/send';

// Create a new cURL resource
$ch = curl_init($url);
$email="sugy17cs@cmrit.ac.in";
$SENDGRID_API_KEY = "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";
$payload = '{"personalizations": [{"to": [{"email": "'.$email.'"}]}],"from": {"email": "watchfactory23@gmail.com","name":"cmr group"},"subject": "Sending with SendGrid is Fun","content": [{"type": "text/plain", "value": "and easy to do anywhere, even with cURL"}]}';

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $SENDGRID_API_KEY"));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);
echo $result;
// Close cURL resource
curl_close($ch);


// $rndno=rand(100000, 999999);//OTP generate
// $message = urlencode("otp number.".$rndno);
// //$to=$_POST['email'];
// $subject = "OTP";
// $txt = "OTP: ".$rndno."";
// $headers = "From: otp@studentstutorial.com";
// mail("sugy17cs@cmrit.ac.in",$subject,$txt,$headers);
?>
