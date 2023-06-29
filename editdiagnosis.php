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

if (isset($_GET["id"])) {
  $DiagnosisID = $_GET["id"];
} else {
  die("DiagnosisID not provided.");
}

if (isset($_POST["submit"])) {
  $DiagnosisDate = $_POST['diagnosis_date'];
  $DiagnosisDescription = $_POST['DiagnosisDescription'];
  $DiagnosisNotes = $_POST['DiagnosisNotes'];
  $PreliminaryDiagnosis = $_POST['PreliminaryDiagnosis'];
  $ConfirmedDiagnosis = $_POST['ConfirmedDiagnosis'];

  $sql = "UPDATE `diagnosis` SET `DiagnosisDate`='$DiagnosisDate', `DiagnosisDescription`='$DiagnosisDescription', `DiagnosisNotes`='$DiagnosisNotes', `PreliminaryDiagnosis`='$PreliminaryDiagnosis', `ConfirmedDiagnosis`='$ConfirmedDiagnosis' WHERE `DiagnosisID` = $DiagnosisID";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: diagnosistable.php?msg=Diagnosis updated successfully");
    exit();
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}

// Fetch the appointment details from the database
$sql = "SELECT * FROM `diagnosis` WHERE `DiagnosisID` = $DiagnosisID LIMIT 1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Update Diagnosis</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-5 mb-5" style="background-color: #0080FF; color: azure;">
    Update Diagnosis
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Diagnosis Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    //$sql = "SELECT * FROM `appointment`";
    $sql = "SELECT * FROM `diagnosis` WHERE DiagnosisID = $DiagnosisID LIMIT 1";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Diagnosis Date</label>
            <input type="date" class="form-control" name="diagnosis_date" value="<?php echo $row['DiagnosisDate'] ?>">
          </div>
        </div>
        <div class="col">
            <label class="form-label">Diagnosis Description:</label>
            <input type="text" class="form-control" name="DiagnosisDescription" value="<?php echo $row['DiagnosisDescription'] ?>">
          </div>
        <div class="col">
            <label class="form-label">Diagnosis Notes:</label>
            <input type="text" class="form-control" name="DiagnosisNotes" value="<?php echo $row['DiagnosisNotes'] ?>">
        </div>
        <div class="col">
            <label class="form-label">Preliminary Diagnosis:</label>
            <input type="text" class="form-control" name="PreliminaryDiagnosis" value="<?php echo $row['PreliminaryDiagnosis'] ?>">
         </div>
         <div class="col">
            <label class="form-label">Confirmed Diagnosis:</label>
            <input type="text" class="form-control" name="ConfirmedDiagnosis" value="<?php echo $row['ConfirmedDiagnosis'] ?>">
        </div>
        </div>
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="diagnosistable.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>
