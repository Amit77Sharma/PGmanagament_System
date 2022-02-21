<?php
include("header.php");
$sql="select rd.id as room_id,ad.name as appart_name,address,near,city,district,state,country,roomno,rt.name as room_type,rd.status as room_status,price,basis,booking_status from tbl_room_details as rd left join tbl_room_type as rt on rd.type_id=rt.id left join tbl_appartment_details as ad on rd.appartment_id=ad.id where rd.booking_status=0 and rd.status=1";
	$qry=$conn->query($sql);
?>


<div class="" id="image">
<?php include("slider.html") ?>
</div>



<div class="row col-sm-12 col-md-12 col-lg-12 " id="welcome">
<marquee direction="down"><h1>WELCOME TO SWAGATAM</h1><hr/></marquee>
<?php while ($rows=$qry->fetch_array()) { ?>
<a href="roomviewdetails.php?id=<?=$rows['room_id'];?>"><div class="col-sm-6 col-md-4 col-lg-3">
<?php $sqlroomimg="select * from tbl_room_image where room_id=".$rows['room_id'];
	  $rowsroomimg=$conn->query($sqlroomimg)->fetch_assoc(); ?>
<center><img src="<?=$rowsroomimg['loc'].'/'.$rowsroomimg['name'];?>" height="150px">

<p style="font-size:13px;"><?=strtoupper($rows['appart_name'])." (".strtoupper($rows['room_type']).")";?></p>
<p style="font-size:10px; margin-top: -8px;"><?="Near ".strtoupper($rows['near']);?></p>
<p style="font-size:12px; margin-top: -8px;"><?="(".strtoupper($rows['city']).", ".strtoupper($rows['district']).", ".strtoupper($rows['state']).")";?>
</p>
<p style="font-size:12px; color: red; margin-top: -8px;"><i class="fa fa-rupee" style="font-size:12px"></i><?=strtoupper($rows['price'])." ";?><span style="color: Blue;"><?=" ".strtoupper($rows['basis']);?></span>
</p></center>
</div></a><?php } ?>
</div>


<div class="row col-sm-12 col-md-12 col-lg-12" id="department">
<h1>ROOMS AVAIBILITY</h1><hr />
<a href=""><div class="col-md-6">
<img src="himages/pg3.jpg" width="100%" height="250px" />
<h3>SINGLE ROOM</h3>
</div></a>
<a href=""><div class="col-md-6">
<img src="himages/room 4.jpg" width="100%" height="250px" />
<h3>DOUBLE ROOM </h3>
</div></a>
<div class="col-md-6">
<a href=""><img src="himages/pg1.jpg" width="100%" height="250px" />
<h3>AIR CONDITIONER</h3>
</div></a>
<a href=""><div class="col-md-6">
<img src="himages/pg4.jpg" width="100%" height="250px" />
<h3>NON-AIR CONDITIONER</h3>
</div></a>
<a href=""><div class="col-md-6">
<img src="himages/2 bhk.jpg" width="100%" height="250px" />
<h3>2 BHK</h3>
</div></a>
<a href=""><div class="col-md-6">
<img src="himages/3 bhk.jpg" width="100%" height="250px" />
<h3>3 BHK</h3>
</div></a>
</div>


<div class="row col-sm-12 col-md-12 col-lg-12" id="spcialization">
<h1>OUR SPECIALIZATION</h1>
<div class="col-md-6" id="multi">
<h3>INTERNET</h3><hr />
<p>Free internet  </p></div> 
<div class="col-md-6" id="qulified">
<h3>GARDEN</h3><hr />
<p>Best garden </p></div>
<div class="col-md-6" id="hours">
<h3>MEETING HALL</h3><hr />
<p>For working </p>
</div>
<div class="col-md-6" id="emer">
<h3>24*7 HOUR AVAILABLE</h3><hr />
<p>All time available for services</p>
</div>
</div>



<?php
include("footer.html")
?>         
 


</body>
</html>
