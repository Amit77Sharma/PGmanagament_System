<?php include 'header.php'; 
if(isset($_POST['submit']))
{
	if($_POST['submit']=='Verify')
	{
		$_SESSION['user_id']=$_POST['id'];
	}
	else if($_POST['submit']=='changepass')
	{
		if($_POST['password']==$_POST['password2'])
		{
			if($conn->query("update tbl_login_details set password='".$_POST['password']."' where id=".$_SESSION['user_id'])==true)
			{
				session_unset();
				session_destroy();
				?>
				<script type="text/javascript">alert("Password Changed Succesfully");
				window.location='loginpage.php';</script>
				<?php
			}
		}
		else
		{
			$msg='Password Not Matched !!!';
		}
	}
}
else
{
	header('Location:index.php');
}
?>

<div id="absoluteCenteredDiv" style="margin-top: 30px; border-radius: 20px;" >
    <form action="" method="post">
        <div class="box">
            <h1>Change Password</h1>
            <input class="username" id="password" onkeyup="CheckPassword(this);" type="password" name="password" placeholder="New Password" required />
	        <span class="alert alert-danger" style="display: none; height: 25px;padding: 3px;" id="result1"></span>
	        <span class="alert alert-success" style="display: none; height: 25px;padding: 3px;" id="result"></span>
	        <input class="username" type="password" name="password2" placeholder="Retype Password" required />
	        <?php if(isset($msg)){ ?><p style="color:red;"><?=$msg;?></p><?php } ?>
            <button type="submit" name="submit" value="changepass" class="button btn btn-primary">Change</button>
        </div>
    </form>
</div>

<?php include 'footer.html'; ?>