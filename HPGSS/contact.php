<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="hostel.css" />

</head>

<body>
<?php
include("header.php");
if (isset($_POST['submit']))
{$name=$_POST['name'];
$email=$_POST['email'];
$room=$_POST['room'];
$message=$_POST['message'];


 $sql="insert into tbl_contact (id,name,email,room,message,status)values (0,'$name','$email','$room','$message',0)";
$qry=mysqli_query($conn,$sql);
	}
?>
<div class="row" id="contact">
<h1><u>CONTACT US</u></h1><hr/>
<div class="col-md-7">
<H2 style="text-align:center; font-weight:bolder; color:#FFFFFF"> SUBMIT YOUR FORM </H2><HR />


<form  method="post">

<input type="text" placeholder="Enter your name"  class="form-control" name="name"/><br/>
<input type="text" placeholder="Enter your Email address" class="form-control" name="email" /><br />
<select class="form-control" name="room">
<option value="Room">-ROOMS AVAIBILITY-</option>
<option value="Single">SINGLE</option>
<option value="Double">DOUBLE</option>
<option value="Air conditioner">AIR CONDITIONER</option>
<option value="Non-air"> NON-AIR CONDITIONER</option>
<option value="mess">MESS</option>
<option value="Other">OTHERS</option>
</select><br />
<textarea cols="20" placeholder="Enter your message" class="form-control" name="message"></textarea><br/>
<input type="submit"  class="form-control btn-info" name="submit"  /><br />
</form>





</div>
<div class="col-md-5">
<h2><u><i class="glyphicon glyphicon-map-marker"></i>OUR LOCATION</u></h2>
<p>3481 melrose place deverly hills <br/>
CA 90423<br />
#gurukul road,oppsite dhillon colony
</p>
<h2><u><i class="glyphicon glyphicon-earphone"></i>CALL US ON</u></h2>
<P>(+1)9945855254<BR />
(+1)8054687293<BR />
+91-7789464605<BR />
+91-9888723867<br />
+91-9699416569</P>
<h2><u><i class="glyphicon glyphicon-envelope"></i>SEND YOUR MESSAGE</u></h2>
<p>swagatam@gmail.com<br />
swagatam@facbook.com</p>
</div>
</div>
<?php
include("footer.html")
?>
</body>
</html>



