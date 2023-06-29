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
$sql = "SELECT * FROM diagnosis WHERE PatientEmail = '$patientEmail'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Display the appointment details in a table
    echo "<h2>Diagnosis Details</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Appointment ID</th>";
    echo "<th>Diagnosis ID</th>";
    echo "<th>Email</th>";
    echo "<th>Diagnosis Date</th>";
    echo "<th>Diagnosis Description</th>";
    echo "<th>Diagnosis Notes</th>";
    echo "<th>Preliminary Diagnosis</th>";
    echo "<th>Confirmed Diagnosis</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ApptID"] . "</td>";
        echo "<td>" . $row["DiagnosisID"] . "</td>";
        echo "<td>" . $row["PatientEmail"] . "</td>";
        echo "<td>" . $row["DiagnosisDate"] . "</td>";
        echo "<td>" . $row["DiagnosisDescription"] . "</td>";
        echo "<td>" . $row["DiagnosisNotes"] . "</td>";
        echo "<td>" . $row["PreliminaryDiagnosis"] . "</td>";
        echo "<td>" . $row["ConfirmedDiagnosis"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Patient not found.";
}

$conn->close();

?>
