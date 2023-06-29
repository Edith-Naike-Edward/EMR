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
  $MedName = $_POST['MedName'];
  $Dosage = $_POST['Dosage'];
  $Instruction = $_POST['Instruction'];
  $PrescriptionNotes = $_POST['PrescriptionNotes'];
  $PatientEmail = $_POST['PatientEmail'];
  $DiagnosisID = $_POST['DiagnosisID'];

  // Validate PatientEmail
  if (empty($PatientEmail)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($PatientEmail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  if (empty($errors)) {
    $sqli = "INSERT INTO prescription (MedName, Dosage, Instruction, PrescriptionNotes, PatientEmail, DiagnosisID) 
            VALUES ('$MedName', '$Dosage', '$Instruction', '$PrescriptionNotes', '$PatientEmail', '$DiagnosisID')";
    
    if (mysqli_query($con, $sqli)) {
      header("Location: diagnosistable.php?msg=Prescription made successfully");
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
