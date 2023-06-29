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

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Initialize an array to store validation errors
    $errors = array();

    // Validate PatientFirstName
    $PatientFirstName = trim($_POST['PatientFirstName']);
    if (empty($PatientFirstName)) {
        $errors[] = "First name is required.";
    }

    // Validate PatientLastName
    $PatientLastName = trim($_POST['PatientLastName']);
    if (empty($PatientLastName)) {
        $errors[] = "Last name is required.";
    }

    // Validate PreferredApptDate
    $PreferredApptDate = trim($_POST['PreferredApptDate']);
    if (empty($PreferredApptDate)) {
        $errors[] = "Preferred appointment date is required.";
    }

    // Validate PatientPhoneNo
    $PatientPhoneNo = trim($_POST['PatientPhoneNo']);
    if (empty($PatientPhoneNo)) {
        $errors[] = "Phone number is required.";
    } elseif (!is_numeric($PatientPhoneNo)) {
        $errors[] = "Phone number must be numeric.";
    }

    // Validate PatientEmail
    $mypid = isset($_SESSION["patientemail"]) ? $_SESSION["patientemail"] : "";
    $PatientEmail = trim($_POST['PatientEmail']);
    if($mypid!=='' && $mypid==$PatientEmail){
    if (empty($PatientEmail)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($PatientEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    }else{header("Location: logout.php");}
    
    // Validate Visit_type
    $Visit_type = trim($_POST['Visit_type']);
    if (empty($Visit_type)) {
        $errors[] = "Visit type is required.";
    }

    // Validate Visit_reason
    $Visit_reason = trim($_POST['Visit_reason']);
    if (empty($Visit_reason)) {
        $errors[] = "Visit reason is required.";
    }

    // Check if there are any validation errors
    if (empty($errors)) {
        // Check if the patient exists in the patient table
        $stmt = $con->prepare("SELECT PatientID FROM patient WHERE PatientFirstName = ? AND PatientLastName = ? AND PatientPhoneNo = ? AND PatientEmail = ?");
        $stmt->bind_param("ssss", $PatientFirstName, $PatientLastName, $PatientPhoneNo, $PatientEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        // If a matching patient is found, proceed with inserting the appointment
        if ($result->num_rows > 0) {
            // Get the patient ID
            $row = $result->fetch_assoc();
            $PatientID = $row['PatientID'];

            // Prepare the statement to insert the appointment
            $stmt = $con->prepare("INSERT INTO requestappointment (PatientID, PatientFirstName, PatientLastName, PreferredApptDate, PatientPhoneNo, PatientEmail, Visit_type, Visit_reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssss", $PatientID, $PatientFirstName, $PatientLastName, $PreferredApptDate, $PatientPhoneNo, $PatientEmail, $Visit_type, $Visit_reason);

            // Prepare the statement to insert the appointment
            //$stmt = $con->prepare("INSERT INTO appointment (PatientID, PatientFirstName, PatientLastName, PatientPhoneNo, PatientEmail, Visittype, Visitreason) VALUES (?, ?, ?, ?, ?, ?, ?)");
            //$stmt->bind_param("issssss", $PatientID, $PatientFirstName, $PatientLastName, $PatientPhoneNo, $PatientEmail, $Visit_type, $Visit_reason);

            // Execute the statement
            if ($stmt->execute()) {
                echo 'Appointment request sent successfully.';
            } else {
                echo 'Error: ' . $stmt->error;
            }

            // Close the statement
           // $stmt->close();
        } else {
            echo 'Error: Patient does not exist.';
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display the error messages to the user
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    $con->close();
}
?>
