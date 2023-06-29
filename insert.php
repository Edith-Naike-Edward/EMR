<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectemrsystem";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the data from the form submission
$appointmentStatus = isset($_POST['appointmentStatus']) ? $_POST['appointmentStatus'] : "";
$confirmedDate = isset($_POST['confirmedDate']) ? $_POST['confirmedDate'] : "";
$appointmentTime = isset($_POST['appointmentTime']) ? $_POST['appointmentTime'] : "";

// Prepare the SQL statement to insert the data into the "appointment" table
$sql = "INSERT INTO appointment (PatientID, ApptID, PreferredApptDate, Visittype, Visitreason, ApptStatus, ConfirmedDate, ConfirmedTime) 
        VALUES ('2', '', '', '', '', '$appointmentStatus', '$confirmedDate', '$appointmentTime')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment data inserted successfully.";
    header("Location: appointmenttable.php");
    exit();
} else {
    echo "Error inserting appointment data: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
