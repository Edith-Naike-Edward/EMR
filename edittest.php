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
  $TestID = $_GET["id"];
} else {
  die("TestID not provided.");
}

if (isset($_POST["submit"])) {
  $TestDate = $_POST['TestDate'];
  $Testtype = $_POST['Testtype'];
  $TestResults = $_POST['TestResults'];

  $sql = "UPDATE `test` SET `TestDate`='$TestDate', `Testtype`='$Testtype', `TestResults`='$TestResults' WHERE `TestID` = $TestID";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: testtable.php?msg=Test updated successfully");
    exit();
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}

// Fetch the Test details from the database
$sql = "SELECT * FROM `test` WHERE `TestID` = $TestID LIMIT 1";
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

  <title>Update Test</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-5 mb-5" style="background-color: #0080FF; color: azure;">
    Update Test
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Test Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    //$sql = "SELECT * FROM `appointment`";
    $sql = "SELECT * FROM `test` WHERE TestID = $TestID LIMIT 1";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Test Date</label>
            <input type="date" class="form-control" name="TestDate" value="<?php echo $row['TestDate'] ?>">
          </div>
        </div>
        <div class="col">
            <label class="form-label">Test type:</label>
            <input type="text" class="form-control" name="Testtype" value="<?php echo $row['Testtype'] ?>">
          </div>
        <div class="col">
            <label class="form-label">Test Results:</label>
            <input type="text" class="form-control" name="TestResults" value="<?php echo $row['TestResults'] ?>">
        </div>
        </div>
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="testtable.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>
