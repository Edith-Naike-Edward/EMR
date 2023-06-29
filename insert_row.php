$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectemrsystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *, (@appointment_id := @appointment_id + 1) AS AppointmentID, (@medical_record_id := @medical_record_id + 1) AS MedicalRecordID
        FROM requestappointment, (SELECT @appointment_id := 0, @medical_record_id := 0) AS counter";