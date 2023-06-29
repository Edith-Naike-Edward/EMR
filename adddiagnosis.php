<?php
session_start();

// Create server and database connection constants
$host = "localhost";
$user = "root";
$pwd = "";
$db = "projectemrsystem";
$con = new mysqli($host, $user, $pwd, $db);

// Check for connection errors
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

/*if (isset($_GET["id"])) {
  $apptID = $_GET["id"];
} else {
  die("ApptID not provided.");
}*/

if (isset($_POST["submit"])) {
  $DiagnosisDate = $_POST['DiagnosisDate'];
  $DiagnosisDescription = $_POST['DiagnosisDescription'];
  $DiagnosisNotes = $_POST['DiagnosisNotes'];
  $PreliminaryDiagnosis = $_POST['PreliminaryDiagnosis'];
  $ConfirmedDiagnosis = $_POST['ConfirmedDiagnosis'];
  $PatientEmail = $_POST['PatientEmail'];
  $ApptID = $_POST['ApptID'];

  // Validate PatientEmail
  if (empty($PatientEmail)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($PatientEmail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  if (empty($errors)) {
    $sqli = "INSERT INTO diagnosis (DiagnosisDate, DiagnosisDescription, DiagnosisNotes, PreliminaryDiagnosis, ConfirmedDiagnosis, PatientEmail, ApptID) 
            VALUES ('$DiagnosisDate', '$DiagnosisDescription', '$DiagnosisNotes', '$PreliminaryDiagnosis', '$ConfirmedDiagnosis', '$PatientEmail', '$ApptID')";
    
    if (mysqli_query($con, $sqli)) {
      header("Location: appttable.php?msg=Diagnosis made successfully");
      exit();
    } else {
      echo "Failed: " . mysqli_error($con);
    }
  } else {
    echo implode("<br>", $errors);
  }
}

mysqli_close($con);
?>
