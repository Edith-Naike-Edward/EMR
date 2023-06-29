<?php
session_start();
include "dbconn.php";
$mypid = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
if($mypid==""){header("Location: dlogout.php");}else{}
echo "$mypid";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Appointment Table</title>
    <style>
        /* Add custom CSS styles here */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Playfair Display', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #0080FF; color:azure;">
        Appointment Table
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search by Name">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = $_GET["msg"];
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            ' . $msg . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                ?>
            </div>
        </div>
        <div class="row justify-content-center fs-3 mb-5">
                <form action="editappt.php" method="post">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ApptID</th>
                                    <th scope="col">Patient ID</th>
                                    <th scope="col">Patient First Name</th>
                                    <th scope="col">Patient Last Name</th>
                                    <th scope="col">Patient Email</th>
                                    <th scope="col">Preferred Appointment Date</th>
                                    <th scope="col">Confirmed Appointment Date</th>
                                    <th scope="col">Confirmed Appointment Time</th>
                                    <th scope="col">Appointment Status</th>
                                    <th scope="col">Visit Type</th>
                                    <th scope="col">Visit Reason</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody">
                                <?php
                                $sql = "SELECT *, (@appointment_id := @appointment_id + 1) AS ApptID
                                        FROM appointment, (SELECT @appointment_id := 0) AS counter";
                                $result = mysqli_query($conn, $sql); // Update variable name here
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["ApptID"] ?></td>
                                    <td><?php echo $row["PatientID"] ?></td>
                                    <td><?php echo $row["PatientFirstName"] ?></td>
                                    <td><?php echo $row["PatientLastName"] ?></td>
                                    <td><?php echo $row["PatientEmail"] ?></td>
                                    <td><?php echo $row["PreferredApptDate"] ?></td>
                                    <td><?php echo $row["ConfirmedDate"] ?></td>
                                    <td><?php echo $row["ConfirmedTime"] ?></td>
                                    <td><?php echo $row["ApptStatus"] ?></td>
                                    <td><?php echo $row["Visit_type"] ?></td>
                                    <td><?php echo $row["Visit_reason"] ?></td>
                                    <td>
                                        <a href="editappt.php?id=<?php echo $row["ApptID"] ?>"
                                            class="link-dark"><i
                                                class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                        <a href="deleteappt.php?id=<?php echo $row["ApptID"] ?>"
                                            class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                                            <div class="col-md-30 justify-content-center fs-3 mb-5">
                                        <a href="add-new.php?id=<?php echo $row["ApptID"]; ?>&email=<?php echo $row["PatientEmail"]; ?>" class="link-dark">
                                            <i class="btn btn-dark mb-3">Add Diagnosis Record</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchInput').keyup(function () {
                var searchText = $(this).val().toLowerCase();

                $('tbody tr').each(function () {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(searchText) > -1);
                });
            });
        });
    </script>
</body>

</html>
