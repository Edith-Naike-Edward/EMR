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

$TestID = $_GET["id"];
$sql = "DELETE FROM `test` WHERE TestID = $TestID";
$result = mysqli_query($con, $sql);

if ($result) {
  header("Location: testtable.php?msg=Test deleted successfully");
} else {
  echo "Failed: " . mysqli_error($con);
}