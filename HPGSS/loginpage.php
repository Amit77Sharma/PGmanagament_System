<?php
include 'header.php';

if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT * from tbl_login_details where (email='$username' or phonenumber='$username') and password='$password'";
    $qry=$conn->query($sql);
    if($qry==true)
    {
        $rows=$qry->fetch_array();
        if(mysqli_num_rows($qry)>=1)
        {
            $qrych=$conn->query("select * from tbl_login_details where id=".$rows['id']." and status=1");
            if(mysqli_num_rows($qrych)>=1)
            {
                $_SESSION['username']=$username;
                ?><script>alert('Successfully logged in');</script><?php

                if($rows['typeid']==4)
                {
                    ?><script>window.location='appartmentlist.php';</script><?php   
                }
                else
                {
                    $sqllog="select * from tbl_login_details where email='$username' or phonenumber='$username'";
                    $qrylog=$conn->query($sqllog);
                    if(mysqli_num_rows($qrylog))
                    {
                        $rowlog=$qrylog->fetch_assoc();
                    }
                    if(isset($_GET['room_id']))
                    {
                        if(mysqli_num_rows($conn->query("select * from tbl_user_details where login_id=".$rowlog['id']))<=0)
                        {
                            ?><script>window.location="userdetailform.php?room_id=<?=$_GET['room_id'];?>";</script><?php
                        }
                        else
                        {
                            ?><script>window.location="roomviewdetails.php?id=<?=$_GET['room_id'];?>"</script><?php
                        }
                    }
                    else
                    {
                        ?><script>window.location="index.php";</script><?php
                    }
                }
            }
            else
            {
                ?>
                <script type="text/javascript">
                    alert("Email Not Activated\nVerify OTP To Activate");
                    window.location='otp.php?id=<?=$rows["id"];?>&otp=send';
                  </script>
                <?php
            }
        }
        else
        {
        ?>
        <script type="text/javascript">alert("User Name / Password Invalid !!!");</script>
        <?php
    } 
 }
}
if(isset($_POST['send_otp']))
{
    //echo "select * from tbl_login_details where email=".$_POST['email'];
    if(mysqli_num_rows($qry=$conn->query("select * from tbl_login_details where email='".$_POST['email']."'"))>=1)
    {
        $rows=$qry->fetch_assoc();
        header('Location:otp.php?id='.$rows["id"].'&otp=send&forget=1');
    }
    else
    {
        ?><script type="text/javascript">alert('Wrong Email !!!'); window.location='loginpage.php';</script><?php
    }
}
?>
    <div id="absoluteCenteredDiv" style="margin-top: 15%; border-radius: 20px;" >
        <form action="" method="post">
            <div class="box">
                <h1>Login Form</h1>
                <input class="username" name="username" type="text" placeholder="User Name" required="">
                <input class="username" name="password" type="password" placeholder="Password" required="">
                <a href="#"><input type="submit" name="submit" value="LogIn" class="button btn btn-primary"></a>
            </div>
        </form>
        <p>Forgot your password? <a data-toggle="modal" data-target="#myModal1" class="fpwd" href="#">Click Here!</a></p>
    </div>

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Mail to Send OTP</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <input class="form-control" id="" type="text" name="email" required="" placeholder="Enter Your Email Id">
            <input class="btn btn-success" type="submit" name="send_otp" style="margin-top: 20px;">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include 'footer.html'; ?>