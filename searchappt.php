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
$sql = "SELECT * FROM appointment WHERE PatientEmail = '$patientEmail'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Display the appointment details in a table
    echo "<h2>Appointment Details</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Patient ID</th>";
    echo "<th>Appointment ID</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Preferred Appointment Date</th>";
    echo "<th>Confirmed Appointment Date</th>";
    echo "<th>Confirmed Appointment Time</th>";
    echo "<th>Appointment Status</th>";
    echo "<th>Visit type</th>";
    echo "<th>Visit reason</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["PatientID"] . "</td>";
        echo "<td>" . $row["ApptID"] . "</td>";
        echo "<td>" . $row["PatientFirstName"] . "</td>";
        echo "<td>" . $row["PatientLastName"] . "</td>";
        echo "<td>" . $row["PatientEmail"] . "</td>";
        echo "<td>" . $row["PreferredApptDate"] . "</td>";
        echo "<td>" . $row["ConfirmedDate"] . "</td>";
        echo "<td>" . $row["ConfirmedTime"] . "</td>";
        echo "<td>" . $row["ApptStatus"] . "</td>";
        echo "<td>" . $row["Visit_type"] . "</td>";
        echo "<td>" . $row["Visit_reason"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Patient not found.";
}

$conn->close();

?>
