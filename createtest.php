<?php
// Connect to the database
$host = 'localhost';
$db = 'projectemrsystem';
$username = 'root';
$password = '';

try {
  $db = new PDO("mysql:host=$host;dbname=$db", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}

// Generate a unique ID from the database
function generateUniqueID($db, $table, $column) {
  $statement = $db->prepare("SELECT MAX($column) AS max_id FROM $table");
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  $maxID = $result['max_id'];
  return $maxID ? $maxID + 1 : 1;
}

// Generate Test ID
$testID = generateUniqueID($db, 'test', 'TestID');

// Generate Appointment ID
$appointmentID = generateUniqueID($db, 'test', 'DiagnosisID');

// Generate Medical Record ID
$medicalRecordID = generateUniqueID($db, 'test', 'MedRecordID');

// Check if the form is submitted
//if (isset($_POST['submit'])) {
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Retrieve form data
  //$diagnosisID = $_POST['diagnosisid'];
  $testtype = $_POST['testtype'];
  $testdate = $_POST['testdate'];
  $testResults = $_POST['testresults'];

  do {
    if (empty($testtype) || empty($testdate) || empty($testresults)){
      $errorMessage = "All the fields are required";
      break;
    }
  } while(false);

    //add new test
    $testtype="";
    $testdate="";
    $testresults="";

    $successMessage = "Test added sucssfully";
    $errorMessage = "Test not added sucssfully";
  // Perform further processing or database operations with the generated IDs and form data

  // Redirect to a success page or perform any other necessary actions
  //header("Location: test.php");
  //exit();
  }
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COC</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>New Test</h2>

    <?php
    if (!empty($errorMessage)){
      echo "
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      ";
    }
    ?>
    <form method="post">
      <!--<div class="row mb-3">
        <label class"col-sm-3 col-form-label">Test ID</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="testid" value="">
        </div>
      </div>
      <div class="row mb-3">
        <label class"col-sm-3 col-form-label">Medical Record ID</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="medrecordid" value="">
        </div>
      </div>
      <div class="row mb-3">
        <label class"col-sm-3 col-form-label">Diagnosis ID</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="diagnosisid" value="">
        </div>
      </div>-->
      <div class="row mb-3">
        <label class"col-sm-3 col-form-label">Test type</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="testtype" value="<?php echo $testtype; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class"col-sm-3 col-form-label">Test Date</label>
        <div class="col-sm-6">
          <input type="date" class="form-control" name="testdate" value="<?php echo $testdate; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class"col-sm-3 col-form-label">Test Results</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="testresults" value="<?php echo $testresults; ?>">
        </div>
      </div>
      <?php
      if (!empty($successMessage)){
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$successMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        ";
      }
      ?>
      <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
        <a class="btn btn-outline-primary" href="test.php" role="button">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</body>