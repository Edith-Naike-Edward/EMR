<!-- Display Appointments -->
<h2>Appointments</h2>
<table>
    <tr>
        <th>Doctor ID</th>
        <th>Patient ID</th>
        <th>Visit Type</th>
        <th>Visit Reason</th>
        <th>Appointment Time</th>
        <th>Appointment Status</th>
        <th>Appointment Date</th>
        <th>Appointment ID</th>
        <th>Medical Record</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    // Connect to the database and retrieve appointments
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "projectemrsystem";

    $con= new mysqli ($host, $user, $pwd, $db);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM appointment";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['doctorid'] . "</td>";
            echo "<td>" . $row['patientid'] . "</td>";
            echo "<td>" . $row['visittype'] . "</td>";
            echo "<td>" . $row['visitreason'] . "</td>";
            echo "<td>" . $row['appointmenttime'] . "</td>";
            echo "<td>" . $row['appointmentstatus'] . "</td>";
            echo "<td>" . $row['appointmentdate'] . "</td>";
            echo "<td>" . $row['appointmentid'] . "</td>";
            echo "<td><a href='update_appointment.php?id=" . $row['id'] . "'>Update</a></td>";
            echo "<td><a href='delete_appointment.php?id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No appointments found.</td></tr>";
    }

    mysqli_close($con);
    ?>
</table>
