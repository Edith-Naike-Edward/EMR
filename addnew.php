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
	<title>Add Diagnosis Record</title>
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
			<li class="form_2_progessbar">
				<div>
					<p>2</p>
				</div>
			</li>
			<li class="form_3_progessbar">
				<div>
					<p>3</p>
				</div>
			</li>
		</ul>
	</div>
	<div class="form_wrap">
		<div class="form_1 data_info">
			<h2>Test Info</h2>
			<form action="addtest.php" method="post" style="width:50vw; min-width:300px;">
				<div class="form_container">
				<div class="input_wrap">
						<label for="DiagnosisID">Diagnosis ID</label>
						<?php
						if (isset($_GET['id'])) {
							$diagnosisID = $_GET['id'];
							echo '<input type="text" name="DiagnosisID" class="input" id="DiagnosisID" value="' . $diagnosisID . '" readonly>';
						} else {
							echo '<input type="text" name="DiagnosisID" class="input" id="DiagnosisID" value="DiagnosisID not provided" readonly>';
						}
						?>
				</div>
					<div class="input_wrap">
						<label for="date">Test Date</label>
						<input type="date" name="TestDate" class="input" id="TestDate">
					</div>
					<div class="input_wrap">
						<label for="Testtype">Test Type</label>
						<input type="text" name="Testtype" class="input" id="Testtype">
					</div>
					<div class="input_wrap">
						<label for="TestResults">Test Results</label>
						<input type="text" name="TestResults" class="input" id="TestResults">
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
          <button type="submit" class="btn btn-success" name="submit">Add Test</button>
        </div>
        <div>
          <a href="diagnosistable.php" class="btn btn-danger">Cancel</a>
        </div>
				</div>
			</form>
		</div>
		<div class="form_2 data_info" style="display: none;">
			<h2>Prescription Info</h2>
			<form action="addprescription.php" method="post" style="width:50vw; min-width:300px;">
				<div class="form_container">
        <div class="input_wrap">
						<label for="DiagnosisID">Diagnosis ID</label>
						<?php
						if (isset($_GET['id'])) {
							$diagnosisID = $_GET['id'];
							echo '<input type="text" name="DiagnosisID" class="input" id="DiagnosisID" value="' . $diagnosisID . '" readonly>';
						} else {
							echo '<input type="text" name="DiagnosisID" class="input" id="DiagnosisID" value="DiagnosisID not provided" readonly>';
						}
						?>
				</div>
					<div class="input_wrap">
						<label for="MedName">Medicine Name</label>
						<input type="text" name="MedName" class="input" id="MedName">
					</div>
					<div class="input_wrap">
						<label for="Dosage">Dosage</label>
						<input type="text" name="Dosage" class="input" id="Dosage">
					</div>
					<div class="input_wrap">
						<label for="Instruction">Instruction</label>
						<input type="text" name="Instruction" class="input" id="Instruction">
					</div>
					<div class="input_wrap">
						<label for="PrescriptionNotes">Prescription Notes</label>
						<input type="text" name="PrescriptionNotes" class="input" id="PrescriptionNotes">
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
          <button type="submit" class="btn btn-success" name="submit">Add Prescription</button>
        </div>
        <div>
          <a href="diagnosistable.php" class="btn btn-danger">Cancel</a>
        </div>
				</div>
			</form>
		</div>
		<div class="form_3 data_info" style="display: none;">
			<h2>Treatment Info</h2>
			<form action="addtreatment.php" method="post" style="width:50vw; min-width:300px;">
				<div class="form_container">
        <div class="input_wrap">
						<label for="DiagnosisID">Diagnosis ID</label>
						<?php
						if (isset($_GET['id'])) {
							$diagnosisID = $_GET['id'];
							echo '<input type="text" name="DiagnosisID" class="input" id="DiagnosisID" value="' . $diagnosisID . '" readonly>';
						} else {
							echo '<input type="text" name="DiagnosisID" class="input" id="DiagnosisID" value="DiagnosisID not provided" readonly>';
						}
						?>
        </div>
					<div class="input_wrap">
						<label for="TreatmentDate">Treatment Date</label>
						<input type="date" name="TreatmentDate" class="input" id="TreatmentDate">
					</div>
					<div class="input_wrap">
						<label for="TreatmentDescription">Treatment Description</label>
						<input type="text" name="TreatmentDescription" class="input" id="TreatmentDescription">
					</div>
					<div class="input_wrap">
						<label for="TreatmentNotes">Treatment Notes</label>
						<input type="text" name="TreatmentNotes" class="input" id="TreatmentNotes">
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
          <button type="submit" class="btn btn-success" name="submit">Add Treatment</button>
        </div>
        <div>
          <a href="diagnosistable.php" class="btn btn-danger">Cancel</a>
        </div>
				</div>
			</form>
		</div>
	</div>
	<div class="btns_wrap">
		<div class="common_btns form_1_btns">
			<button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		<div class="common_btns form_2_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			<button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		<div class="common_btns form_3_btns" style="display: none;">
			<button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
			<button type="button" href="diagnosistable.php" class="btn_done">Done</button>
		</div>
	</div>
</div>

<div class="modal_wrapper">
	<div class="shadow"></div>
	<div class="success_wrap">
		<span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
		<p>You have successfully completed the process.</p>
	</div>
</div>

<script type="text/javascript" src="scripts.js">
      btn_done.addEventListener("click", function(){
      modal_wrapper.classList.add("active");
      showSuccessMessage();
    })

    function showSuccessMessage() {
      var successWrap = document.querySelector(".success_wrap");
      successWrap.style.display = "block";
    }
</script>

</body>
</html>