<?php
session_start();
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$db_name = "projectemrsystem";

// Establishing database connection
$conn = mysqli_connect($host, $username, $password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Signup functionality
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into patientsignup table
    $sql = "INSERT INTO patientsignup (patientname, patientemail, patientpassword) VALUES ('$name', '$email', '$hashedPassword')";
    if (mysqli_query($conn, $sql)) {
        echo "Signup successful!";
        $_SESSION["patientemail"]="$email";
        header("Location: patientdashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Login functionality
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in patientsignup table
    $checkEmailQuery = "SELECT * FROM patientsignup WHERE patientemail='$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $row = mysqli_fetch_assoc($checkEmailResult);
        $storedPassword = $row['patientpassword'];

        if (password_verify($password, $storedPassword)) {
            // Insert into patientlogin table if email exists in patientsignup table
            //$insertLoginQuery = "INSERT INTO patientlogin (patientemail, patientpassword) VALUES ('$email', '$storedPassword')";
          //  $insertLoginQuery = "INSERT INTO patientlogin (patientemail, patientpassword) VALUES ('$email', '$hashedPassword')";
            //if (mysqli_query($conn, $insertLoginQuery)) {
                echo "Login successful!";
                echo "Login record inserted!";
                $_SESSION["patientemail"]="$email";
                header("Location: patientdashboard.php");
                exit();
           // } else {
                //echo "Error: " . $insertLoginQuery . "<br>" . mysqli_error($conn);
            //}
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Invalid email! Please sign up first";
    }
}

// Closing the database connection
mysqli_close($conn);
?>
