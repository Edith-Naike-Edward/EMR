<?php
session_start();
include "dbconn.php";
$mypid = isset($_SESSION["patientemail"]) ? $_SESSION["patientemail"] : "";
if($mypid==""){header("Location: logout.php");}else{}
echo "$mypid";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Treatment Details</title>
	<style>
		body {
			font-family: 'Silk Display regular', sans-serif;
			background-color: #f2f2f2;
		}
		form {
			color: white;
			background-color: #0080FF;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			max-width: 600px;
			margin: 0 auto;
		}
		input[type=text], input[type=tel], input[type=email], input[type=date], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=submit] {
			font-family: 'Silk Display regular', sans-serif;
			font-size: 20px;
			background-color: #010C80;
			color: white;
			padding: 12px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			width: 100%;
		}
		input[type=submit]:hover {
			background-color: #0023FF;
		}
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		.row {
			display: flex;
			flex-wrap: wrap;
			margin-bottom: 10px;
		}
		.col {
			flex: 50%;
			padding: 0 10px;
		}
		@media screen and (max-width: 600px) {
			.col {
				flex: 100%;
				margin-top: 0;
			}
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$('form').submit(function(event) {
				event.preventDefault(); // Prevent form submission
				var patientEmail = $('#patientEmail').val(); // Get the entered patient ID

				// Send AJAX request to searchpatient.php
				$.ajax({
					url: 'searchtreatment.php',
					type: 'POST',
					data: { patientEmail: patientEmail },
					success: function(response) {
						$('#appointmentDetails').html(response); // Display the patient details
					},
					error: function() {
						$('#appointmentDetails').html('Error occurred. Please try again.'); // Display error message
					}
				});
			});
		});
	</script>
</head>
<body>
	<form>
		<h2>Enter Your Patient Email</h2>
		<div class="row">
			<div class="col">
				<label for="patientEmail">Patient Email:</label>
				<input type="text" id="patientEmail" name="patientEmail" value="<?php echo $mypid;?>" disabled required>
			</div>
		</div>
		<input type="submit" name="submit" value="Search">
	</form>
	<div id="appointmentDetails"></div>
</body>
</html>
