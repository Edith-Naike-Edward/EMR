<?php
// Database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectemrsystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the patient ID from the form submission
    $patientID = $_POST['patient_id'];
    
    // Retrieve the appointment data from the requestappointment table
    $sql = "SELECT * FROM requestappointment WHERE PatientID = '$patientID'";

    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Extract the necessary data from the requestappointment table
        $PatientFirstName = $row["PatientFirstName"];
        $PatientLastName = $row["PatientLastName"];
        $PatientEmail = $row["PatientEmail"];
        $preferredApptDate = $row["PreferredApptDate"];
        $visitType = $row["Visit_type"];
        $visitReason = $row["Visit_reason"];
        
        // Insert the appointment data into the appointment table
        $stmt = $conn->prepare("INSERT INTO appointment (PatientID, PatientFirstName, PatientLastName, PatientEmail, PreferredApptDate, Visit_type, Visit_reason) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $patientID, $PatientFirstName, $PatientLastName,$PatientEmail, $preferredApptDate, $visitType, $visitReason);
        
        if ($stmt->execute()) {
            echo 'Appointment confirmed and added to the appointment table.';
        } else {
            echo 'Error: ' . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo 'Error: No matching appointment found in the requestappointment table.';
    }
}

mysqli_close($conn);
?>
