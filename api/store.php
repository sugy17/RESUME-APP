<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION["_".$_REQUEST['mobile']])||!$_SESSION["_".$_REQUEST['mobile']] ){
	die("MOBILE NUMBER NOT VERIFIED");
}


$uid=$_REQUEST['uid'];
if(!isset($uid))
    die("bad request");    

/////         ADD MOBILE dob_m


function reCaptcha($recaptcha)
{
	$secret = "6LdrTK0ZAAAAAN0W8CdwYFXtWiRt2X1ItOvQ9sx1";
	$ip = $_SERVER['REMOTE_ADDR'];

	$postvars = array("secret" => $secret, "response" => $recaptcha, "remoteip" => $ip);
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	$data = curl_exec($ch);
	curl_close($ch);
	return json_decode($data, true);
}

$recaptcha = $_REQUEST['g-recaptcha-response'];
$res = reCaptcha($recaptcha);
if (!$res['success']) {
	// Error
	echo "<h1>ReCaptcha Error This site is resistant to bots!!</h1>";
	return;
}


include('../include/config.php');

foreach ($_GET as $key => $value) {
	if(!$value)
		$_GET[$key]='';
}

echo "### DEBUG INFO ###";
// Escape user inputs for security
$uid=mysqli_real_escape_string($link, $_REQUEST['uid']);
$post_id = mysqli_real_escape_string($link, $_REQUEST['post_id']);
$department = mysqli_real_escape_string($link, $_REQUEST['department']);
$title_select = mysqli_real_escape_string($link, $_REQUEST['title-select']);
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$gender_select = mysqli_real_escape_string($link, $_REQUEST['gender-select']);
$dob = mysqli_real_escape_string($link, $_REQUEST['dob']);

if(!$dob)
	$dob = mysqli_real_escape_string($link, $_REQUEST['dob_m']);

$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$mobile = mysqli_real_escape_string($link, $_REQUEST['mobile']);
$marks_10 = mysqli_real_escape_string($link, $_REQUEST['marks_10']);
$marks_12 = mysqli_real_escape_string($link, $_REQUEST['marks_12']);
$yearofpassing_10 = mysqli_real_escape_string($link, $_REQUEST['yearofpassing_10']);
$yearofpassing_12 = mysqli_real_escape_string($link, $_REQUEST['yearofpassing_12']);
$degree_ug = mysqli_real_escape_string($link, $_REQUEST['degree_ug']);
$university_ug = mysqli_real_escape_string($link, $_REQUEST['university_ug']);
$branch_ug = mysqli_real_escape_string($link, $_REQUEST['branch_ug']);
$marks_ug = mysqli_real_escape_string($link, $_REQUEST['marks_ug']);
$yearofpassing_ug = mysqli_real_escape_string($link, $_REQUEST['yearofpassing_ug']);
$degree_pg = mysqli_real_escape_string($link, $_REQUEST['degree_pg']);
$university_pg = mysqli_real_escape_string($link, $_REQUEST['university_pg']);
$branch_pg = mysqli_real_escape_string($link, $_REQUEST['branch_pg']);
$marks_pg = mysqli_real_escape_string($link, $_REQUEST['marks_pg']);


if ($marks_pg == '') $marks_pg = 0;
$yearofpassing_pg = mysqli_real_escape_string($link, $_REQUEST['yearofpassing_pg']);
if ($yearofpassing_pg == '') $yearofpassing_pg = 0;
$university_phd = mysqli_real_escape_string($link, $_REQUEST['university_phd']);
$part_fulltime = mysqli_real_escape_string($link, $_REQUEST['part_fulltime']);
$areaofspecialization = mysqli_real_escape_string($link, $_REQUEST['areaofspecialization']);
$status = mysqli_real_escape_string($link, $_REQUEST['status']);
$status_others = mysqli_real_escape_string($link, $_REQUEST['status_others']);
$yearofcompletion_phd = mysqli_real_escape_string($link, $_REQUEST['yearofcompletion_phd']);
if ($yearofcompletion_phd == '') $yearofcompletion_phd = 0;
$yearofreg_phd = mysqli_real_escape_string($link, $_REQUEST['yearofreg_phd']);
if ($yearofreg_phd == '') $yearofreg_phd = 0;
$total_exp_years = mysqli_real_escape_string($link, $_REQUEST['total_exp_years']);
$total_exp_months = mysqli_real_escape_string($link, $_REQUEST['total_exp_months']);
$teaching_exp_years = mysqli_real_escape_string($link, $_REQUEST['teaching_exp_years']);
$teaching_exp_months = mysqli_real_escape_string($link, $_REQUEST['teaching_exp_months']);
$non_teaching_exp_years = mysqli_real_escape_string($link, $_REQUEST['non-teaching_exp_years']);
$non_teaching_exp_months = mysqli_real_escape_string($link, $_REQUEST['non-teaching_exp_months']);

if($status == '') $status=7;
if($part_fulltime == '') $part_fulltime=7;


