<?php
if($_GET['user_type_id']!=3 && $_GET['user_type_id']!=4 and !isset($_GET['user_type_id']))
{
  header('Location:index.php');
}
else
{
  $typeid=$_GET["user_type_id"];
}
include'header.php';
if(isset($_POST["signup_submit"]))
{
  $name=$_POST["name"];
  $gender=$_POST["gender"];
  $email=$_POST["email"];
  $phonenumber=$_POST["phonenumber"];
  $password=$_POST["password"];
  $pswrepeat=$_POST["password2"];
  $date=date("d/m/y");
  $ip=getUserIpAddr();
  if($password==$pswrepeat)
  {
    $sqlcheck="SELECT * from tbl_login_details where (email='$email' or phonenumber='$phonenumber')";
    $qrycheck=$conn->query($sqlcheck);
    $rowcount=mysqli_num_rows($qrycheck);
    if($rowcount<=0)
    { 
      $sql="insert into tbl_login_details (id,name,gender,email,phonenumber,password,typeid,datetime,ip,status) values(0,'$name','$gender','$email','$phonenumber','$password','$typeid','$date','$ip',0)";
      $qry=$conn->query($sql);
      if($qry==true)
      {
        header('Location:otp.php?id='.$conn->insert_id.'&otp=send');
      }
    }
    else
    {
      ?><script type="text/javascript">alert("Email Id already exist !!!");</script><?php
    }
  }
}
?>
<form method="post">
  <!-- <link rel="stylesheet" href="usersignupform.css"> -->
  <div class="userbody">
    <div class="usersignup" style="margin-top:30%;">
      <div id="userlogin-box">
        <div class="userleft">
          <h1 class="userh1">Sign up</h1>

          <input class="userinput" type="text" name="name" placeholder="Name" required />
          <select class="userinput" style="width:100%;" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
          <input class="userinput" type="text" name="email" placeholder="E-mail" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"/>
          <input class="userinput allow_numeric" maxlength="10" type="text" name="phonenumber" placeholder="Phone Number" required />
          <input class="userinput" id="password" onkeyup="CheckPassword(this);" type="password" name="password" placeholder="Password" required />
          <span class="alert alert-danger" style="display: none; margin-top: -10px;height: 25px;padding: 3px;" id="result1"></span>
          <span class="alert alert-success" style="display: none; margin-top: -10px;height: 25px;padding: 3px;" id="result"></span>
          <input class="userinput" type="password" name="password2" placeholder="Retype password" required />

          <input class="btn btn-success btn-block" type="submit" name="signup_submit" value="Sign up" />
        </div>

        <div class="userright">
        <span class="userloginwith">Sign in with<br />social network</span>

        <button class="social-signin facebook">Log in with facebook</button>
        <button class="social-signin twitter">Log in with Twitter</button>
        <button class="social-signin google">Log in with Google+</button>
        </div>
        <div class="or">OR</div>
      </div>
    </div>
  </div>
</form>
<?php
include("footer.html")
?>
</body>
</html>
