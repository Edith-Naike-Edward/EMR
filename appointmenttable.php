<?php 
session_start();
include "dbconn.php";
$crud=new Crud(); 
$mypid = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
if($mypid==""){header("Location: dlogout.php");}else{}
echo "$mypid";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Add custom CSS styles here */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        table,
        th,
        td {
            border: 1px solid rgb(77, 135, 210);
            padding-top: 12px;
            border-collapse: collapse;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #7dc3ec;
            color: white;
        }

        tr {
            color: #000;
            text-align: left;
        }

        tr.active-row {
            font-weight: bold;
            color: #054d3e;
        }

        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 500px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        tr:nth-child(even) {
            background-color: #edea928c;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Appointment Table</h2>
    <div class="form-group">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by Name">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Appointment ID</th>
                <th>Preferred Appointment Date</th>
                <th>Visit Type</th>
                <th>Visit Reason</th>
                <th>Appointment Status</th>
                <th>Confirmed Date</th>
                <th>Appointment Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="appointmentTableBody">
            <!-- Data rows will be added dynamically using JavaScript -->
            <?php

//$aquery = "SELECT * FROM requestappointment LEFT JOIN appointment on appointment.ApptID=requestappointment.ApptID  ORDER BY appointment.ApptID DESC";
//$aquery = "SELECT * FROM requestappointment,appointment WHERE appointment.ApptID=requestappointment.ApptID ORDER BY requestappointment.ApptID DESC ";
$aquery = "SELECT * FROM requestappointment RIGHT JOIN appointment on appointment.ApptID=requestappointment.ApptID  ORDER BY requestappointment.ApptID DESC";
$massess = $crud->getData($aquery);
//$massess = $conn->query($aquery);
//$massess=$crud->getData($aquery); 
                $i = 0;
                print_r($massess);
                //$num = mysqli_num_rows($massess);
                //$massess = mysqli_fetch_assoc($massess);
                $crud=new Crud(); 
                foreach ($massess as $key=>$assess) {
                    $eid = $assess['ApptID'];
                    $ecode = $assess['PatientID'];
                    $osdate = $assess['PreferredApptDate'];
                    $sdate = date("d/m/Y", strtotime($osdate));
                    $smonth = date("m", strtotime($osdate));

                    $ocdate = $assess['ConfirmedDate'];
                    $cdate = date("d/m/Y", strtotime($ocdate));
                    $cmonth = date("m", strtotime($ocdate));

                    $scdate = $sdate;
                    $todaydate = date("d-m-Y");
                    $todaymonth = date("m");

                    $ename = $assess['Visit_type'];
                    $edesc = $assess['Visit_reason'];
                    $etype = $assess['ConfirmedTime'];

                    $appointmentStatus = $assess['ApptStatus'];
    
                    // Generate the dropdown options based on the current appointment status
                    $statusOptions = '';
                    $options = array('Confirmed', 'Rescheduled','Pending', 'Cancelled');
                    foreach ($options as $option) {
                        $selected = ($option == $appointmentStatus) ? 'selected' : '';
                        $statusOptions .= "<option value='$option' $selected>$option</option>";
                    }

                    echo " <tr
                            style='  background-color: #ffffff !important; color: #076371; padding: 2pt !important;'>
                            <td class='p0' style='width: 10%  !important;'>$ecode</td>                            
                            <td class='p0' style='width: 10%  !important;'>$eid</td>                            
                            <td class='p ' style='width: 25%  !important;'>$osdate</td>
                            <td class='p ' style='width: 25%  !important;'>$ename</td>
                            <td class='p ' style='width: 25%  !important;'>$edesc</td>
                            <td class='p ' style='width: 25%  !important;'>$statusOptions</td>
                            <td class='p  ntable' style='width: 20% !important;'>$etype</td>
                            <td class='pre  ntable' style='width: 15% !important;'>$sdate</td>
                            <td class='p0' style='width: 10%  !important;'> <a  id='$i'
                            class='btn btn-outline-primary viewA' href='./assessment/viewassess.php?id=$i'>View</a></td>
                            <td class='pre  ntable' style='width: 10% !important;'> <button  id='$eid' onclick='update_adetails($i)'
                                    class='btn btn-outline-success editA' data-bs-toggle='modal' name='eid' value='$eid'
                                    data-bs-target='#exampleaModal' data-bs-whatever='$ename'>Edit</button></td>
                            <td class='pre ntable' style='width: 10% !important;'> <button type='button'
                                    data-bs-toggle='modal' data-bs-target='#deleteaModal' data-bs-whatever='$ename'
                                    id='$eid' class='btn btn-outline-danger deleteA'  onclick='delete_adetails($i)'>Delete</button></td>
                        </tr>";
                    $i++;
                }
                mysqli_close($conn);
?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch data from the server using PHP and MySQL
            $.ajax({
                url: 'fetchappt.php',
                type: 'GET',
                success: function (data) {
                    var appointments = JSON.parse(data);

                    // Sort appointments in descending order of Preferred Appointment Date
                    appointments.sort(function (a, b) {
                        return new Date(a.PreferredApptDate) - new Date(b.PreferredApptDate);
                    });

                      // Get the appointment status and generate the dropdown options
                    var appointmentStatus = appointment.AppointmentStatus;
                    var statusOptions = '';
                    var options = ['Option 1', 'Option 2', 'Option 3'];
                    options.forEach(function (option) {
                        var selected = (option == appointmentStatus) ? 'selected' : '';
                        statusOptions += '<option value="' + option + '" ' + selected + '>' + option + '</option>';
                    });

                    // Generate HTML for each appointment row
                    var html = '';
                    appointments.forEach(function (appointment) {
                        html += '<tr>';
                        html += '<td>' + appointment.PatientID + '</td>';
                        html += '<td>' + appointment.AppointmentID + '</td>';
                        html += '<td>' + appointment.PreferredApptDate + '</td>';
                        html += '<td>' + appointment.Visit_type + '</td>';
                        html += '<td>' + appointment.Visit_reason + '</td>';
                        html += '<td><select class="appointmentStatusInput" name="appointmentStatus[]">' + statusOptions + '</select></td>';
                        //html += '<td><input type="text" class="appointmentStatusInput" value="' + appointment.AppointmentStatus + '"></td>';
                        html += '<td><input type="date" class="confirmedDateInput" value="' + appointment.ConfirmedDate + '"></td>';
                        html += '<td><input type="time" class="appointmentTimeInput" value="' + appointment.AppointmentTime + '"></td>';
                        html += '<td><button class="btn btn-primary submitButton" form="appointmentForm">Submit</button></td>';
                        html += '</tr>';
                    });

                    // Append the HTML to the table body
                    $('#appointmentTableBody').append(html);
                }
            });

            // Function to filter the table based on search input
            $('#searchInput').keyup(function () {
                var searchText = $(this).val().toLowerCase();

                $('tbody tr').each(function () {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(searchText) > -1);
                });
            });
        });
    </script>

    <!-- Hidden form to submit appointment updates -->
    <form id="appointmentForm" action="insert.php" method="POST" style="display: none;"></form>
</body>
</html>