echo "post_id :" . $post_id ."<br>" ;
echo "department" . $department . "<br>" ;
echo "title_select :" . $title_select ."<br>" ;
echo " name:" . $name ."<br>" ;
echo " gender_select:" . $gender_select ."<br>" ;
echo " dob:" . $dob ."<br>" ;
echo " email:" . $email ."<br>" ;
echo " mobile:" . $mobile ."<br>" ;
echo " marks_10:" . $marks_10 ."<br>" ;
echo " marks_12:" . $marks_12 ."<br>" ;
echo "yearofpassing_10 :" . $yearofpassing_10 ."<br>" ;
echo "yearofpassing_12 :" . $yearofpassing_12 ."<br>" ;
echo " degree_ug:" . $degree_ug ."<br>" ;
echo " university_ug:" . $university_ug ."<br>" ;
echo "branch_ug :" . $branch_ug ."<br>" ;
echo "marks_ug :" . $marks_ug ."<br>" ;
echo "yearofpassing_ug:" . $yearofpassing_ug ."<br>" ;
echo "degree_pg :" . $degree_pg ."<br>" ;
echo " university_pg:" . $university_pg ."<br>" ;
echo "branch_pg :" . $branch_pg ."<br>" ;
echo " marks_pg:" . $marks_pg ."<br>";
echo "yearofpassing_pg :" . $yearofpassing_pg ."<br>" ;
echo "university_phd :" . $university_phd ."<br>" ;
echo " part_fulltime:" . $part_fulltime ."<br>" ;
echo "areaofspecialization:" . $areaofspecialization ."<br>" ;
echo " status:" . $status ."<br>" ;
echo "status_others:".$status_others."<br>";
echo "yearofcompletion_phd :" . $yearofcompletion_phd ."<br>" ;
echo "yearofreg_phd :" . $yearofreg_phd ."<br>" ;
echo " total_exp_years:" . $total_exp_years ."<br>" ;
echo "total_exp_months :" . $total_exp_months ."<br>" ;
echo " teaching_exp_years:" . $teaching_exp_years ."<br>" ;
echo "teaching_exp_months :" . $teaching_exp_months ."<br>" ;
echo " non_teaching_exp_years:" . $non_teaching_exp_years ."<br>" ;
echo " non_teaching_exp_months:" . $non_teaching_exp_months."<br><br>" ;

// Check if file uplaoded



$size = $_FILES["resume_file"]["size"];
//echo $size;
if ($size > 5) {
	//query execution
	$fileType2 = strtolower(pathinfo(basename($_FILES["resume_file"]["name"]), PATHINFO_EXTENSION));
	$target_file2 = "uploads/resume/$uid.$fileType2";
	echo $target_file2."<br><br>";
	if ($fileType2 == "pdf" || $fileType2 == "doc" || $fileType2 == "docx") {
		//query execution
		$fileType1 = strtolower(pathinfo(basename($_FILES["photo"]["name"]), PATHINFO_EXTENSION));
		$target_file1 = "uploads/photo/$uid.$fileType1";
		echo $target_file1."<br><br>";
		if ($fileType1 == "png" || $fileType1 == "jpeg" ||  $fileType1 == "jpg") {
            $sql= "INSERT INTO application (application_date,application_time,uid, post_id, department) VALUES(curdate(),curtime(),$uid,$post_id,'$department') ON DUPLICATE KEY UPDATE    
            application_date=curdate(),application_time=curtime(),seen=0,department='$department'";
			echo $sql."<br><br>";
			if ($result = mysqli_query($link, $sql)) {
				if (mysqli_error($link)) {
					//rollback
					echo "ERROR: Could not execute $sql. " .mysqli_error($link);
				} else {
                    $sql = "Update applicant set title_select='$title_select' ,name='$name',gender_select='$gender_select',dob='$dob',email='$email',mobile='$mobile',marks_10=$marks_10,marks_12=$marks_12,yearofpassing_10=$yearofpassing_10 ,yearofpassing_12=$yearofpassing_12 ,degree_ug='$degree_ug',university_ug='$university_ug',branch_ug='$branch_ug' ,marks_ug=$marks_ug ,yearofpassing_ug=$yearofpassing_ug,degree_pg='$degree_pg' ,university_pg='$university_pg',branch_pg='$branch_pg' ,marks_pg=$marks_pg,yearofpassing_pg=$yearofpassing_pg ,university_phd='$university_phd' ,part_fulltime=$part_fulltime,areaofspecialization='$areaofspecialization',status=$status,status_others='$status_others',yearofcompletion_phd=$yearofcompletion_phd ,yearofreg_phd=$yearofreg_phd ,total_exp_years=" . (floatval($total_exp_years) + floatval($total_exp_months) / 12) . ",teaching_exp_years=" . (floatval($teaching_exp_years) + floatval($teaching_exp_months) / 12) . ",non_teaching_exp_years=" . (floatval($non_teaching_exp_years) + floatval($non_teaching_exp_months) / 12) . ",resume='$target_file2',photo='$target_file1' where uid=$uid";
					echo $sql."<br><br>";
					if (mysqli_query($link, $sql)) {
						if(file_exists($target_file2)) unlink($target_file2);
						move_uploaded_file($_FILES["resume_file"]["tmp_name"], $target_file2);
						if(file_exists($target_file1)) unlink($target_file1);
						move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file1);
						echo "Stored your info successfully.You will soon be hearing from us.<br><br>";
						//$_SESSION["Submited"]=1;
						session_unset();
						// destroy the session
						session_destroy();
					} else echo "ERROR: Could not execute $sql. " . mysqli_error($link);
				}
			} else echo "ERROR: Could not execute $sql. " . mysqli_error($link);			
		} else echo "pls uplaod image in png or jpeg or jpg format only";
	} else echo "pls uplaod in pdf / doc / docx format";
} else echo "File is not uploaded.";

// Close connection
mysqli_close($link);
