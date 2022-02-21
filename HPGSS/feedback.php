
<?php
include("header.php");
if (isset($_POST['submit']))
{$name=$_POST['name'];
$email=$_POST['email'];
$food=$_POST['food'];
$room=$_POST['room'];
$clean=$_POST['clean'];
$staff=$_POST['staff'];
$services=$_POST['services'];

 $sql="insert into tbl_feedback (id,name,email,food,room,cleanness,staffmember,services,status)values (0,'$name','$email','$food','$room','$clean','$staff','$services',0)";
$qry=mysqli_query($conn,$sql);
	}
?>
<html>

<form method="post">

    
<div id="login-box"><span style="background-color:#999">
    <div class="center">

    <div class="containersign">

      <h1><b>Feedback</b></h1>

    <hr>
   
      

     <table border='0' width='480px' cellpadding='0' cellspacing='0' align='left'>
      <tr>
      <td> <label for="name"><b>Name</b></label></td>

      <td><input type="text" placeholder="Enter your Name" name="name" id="name" required></td></tr> 

      
     <tr>
     <td> <label for="email"><b>Email</b></label> </td>

     <td> <input type="text" placeholder="Enter your Email Address" name="email" id="email" required></td>
     </tr> 

     <tr>
     
     
        <td><label for="good "><b>Food</b></label></td>
        <td><input type='radio' name="food" value="good"> Good
          <input type='radio' name="food" value="bad">Bad 
          <input type='radio' name="food" value="average"> Average </td>
          
     </tr>


     
     


     <tr>
     
     
        <td><label for="good "><b>Room</b></label></td>
        <td><input type="radio" name="room" value="good"> Good
          <input type="radio" name="room" value="bad">Bad 
           <input type='radio' name="room" value="average"> Average </td>
      </tr>

     
     <tr>
     
     
        <td><label for="good "><b>Cleanness</b></label></td>
        <td><input type="radio" name="clean" value="good"> Good
          <input type="radio" name="clean" value="bad">Bad 
          <input type='radio' name="clean" value="average"> Average  </td>
      </tr>

     
     <tr>
     
     
        <td><label for="good "><b>Staff Member</b></label></td>
        <td><input type="radio" name="staff" value="good"> Good
          <input type="radio" name="staff" value="bad">Bad 
           <input type='radio' name="staff" value="average"> Average </td>
      </tr>


      
      
      <tr>
      
     
     
        <td><label for="good "><b>Services</b></label></td>
        <td><input type="radio" name="services" value="good"> Good
          <input type="radio" name="services" value="bad">Bad 
           <input type='radio' name="services" value="average"> Average </td>
      </tr>
     

      
     <hr>

    </table>


    <hr>

     

     <button type="submit" class="registerbtn" name="submit">Submit</button>
  </div>

  <div class="containersign signin">

    

  </div>
</div></span></div>


</form>
<?php
include("footer.html")
?>
      
      
      </body>
      

      </html>
      

     