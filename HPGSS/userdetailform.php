 
<?php
include 'header.php';
if(isset($rowlog['typeid']))
{
  if($rowlog['typeid']!=3)
  {
    header('Location:index.php');
  }
}
else{header('Location:index.php');}
if(isset($_GET['id']))
{
  $sqlcheck="select * from tbl_owner_details where id=".$_GET['id'];
  $rowcheck=$conn->query($sqlcheck)->fetch_assoc();
}
if(isset($_POST['submit']))
{
  $fname=$_POST['fname'];
  $mname=$_POST['mname'];
  $lname=$_POST['lname'];
  $aadhar=$_POST['aadhar'];
 /* $gender=$_POST['gender'];
  $pin=$_POST['pincode'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $country=$_POST['country'];*/
  $address=$_POST['address'];
  $ip=getUserIpAddr();
  $date=$date=date("d/m/y");
  if($_POST['submit']=='add')
  {
    $sqlcheck="select * from tbl_owner_deatils where adhaar=$aadhar";
    if(mysqli_num_rows($conn->query($sqlcheck))<=0)
    {
      $logid=$rowlog['id'];
      echo $sql="INSERT into tbl_user_details (id, login_id, f_name, m_name, l_name,adhaar, address, date, ip, status) values (0,$logid,'$fname','$mname','$lname','$aadhar','$address','$date','$ip',0)";
      if($conn->query($sql)==true)
      {
        header('Location:roomviewdetails.php?id='.$_GET['room_id']);
      }
      else
      {
        ?><script>alert('Something went wrong !!!');window.location='userdetailform.php?room_id=<?=$_GET['room_id'];?>';</script><?php
      }
    }
  }
  else if($_POST['submit']=='update')
  {
    if(isset($_GET['id']))
    {
      if($rowcheck['login_id']==$rowlog['id'])
      {
        echo $sqlupdate="update tbl_owner_details set f_name='$fname',m_name='$mname',l_name='$lname',gender='$gender',pincode='$pin',city='$city',state='$state',country='$country',address='$address',adhaar='$aadhar',updatedate='$date',updateip='$ip' where id=".$_GET['id'];
        if($conn->query($sqlupdate)==true)
        {
          header('Location:ownerprofile.php');
        }
        else
        {
          ?><script>alert('Something went wrong !!!');window.location='owner_detail_form.php?id=<?=$_GET["id"];?>';</script><?php
        }
      }
    }
  }
}
?>
<form method="post">
<div id="login-box">
    <div class="center">
      <div class="containersign">
        <h1>Sign Up</h1>
      <hr>
       <table class="table" border='0' width='100%' align='left' style="min-height:300px">
        <tr>
        <td align="left" style="border-top :none;"> <label for="fname"><b>First Name</b></label><label style="color: red;float: right;">*</label></td>
        <td style="border-top :none;"><input class="form-control form-block" value="<?php if($rowcheck['f_name']!=""){ echo $rowcheck['f_name']; } ?>" type="text" placeholder="Enter your First Name" name="fname" id="name" required></td>
        </tr>
        <tr>
        <td align="left" style="border-top :none;"> <label for="mname"><b>Middle Name</b></label><label style="color: red;float: right;">*</label></td>
        <td style="border-top :none;"><input class="form-control form-block" value="<?php if($rowcheck['m_name']!=""){ echo $rowcheck['m_name']; } ?>" type="text" placeholder="Enter your Middle Name" name="mname" id="name"></td>
        </tr>
        <tr>
        <td align="left" style="border-top :none;"> <label for="lname"><b>Last Name</b></label><label style="color: red;float: right;">*</label></td>
        <td style="border-top :none;"><input class="form-control form-block" value="<?php if($rowcheck['l_name']!=""){ echo $rowcheck['l_name']; } ?>" type="text" placeholder="Enter your Last Name" name="lname" id="name" required></td>
        </tr>
        <tr>
       <td align="left" style="border-top :none;"> <label for="adhaar"><b>Adhaar No.</b></label> <label style="color: red;float: right;">*</label></td>
       <td style="border-top :none;"> <input class="form-control allow_numeric" value="<?php if($rowcheck['adhaar']!=""){ echo $rowcheck['adhaar']; } ?>" maxlength="15" name="aadhar" type="text" data-type="adhaar-number" maxLength="19" placeholder="Enter your Adhaar no." required></td>
       </tr>
        <tr>
        <td align="left" style="border-top :none;"> <label for="Address"><b>Address</b></label> <label style="color: red;float: right;">*</label></td>
        <td style="border-top :none;"><textarea class="form-control" value="" type="text" placeholder="Enter your Address" name="address" id="address" required><?php if($rowcheck['address']!=""){ echo $rowcheck['address']; } ?></textarea></td>
        </tr>   
      </table>
      <?php if(!isset($_GET['id'])){ ?><button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="add">Submit</button><?php }else{ ?><button type="submit" class="btn btn-warning btn-lg btn-block" name="submit" value="update">Update</button><?php } ?>
  </div>
   <?php if(!isset($_GET['id'])){ ?><div class="containersign signin">

  </div><?php } ?>
  </div></div>
</div>

</form>

<?php
include("footer.html")
?> 
  
      </body>
      <html>