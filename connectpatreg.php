<?php
//create server and database connection constants
$host = "localhost";
$user = "root";
$pwd = "";
$db = "projectemrsystem";

//Database connection
$con = new mysqli('localhost','root','','projectemrsystem');
if ($con->connect_error){
 // echo "$conn->connect_error";
	die ("Connection failed:". $con->connect_error);
}else {
	echo "Connected successfully <br />";
}

   if(isset($_POST['submit'])){
      $firstName=trim($_POST['firstName']);
      $lastName= trim($_POST['lastName']);
      $dob= trim($_POST['dob']);
      $email= trim($_POST['email']);
      // Validate PatientEmail
      //$PatientEmail = trim($_POST['PatientEmail']);
      if (empty($email)) {
          $errors[] = "Email is required.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = "Invalid email format.";
      }
      $mobileNumber= trim($_POST['mobileNumber']);
      $gender= trim($_POST['gender']);
      $occupation= trim($_POST['occupation']);
      $postalAddress= trim($_POST['postalAddress']);
      $physicalAddress= trim($_POST['physicalAddress']);
      $nok_first_name= trim($_POST['nok_first_name']);
      $nok_last_name= trim($_POST['nok_last_name']);
      $nok_relation= trim($_POST['nok_relation']);
      $nok_phone= trim($_POST['nok_phone']);
      $nok_email= trim($_POST['nok_email']);

      $uid = isset($_REQUEST["uid"]) ? $_REQUEST["uid"]:"";
      $checkEmailQuery = "SELECT * FROM patientsignup WHERE patientemail='$email'";
      $check= mysqli_query($con, $checkEmailQuery);
      //$check2= mysqli_query($con, $checkemailQuery);
      $sqli ="INSERT INTO patient(PatientFirstName,
      PatientLastName, PatientDOB, PatientEmail, PatientPhoneNo, Gender, Occupation, PhysicalAddress, PostalAddress,
      NKFirstName, NKLastName, NKrelation, NKPhoneNo, NKEmail) 
      VALUES('$firstName','$lastName','$dob','$email','$mobileNumber','$gender',
      '$occupation','$postalAddress','$physicalAddress', '$nok_first_name','$nok_last_name',
      '$nok_relation','$nok_phone','$nok_email')";

      if ($con) {
        if (mysqli_num_rows($check)> 0 && $email==$uid) {
          if (mysqli_query($con, $sqli)) {
            echo 'You have registered';
        } else {
            echo 'You have not registered: ' . mysqli_error($con);
        }
      } else {
        echo 'Registration email should be the same as signup/login email.';
      }
    } else {
      echo 'Connection failed.';
    }
    }
      mysqli_close($con);   
?>