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
$sql = "SELECT * FROM treatmentplan WHERE PatientEmail = '$patientEmail'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Display the appointment details in a table
    echo "<h2>Treatment Details</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Treatment ID</th>";
    echo "<th>Diagnosis ID</th>";
    echo "<th>Email</th>";
    echo "<th>Treatment Date</th>";
    echo "<th>Treatment Description</th>";
    echo "<th>Treatment Notes</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["TreatmentID"] . "</td>";
        echo "<td>" . $row["DiagnosisID"] . "</td>";
        echo "<td>" . $row["PatientEmail"] . "</td>";
        echo "<td>" . $row["TreatmentDate"] . "</td>";
        echo "<td>" . $row["TreatmentDescription"] . "</td>";
        echo "<td>" . $row["TreatmentNotes"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Patient not found.";
}

$conn->close();

?>
