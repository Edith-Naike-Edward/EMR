<?php
session_start();
include "dbconn.php";
$mypid = isset($_SESSION["patientemail"]) ? $_SESSION["patientemail"] : "";
if($mypid==""){header("Location: logout.php");}else{}
echo "$mypid";
$checkemailQuery = "SELECT * FROM patient WHERE PatientEmail='$mypid'";
$check= mysqli_query($conn, $checkemailQuery);
$button='You have to sign up to register.';
if ($conn) {
	if (mysqli_num_rows($check)> 0) {
		echo '<br> You have already registered.';
		$button='';

}else{
	$button='<input type="submit" name="submit"  value="Register"/>';
}
} else {
echo 'Connection failed.';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Registration Form</title>
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
		input[type=text], input[type=tel], input[type=email], input[type=date] select {
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
</head>
<body>
	<form action="connectpatreg.php" method="post">
		<h2>Patient Registration Form</h2>
		<div class="row">
			<div class="col">
				<label for="firstName">First Name:</label>
				<input type="text" id="firstName" name="firstName" required>
			</div>
			<div class="col">
				<label for="lastName">Last Name:</label>
				<input type="text" id="lastName" name="lastName" required>
			</div>
      <div class="col">
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
      </div>
      <div class="col">
        <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
      </div>
		</div>
		<div class="row">
			<div class="col">
				<label for="mobileNumber">Mobile Number:</label>
				<input type="tel" id="mobileNumber" name="mobileNumber" required>
			</div>
			<div class="col">
				<label for="gender">Gender:</label>
				<select id="gender" name="gender" required>
					<option value="">-- Select Gender --</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<label for="occupation">Occupation:</label>
				<input type="text" id="occupation" name="occupation" required>
			</div>
			<div class="col">
				<label for="postalAddress">Postal Address:</label>
				<input type="text" id="postalAddress" name="postalAddress" required>
			</div>
      <div class="col">
				<label for="physicalAddress">Physical Address:</label>
				<input type="text" id="physicalAddress" name="physicalAddress" required>
			</div>
		</div>
    <div class="col">
      <h2>Next of Kin Information:</h2>

          <label for="nok_first_name">First Name:</label>
          <input type="text" id="nok_first_name" name="nok_first_name" required>

          <label for="nok_last_name">Last Name:</label>
          <input type="text" id="nok_last_name" name="nok_last_name" required>

          <label for="nok_relation">Relation:</label>
          <input type="text" id="nok_relation" name="nok_relation" required>

          <label for="nok_phone">Phone Number:</label>
          <input type="tel" id="nok_phone" name="nok_phone" required>

          <label for="nok_email">Email:</label>
          <input type="email" id="nok_email" name="nok_email" required>   
    </div>
		<input type="hidden" id="uid" name="uid" value="<?php echo $mypid;?>"required>
    <br>
		<?php echo $button;?>
</form>
</body>
</html>
