<?php
session_start();
include "dbconn.php";
$mypid = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
if($mypid==""){header("Location: dlogout.php");}else{}
echo "$mypid";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Medical Record</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>
<body>

<div class="wrapper">
	<div class="header">
		<ul>
			<li class="active form_1_progessbar">
				<div>
					<p>1</p>
				</div>
			</li>
			<!---<li class="form_2_progessbar">
				<div>
					<p>2</p>
				</div>
			</li>
			<li class="form_3_progessbar">
				<div>
					<p>3</p>
				</div>
			</li>
			<li class="form_4_progessbar">
				<div>
					<p>4</p>
				</div>
			</li>-->
		</ul>
	</div>
	<div class="form_wrap">
		<div class="form_1 data_info">
			<h2>Diagnosis Info</h2>
			<form action="adddiagnosis.php" method="post" style="width:50vw; min-width:300px;">
				<div class="form_container">
				<div class="input_wrap">
						<label for="ApptID">Appointment ID</label>
						<?php
						if (isset($_GET['id'])) {
							$apptID = $_GET['id'];
							echo '<input type="text" name="ApptID" class="input" id="ApptID" value="' . $apptID . '" readonly>';
						} else {
							echo '<input type="text" name="ApptID" class="input" id="ApptID" value="ApptID not provided" readonly>';
						}
						?>
					</div>
					<div class="input_wrap">
						<label for="date">Diagnosis Date</label>
						<input type="date" name="DiagnosisDate" class="input" id="DiagnosisDate">
					</div>
					<div class="input_wrap">
						<label for="DiagnosisDescription">Diagnosis Description</label>
						<input type="text" name="DiagnosisDescription" class="input" id="DiagnosisDescription">
					</div>
					<div class="input_wrap">
						<label for="DiagnosisNotes">Diagnosis Notes</label>
						<input type="text" name="DiagnosisNotes" class="input" id="DiagnosisNotes">
					</div>
					<div class="input_wrap">
						<label for="PreliminaryDiagnosis">Preliminary Diagnosis</label>
						<input type="text" name="PreliminaryDiagnosis" class="input" id="PreliminaryDiagnosis">
					</div>
					<div class="input_wrap">
						<label for="ConfirmedDiagnosis">Confirmed Diagnosis</label>
						<input type="text" name="ConfirmedDiagnosis" class="input" id="ConfirmedDiagnosis">
					</div>
					<div class="input_wrap">
						<!--<label for="PatientEmail">Email Address</label>
						<input type="text" name="PatientEmail" class="input" id="PatientEmail">-->
            <label for="PatientEmail">Patient Email</label>
						<?php
						if (isset($_GET['email'])) {
							$patientEmail = $_GET['email'];
							echo '<input type="text" name="PatientEmail" class="input" id="PatientEmail" value="' . $patientEmail . '" readonly>';
						} else {
							echo '<input type="text" name="PatientEmail" class="input" id="PatientEmail" value="PatientEmail not provided" readonly>';
						}
						?>
					</div>
					<!-- Add the hidden input field for ApptID -->
 					<input type="hidden" name="DiagnosisID" value="<?php echo $diagnosisID; ?>">
 					<input type="hidden" name="PatientEmail" value="<?php echo $patientEmail; ?>">
          <div class="button">
          <button type="submit" class="btn btn-success" name="submit">Add Diagnosis</button>
        </div>
        <div>
          <a href="appttable.php" class="btn btn-danger">Cancel</a>
        </div>
				</div>
			</form>
		</div>
		<!--<div class="form_2 data_info" style="display: none;">
			<h2>Test Info</h2>
			<form>
				<div class="form_container">
					<div class="input_wrap">
						<label for="user_name">User Name</label>
						<input type="text" name="User Name" class="input" id="user_name">
					</div>
					<div class="input_wrap">
						<label for="first_name">First Name</label>
						<input type="text" name="First Name" class="input" id="first_name">
					</div>
					<div class="input_wrap">
						<label for="last_name">Last Name</label>
						<input type="text" name="Last Name" class="input" id="last_name">
					</div>
				</div>
			</form>
		</div>
		<div class="form_3 data_info" style="display: none;">
			<h2>Professional Info</h2>
			<form>
				<div class="form_container">
					<div class="input_wrap">
						<label for="company">Current Company</label>
						<input type="text" name="Current Company" class="input" id="company">
					</div>
					<div class="input_wrap">
						<label for="experience">Total Experience</label>
						<input type="text" name="Total Experience" class="input" id="experience">
					</div>
					<div class="input_wrap">
						<label for="designation">Designation</label>
						<input type="text" name="Designation" class="input" id="designation">
					</div>
				</div>
			</form>
		</div>-->
	</div>
	<!--<div class="btns_wrap">
		<div class="common_btns form_1_btns">
			<button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		<div class="common_btns form_2_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			<button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		<div class="common_btns form_3_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			<button type="button" class="btn_done">Done</button>
		</div>
	</div>-->
</div>

<div class="modal_wrapper">
	<div class="shadow"></div>
	<div class="success_wrap">
		<span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
		<p>You have successfully completed the process.</p>
	</div>
</div>

<script type="text/javascript" src="scripts.js"></script>

</body>
</html>