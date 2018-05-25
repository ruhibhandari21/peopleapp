<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html>
<style>
body {font-family: Arial;}
* {box-sizing: border-box}
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: #474e5d;
    padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 30%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
	 display: none;
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}

.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
/*style for select box*/
.styled-select.slate {
	 width: 100%;
    padding: 13px;
    margin: 5px 0 22px 0;
  
    background: #f1f1f1;
	
	
   font-size: 18px;
   
   
}

select {
  font: 400 12px/1.3 "Helvetica Neue", sans-serif;
  -webkit-appearance: none;
  appearance: none;
  border: 1px solid #f1f1f1;
  line-height: 0;
  outline: 0;
  
  color: #000000;
  border-color: #f1f1f1;
  padding: 0.65em 2.5em 0.55em 0.75em;
 font-size: 18px
  background: linear-gradient(#000000, #000000) no-repeat,
              linear-gradient(-135deg, rgba(255,255,255,0) 50%, #f1f1f1 50%) no-repeat,
              linear-gradient(-225deg, rgba(255,255,255,0) 50%, #f1f1f1 50%) no-repeat,
              linear-gradient(#000000, #000000) no-repeat;
  background-color: #f1f1f1;
  background-size: 1px 100%, 20px 20px, 20px 20px, 20px 60%;
  background-position: right 20px center, right bottom, right bottom, right bottom;   
}


/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>


<div>
  
  <form class="modal-content" action="/action_page.php">
    <div class="container">
      <h1>Add Student</h1>
      <p>Please fill in this form to create a student account.</p>
      <hr>
	   <label><b>Addmission No</b></label>
      <input type="text" placeholder="Enter your admission number" name="admissionnumber" required>
	  
	   <label><b>First Name</b></label>
      <input type="text" placeholder="Enter your first name" name="firstname" required>
	  
	   <label><b>Middle Name</b></label>
      <input type="text" placeholder="Enter your middle name" name="middlename" required>
	  
	   <label><b>Last Name</b></label>
      <input type="text" placeholder="Enter your last name" name="lastname" required>
	  
      <label><b>Email ID</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>
	  
	  <label><b>Select Class</b></label>
	  <div>
	  <select>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>
</div>



     

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>


</body>
</html>

