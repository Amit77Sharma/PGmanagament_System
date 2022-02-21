 
<?php
include 'header.php';
?>
<form action="action_page.php">

    
<div id="login-box">
    <div class="center">

    <div class="containersign">

      <h1>Sign Up</h1>

    <hr>
   
      <p><b>Please fill  this form  to create an account.</b></p>

     <table border='0' width='480px' cellpadding='0' cellspacing='0' align='left'>
      <tr>
      <td> <label for="name"><b>Name</b></label></td>

      <td><input type="text" placeholder="Enter your Name" name="name" id="name" required></td></tr> 

      <tr>
        <td><label for="gender"><b>Gender</b></label></td>
        <td><input type="radio" name="gender" value="male"> Male
          <input type="radio" name="gender" value="male">Female </td>
      </tr>

     <tr>
     <td> <label for="email"><b>Email</b></label> </td>

     <td> <input type="text" placeholder="Enter your Email Address" name="email" id="email" required></td>
     </tr> 

     <tr>
     <td> <label for="adhaar"><b>Adhaar No.</b></label> </td>

     <td> <input type="text" data-type="adhaar-number" maxLength="19" placeholder="Enter your Adhaar no."></td>
     </tr> 


     <tr>
     <td> <label for="city"><b>City</b></label> </td>

     <td> <input type="text" placeholder="Enter your City Name" name="city" id="city" required></td>
     </tr> 

     <tr>
     <td> <label for="Address"><b>Address</b></label> </td>

     <td> <input type="text" placeholder="Enter your Address" name="Address" id="address" required></td>
     </tr> 

      <tr>
     <td> <label for="phone-number"><b>Phone Number</b></label> </td>

     <td> <input type="text" placeholder="Enter your Phone Number" name="phone-number" id="phone-number" required></td>
     </tr> 

      <tr>
     <td> <label for="Country"><b>Country</b></label> </td>

     <td> <input type="text" placeholder="Enter your Country" name="country" id="country" required></td>
     </tr> 

      <tr>
     <td> <label for="pincode"><b>Pincode</b></label> </td>

     <td> <input type="text" placeholder="Enter your Pincode" name="Pincode" id="pincode" required></td>
     </tr> 

      <tr>
        <td><label for="psw"><b>Password</b></label></td>

    <td><input type="password" placeholder="Enter Password" name="psw" id="psw" required> </td>
  </tr>

    <tr>
      <td><label for="psw-repeat"><b>Repeat Password</b></label></td>

    <td><input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required></td>
    </tr> 
     <hr>

    </table>


    <hr>

     <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

     <button type="submit" class="registerbtn">Sign in</button>
  </div>

  <div class="containersign signin">

    <p>Already have an account? <a href="#">Log in</a>.</p>

  </div>
</div></div>
</div>

</form>

  
      </body>
      <html>