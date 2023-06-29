<?php
// Retrieve the patientEmail from the AJAX request
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
$sql = "SELECT * FROM test WHERE PatientEmail = '$patientEmail'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Display the appointment details in a table
    echo "<h2>Test Details</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Test ID</th>";
    echo "<th>Diagnosis ID</th>";
    echo "<th>Email</th>";
    echo "<th>Test Date</th>";
    echo "<th>Test Type</th>";
    echo "<th>Test Results</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["TestID"] . "</td>";
        echo "<td>" . $row["DiagnosisID"] . "</td>";
        echo "<td>" . $row["PatientEmail"] . "</td>";
        echo "<td>" . $row["TestDate"] . "</td>";
        echo "<td>" . $row["Testtype"] . "</td>";
        echo "<td>" . $row["TestResults"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Patient not found.";
}

$conn->close();

?>
