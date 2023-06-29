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

    <title>Prescription Table</title>
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
    Prescription Table
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
                <form action="editprescription.php" method="post">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Patient Email</th>
                                    <th scope="col">Diagnosis ID</th>
                                    <th scope="col">Prescription ID</th>
                                    <th scope="col">Medicine Name</th>
                                    <th scope="col">Dosage</th>
                                    <th scope="col">Instruction</th>
                                    <th scope="col">Prescription Notes</th>   
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="prescriptionTableBody">
                                <?php
                                $sql = "SELECT *, (@prescription_id := @prescription_id + 1) AS PrescriptionID
                                        FROM prescription, (SELECT @prescription_id := 0) AS counter";
                                $result = mysqli_query($conn, $sql); // Update variable name here
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["PatientEmail"] ?></td>
                                    <td><?php echo $row["DiagnosisID"] ?></td>
                                    <td><?php echo $row["PrescriptionID"] ?></td>
                                    <td><?php echo $row["MedName"] ?></td>
                                    <td><?php echo $row["Dosage"] ?></td>
                                    <td><?php echo $row["Instruction"] ?></td>
                                    <td><?php echo $row["PrescriptionNotes"] ?></td>
                                    <td>
                                        <a href="editprescription.php?id=<?php echo $row["PrescriptionID"] ?>"
                                            class="link-dark"><i
                                                class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                        <a href="deleteprescription.php?id=<?php echo $row["PrescriptionID"]; ?>" class="link-dark">
                                            <i class="fa-solid fa-trash fs-5"></i>
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
