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

if (isset($_POST["submit"])) {
  $TestDate = $_POST['TestDate'];
  $Testtype = $_POST['Testtype'];
  $TestResults = $_POST['TestResults'];
  $PatientEmail = $_POST['PatientEmail'];
  $DiagnosisID = $_POST['DiagnosisID'];

  // Validate PatientEmail
  if (empty($PatientEmail)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($PatientEmail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  if (empty($errors)) {
    $sqli = "INSERT INTO test (TestDate, Testtype, TestResults, PatientEmail, DiagnosisID) 
            VALUES ('$TestDate', '$Testtype', '$TestResults', '$PatientEmail', '$DiagnosisID')";
    
    if (mysqli_query($con, $sqli)) {
      header("Location: diagnosistable.php?msg=Test made successfully");
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
