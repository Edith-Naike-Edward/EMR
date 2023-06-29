<?php
// Retrieve the patientID from the AJAX request
$patientEmail = $_POST['patientEmail'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectemrsystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare and execute the query
$sql = "SELECT * FROM patient WHERE PatientEmail = '$patientEmail'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
	// Fetch the patient details
	$row = $result->fetch_assoc();

	// Display the patient details
	echo "<h2>Patient Details</h2>";
	echo "<p><strong>Patient ID:</strong> " . $row["PatientID"] . "</p>";
	echo "<p><strong>First Name:</strong> " . $row["PatientFirstName"] . "</p>";
	echo "<p><strong>Last Name:</strong> " . $row["PatientLastName"] . "</p>";
	echo "<p><strong>Date of Birth:</strong> " . $row["PatientDOB"] . "</p>";
	echo "<p><strong>Email:</strong> " . $row["PatientEmail"] . "</p>";
	echo "<p><strong>Mobile Number:</strong> " . $row["PatientPhoneNo"] . "</p>";
	echo "<p><strong>Gender:</strong> " . $row["Gender"] . "</p>";
	echo "<p><strong>Occupation:</strong> " . $row["Occupation"] . "</p>";
	echo "<p><strong>Postal Address:</strong> " . $row["PostalAddress"] . "</p>";
	echo "<p><strong>Physical Address:</strong> " . $row["PhysicalAddress"] . "</p>";
	echo "<h2>Next of Kin Information</h2>";
	echo "<p><strong>First Name:</strong> " . $row["NKFirstName"] . "</p>";
	echo "<p><strong>Last Name:</strong> " . $row["NKLastName"] . "</p>";
	echo "<p><strong>Relation:</strong> " . $row["NKrelation"] . "</p>";
	echo "<p><strong>Phone Number:</strong> " . $row["NKPhoneNo"] . "</p>";
	echo "<p><strong>Email:</strong> " . $row["NKEmail"] . "</p>";
} else {
	echo "Patient not found.";
}

$conn->close();
?>
