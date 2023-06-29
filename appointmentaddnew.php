<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Appointment</title>
   <style>
      .container.appointment-module {
    max-width: 600px;
    margin: auto;
    padding: 50px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #0080FF;
    font-family: Arial, sans-serif;
  }
  
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  
  form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .form-group {
    width: 48%;
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    padding: 20px;
  }
  
  input[type="text"],
  select,
  textarea {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
  }
  
  input[type="date"],
  input[type="time"] {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
  }
  
  button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }
  
  button[type="submit"]:hover {
    background-color: #45a049;
  }
  
  @media (max-width: 768px) {
    .form-group {
      width: 100%;
    }
  }
  
    </style>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      PHP Complete CRUD Application
   </nav>
   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new appointment</p>
      </div>
      <div class="appointment-module">
      <h2>Appointment Details</h2>
      <form action="insert.php" method="post" style="width:50vw; min-width:300px;">
         <div class="form-group">
            <label for="doctor-id">Doctor ID:</label>
            <input type="text" id="doctor-id" name="doctor-id" required>
          </div>
          <div class="form-group">
            <label for="patient-id">Patient ID:</label>
            <input type="text" id="patient-id" name="patient-id" required>
          </div>
          <div class="form-group">
            <label for="visit-type">Visit Type:</label>
            <select id="visit-type" name="visit-type" required>
              <option value="checkup">Checkup</option>
              <option value="consultation">Consultation</option>
              <option value="treatment">Treatment</option>
            </select>
          </div>
          <div class="form-group">
            <label for="visit-reason">Visit Reason:</label>
            <textarea id="visit-reason" name="visit-reason" required></textarea>
          </div>
          <div class="form-group">
            <label for="appointment-time">Appointment Time:</label>
            <input type="time" id="appointment-time" name="appointment-time" required>
          </div>
          <div class="form-group">
            <label for="appointment-status">Appointment Status:</label>
            <select id="appointment-status" name="appointment-status" required>
              <option value="confirmed">Confirmed</option>
              <option value="pending">Pending</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          <div class="form-group">
            <label for="appointment-date">Appointment Date:</label>
            <input type="date" id="appointment-date" name="appointment-date" required>
          </div>
          <div class="form-group">
            <label for="appointment-id">Appointment ID:</label>
            <input type="text" id="appointment-id" name="appointment-id" required>
          </div>
          <div class="form-group">
            <label for="medical-record">Medical Record ID:</label>
            <input type="text" id="medical-record" name="medical-record" required>
          </div>
          <div>
            <button type="submit" class="btn btn-success" name="submit">Save</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
         </div>
      </form>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
