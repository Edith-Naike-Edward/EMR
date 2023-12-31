<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      /* Google Font CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Silk display" , sans-serif;
}
body{
  min-height: 100vh;
  width: 100%;
  background: #0080FF;
  display: flex;
  align-items: center;
  justify-content: center;
}
.container{
  width: 85%;
  background: #fff;
  border-radius: 6px;
  padding: 20px 60px 30px 40px;
  box-shadow: 0 5px 10px rgb(39, 38, 37);
}
.container .content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.container .content .left-side{
  width: 25%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  position: relative;
}
.content .left-side::before{
  content: '';
  position: absolute;
  height: 70%;
  width: 2px;
  right: -15px;
  top: 50%;
  transform: translateY(-50%);
  background: #ffffff;
}
.content .left-side .details{
  margin: 14px;
  text-align: center;
}
.content .left-side .details i{
  font-size: 30px;
  color: #010C80;
  margin-bottom: 10px;
}
.content .left-side .details .topic{
  font-size: 18px;
  font-weight: 500;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two{
  font-size: 14px;
  color: #010C80;
}
.container .content .right-side{
  width: 75%;
  margin-left: 75px;
}
.content .right-side .topic-text{
  font-size: 23px;
  font-weight: 600;
  color: black;
}
.right-side .input-box{
  height: 50px;
  width: 100%;
  margin: 12px 0;
  padding: 10px;
}
.right-side .input-box input, .right-side .input-box select,
.right-side .input-box textarea{
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  font-size: 16px;
  background: #F0F1F8;
  border-radius: 6px;
  padding: 0 20px;
  resize: none;
}
.right-side .input-field{
    display: flex;
    width: 100%;
    flex-direction: column;
    margin: 4px 0;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    color: #707070;
    height: 100%;
    border: none;
    outline: none;
    font-size: 16px;
    background: #F0F1F8;
    border-radius: 6px;
    padding: 0 15px;
    resize: none;
}

.right-side .message-box{
  min-height: 110px;
}
.right-side .input-box textarea{
  padding-top: 6px;
}
.right-side .button{
  display: inline-block;
  margin-top: 12px;
}
.right-side .button input[type="submit"]{
  color: white;
  font-size: 18px;
  outline: none;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  background: #010C80;
  cursor: pointer;
}
.button input[type="button"]:hover{
  background: hsl(233, 8%, 62%);
}

@media (max-width: 950px) {
  .container{
    width: 90%;
    padding: 30px 40px 40px 35px ;
  }
  .container .content .right-side{
   width: 75%;
   margin-left: 55px;
}
}
@media (max-width: 820px) {
  .container{
    margin: 40px 0;
    height: 100%;
  }
  .container .content{
    flex-direction: column-reverse;
  }
 .container .content .left-side{
   width: 100%;
   flex-direction: row;
   margin-top: 40px;
   justify-content: center;
   flex-wrap: wrap;
 }
 .container .content .left-side::before{
   display: none;
 }
 .container .content .right-side{
   width: 100%;
   margin-left: 0;
 }
}


    </style>
   </head>
<body>
  
  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Highview, Nairobi</div>
          <div class="text-two">Highview towers</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+254 0129304810</div>
          <div class="text-two">+254 0129192093</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">cocb@gmail.com</div>
          <div class="text-two">info.coc@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Request An Appointment</div>
        <h4>New Patient?</h4>
        <a href="patientreg.php" class="button">
          Register Here 
        </a>
      <form action="requestappt.php" method="post">
        <div class="input-box">
          <label>First name:</label>
          <input type="text" id="PatientFirstName" name="PatientFirstName" placeholder="Enter your first name" required>
        </div>
        <div class="input-box">
          <label>Last name:</label>
          <input type="text" id="PatientLastName" name="PatientLastName" placeholder="Enter your last name" required>
        </div>
        <div class="input-box">
          <label>Preferred Appointment Date:</label>
          <input type="date" id="PreferredApptDate" name="PreferredApptDate" placeholder="Enter your preferred appointment date" required>
         </div>
         <div class="input-box">
          <label>Phone Number:</label>
          <input type="tel" id="PatientPhoneNo" name="PatientPhoneNo"  placeholder="Enter your phone number" required>
        </div>
        <div class="input-box">
          <label>Email:</label>
          <input type="text" id="PatientEmail" name="PatientEmail"  placeholder="Enter your email address" required>
        </div>
        <div class="input-box">
          <label for="Visit_type">Visit Type:</label>
          <select id="Visit_type" name="Visit_type" required>
            <option value="checkup">Checkup</option>
            <option value="consultation">Consultation</option>
            <option value="treatment">Treatment</option>
          </select>
        </div>
        <div class="input-box message-box">
          <label>Visit reason:</label>
          <input type="text" id="Visit_reason" name="Visit_reason" placeholder="Enter your visit reason" required>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Request Here" >
          <!--<input type="submit" name="submit"  value="Register"/>-->
        </div>
      </form>
    </div>
    </div>
  </div>
</body>
</html>
