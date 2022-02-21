<?php
error_reporting(0);
session_start();
include 'common_fun.php';
include 'connect.php';
if(isset($_SESSION['username'])){
  $userid=$_SESSION['username'];
  $sqllog="select * from tbl_login_details where email='$userid' or phonenumber='$userid'";
  $qrylog=$conn->query($sqllog);
  if(mysqli_num_rows($qrylog))
  {
    $rowlog=$qrylog->fetch_assoc();
    if ($rowlog['typeid']==4) {
      $sqllogcheck="select * from tbl_owner_details where login_id=".$rowlog['id'];
      $qrylogcheck=$conn->query($sqllogcheck);
      if(mysqli_num_rows($qrylogcheck)<=0)
      {
        if(!isset($_GET['come']))
        {
          header('Location:owner_detail_form.php?come=true');
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sawagtam</title>
  <link rel="stylesheet" type="text/css" href="design/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="design/css/signup.css"> 
  <link rel="stylesheet" href="design/css/css.css">
  <link rel="stylesheet" href="design/css/roomdetails.css">
  <link rel="stylesheet" href="design/css/usersignupform.css">
  <link rel="stylesheet" href="design/css/loginpage.css">
  <link rel="stylesheet" href="design/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="design/css/roomviewimg.css">

  <script src="design/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script src="design/js/jquery.min.js"></script>
  <script src="design/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="design/bootstrap-3.3.7-dist/js/jquery-1.11.2.js"></script>

</head>
<body>
<div class="row-fluid" id="top">
<div class="col-md-5">
<marquee dircetion="right" height="100px"><i class="glyphicon glyphicon-home"></i><label>17,MALL ROAD, Bokaro</label>
<i class=" glyphicon glyphicon-phone-alt"></i><label>+91-7717726919</label></marquee>
</div>
  <div class="col-md-7" id="icon"> <span class="fa fa-facebook"></span> <span class="fa fa-instagram"></span> <span class="fa fa-google"></span> <span class="fa fa-google-plus"></span> <span class="fa fa-youtube"></span> <span class="fa fa-linkedin"></span> </div>
</div>
<div class="row col-sm-12 col-md-12 col-lg-12" id="nav">
  <div class="col-sm-12 col-md-4"> <img src="himages/log1.jpg" width="100%" height="200px" /> </div>
  <div class="col-sm-12 col-md-8">
    <ul class="nav nav-pills" style="float:right;">
      <li class="li"><a href="index.php">HOME</a></li>
      <li class="li"><a href="service.php">SERVICES</a></li>
     <!-- <li><a href="SIGNUP.php">SIGN UP</a></li> -->
       <?php if(isset($_SESSION['username'])){ if($rowlog['typeid']==4){ ?><li class="li"><a href="appartmentlist.php">Appartment List</a></li> <?php }elseif($rowlog['typeid']==3){ ?> <li class="li"><a href="userpickedroom.php">Picked List <i class="glyphicon glyphicon-tent"></i></a></li> <?php } } ?>
        <?php if(!isset($_SESSION['username'])){?><li class="li">
            <a class="dropdown-toggle" data-toggle="dropdown">Signup</a>
            <ul class="dropdown-menu">
              <li><a style="text-align: center;" href="usersignupform.php?user_type_id=3">Sign Up</a></li><br>
              <li><a style="text-align: center;" href="usersignupform.php?user_type_id=4">Renter Sign Up</a></li>
              <!--<li><a href="#">JavaScript</a></li>-->
            </ul>
          </li><?php }else{ ?><li class="li"><a href="ownerprofile.php">Profile</a></li><?php } ?>
      <?php if(!isset($_SESSION['username'])){ ?><li class="li"><a href="loginpage.php">Log In</a></li><?php }else{ ?><li class="li"><a href="logout.php">Log Out <i class="glyphicon glyphicon-log-out"></i></a></li><?php } ?>
    </ul>
  </div>
</div>