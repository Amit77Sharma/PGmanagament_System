<?php
session_start();
include "connect.php";
if(isset($_SESSION['username'])){
  $userid=$_SESSION['username'];
  $sqllog="select * from tbl_owner_details where email='$userid' or phonenumber='$userid'";
  $qrylog=$conn->query($sqllog);
  if(mysqli_num_rows($qrylog))
  {
    $rowlog=$qrylog->fetch_assoc();
  }
}
?> 


<html lang="en" dir="ltr">
  <head>
    <title>SWAGATAM</title>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
     <link rel="stylesheet" href="roomdetails.css">
        <link rel="stylesheet" href="usersignupform.css">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="ownerlisting.css">

    <link rel="stylesheet" href="bootstrap.min.css">
     <link rel="stylesheet" href="loginpage.css">
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>

  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">SWAGATAM</label>
      <ul>
        <li><div><a class="active" href="index.php">Home</a></div></li>
      <?php if(isset($_SESSION['username'])){?><li><div><a href="roomlist.php">Room List</a></div></li><?php }?>
        <?php if(!isset($_SESSION['username'])){?><li><div><a href="loginpage.php">Log In</a></div></li><?php }else{ ?><li><div><a href="logout.php">Log Out</a></div></li><?php } ?>
        <?php if(!isset($_SESSION['username'])){?><li><div class="dropdown"><a class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">Signup</a><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a style="color: black;" class="dropdown-item" href="#">Action</a>
    <a style="color: black;" class="dropdown-item" href="#">Another action</a></div></div></li><?php }else{ ?><li><a href="ownerprofile.php">Profile</a></li><?php } ?>
     <li><div><a href="#">About Us</a></div></li>
        <li><div><a href="#">Contact</a></div></li>
         <li><div><a href="#">FeedBack</a></div></li>
       
        </ul>
    </nav>
    <!-- <section></section> -->


    <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>

 