
<?php
include("header.php");
if (isset($_POST['submit']))
{
	$user=$_POST['user'];
	$password=$_POST['password'];


	$sql="select * from signin where (email= '$user' or phonenumber='$user') and password='$password'";
	$qry=mysqli_query($con,$sql); 
	$count=mysqli_num_rows($qry);
	if ($count >=1)
	{
	
		$_SESSION['user']=$user;
		header('Location:index.php');
	
	} else {?>
		<Script>alert('invalid username or password!!!');</script>
	<?php
	
	}
}
?>
<html>
<form method="post">
  <div id="login-box"><span style="background-color:#999">
    <div class="center">
      <div class="containersign">
        <h1><b>LOGIN</b></h1>
        <hr>
        <table border='0' width='480px' cellpadding='0' cellspacing='0' align='left'>
          <tr>
            <td><label for="name"><b>USER</b></label></td>
            <td><input type="text" placeholder="Enter your user id" name="user" id="name" required></td>
          </tr>
          <tr>
            <td><label for="email"><b>password</b></label></td>
            <td><input type="text" placeholder="Enter your password" name="password" id="password" required></td>
          </tr>
          <hr>
        </table>
        <hr>
        <button type="submit" class="registerbtn" name="submit">Submit</button>
      </div>
      <div class="containersign signin"> </div>
    </div>
    </span></div>
</form>
<?php
include("footer.html")
?>
</body></html>
