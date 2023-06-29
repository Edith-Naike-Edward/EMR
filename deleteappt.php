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

$ApptID = $_GET["id"];
$sql = "DELETE FROM `appointment` WHERE ApptID = $ApptID";
$result = mysqli_query($con, $sql);

if ($result) {
  header("Location: appttable.php?msg=Appointment deleted successfully");
} else {
  echo "Failed: " . mysqli_error($con);
}