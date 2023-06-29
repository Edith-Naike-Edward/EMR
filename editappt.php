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
  $ApptID = $_GET["id"];
} else {
  die("ApptID not provided.");
}

if (isset($_POST["submit"])) {
  $ConfirmedDate = $_POST['confirmed_date'];
  $ConfirmedTime = $_POST['confirmed_time'];
  $ApptStatus = $_POST['appt_status'];

  $sql = "UPDATE `appointment` SET `ConfirmedDate`='$ConfirmedDate', `ConfirmedTime`='$ConfirmedTime', `ApptStatus`='$ApptStatus' WHERE `ApptID` = $ApptID";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: appttable.php?msg=Appointment updated successfully");
    exit();
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}

// Fetch the appointment details from the database
$sql = "SELECT * FROM `appointment` WHERE `ApptID` = $ApptID LIMIT 1";
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

  <title>Update Appointment</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #0080FF; color: azure;">
    Update Appointment
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Appointment Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    //$sql = "SELECT * FROM `appointment`";
    $sql = "SELECT * FROM `appointment` WHERE ApptID = $ApptID LIMIT 1";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Confirmed Appointment Date</label>
            <input type="date" class="form-control" name="confirmed_date" value="<?php echo $row['ConfirmedDate'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Confirmed Appointment Time:</label>
            <input type="time" class="form-control" name="confirmed_time" value="<?php echo $row['ConfirmedTime'] ?>">
          </div>
        </div>

        <div class="form-group mb-3">
        <select class="form-select" name="appt_status">
            <option value="confirmed" <?php echo ($row['ApptStatus'] == 'confirmed') ? "selected" : "" ?>>Confirmed</option>
            <option value="rescheduled" <?php echo ($row['ApptStatus'] == 'rescheduled') ? "selected" : "" ?>>Rescheduled</option>
            <option value="pending" <?php echo ($row['ApptStatus'] == 'pending') ? "selected" : "" ?>>Pending</option>
            <option value="cancelled" <?php echo ($row['ApptStatus'] == 'cancelled') ? "selected" : "" ?>>Cancelled</option>
          </select>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="appttable.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>
