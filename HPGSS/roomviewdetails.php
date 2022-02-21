<?php
include 'header.php';
if(isset($_POST['submit']))
{
	if(isset($_SESSION['username']))
	{
		if(mysqli_num_rows($conn->query("select * from tbl_user_details where login_id=".$rowlog['id']))>=1)
		{
			if(mysqli_num_rows($conn->query("select * from tbl_booking_list where room_id=".$_POST['submit']." and login_id=".$rowlog['id']))<=0)
			{
				if($conn->query("insert into tbl_booking_list (id,login_id,room_id,payment_status,status) values(0,'".$rowlog['id']."','".$_POST['submit']."',0,0)")!=true);
				{
					echo "Something Went Worng !!!";
				}
			}
			if(mysqli_num_rows($conn->query("select * from tbl_room_details where booking_status=0 and id=".$_POST['room_id']))>=0)
			{
				header('Location:payment.php?room_id='.$_POST['submit']);
			}
			else
			{
				?><script>alert('Someone Booked this Room Before You.. !!!');window.location='choosenroomlist.php';</script><?php
			}
		}
		else
		{
			header('Location:userdetailform.php?room_id='.$_POST['submit']);
		}
	}
	else
	{
		header('Location:loginpage.php?room_id='.$_POST['submit']);
	}
}
$sql="select rd.id as room_id,ad.id as appart_id,ad.name as appart_name, pincode, address, near, city, district, state, country, roomno, rt.name as room_type,price,basis, rd.status as room_status, booking_status from tbl_room_details as rd left join tbl_room_type as rt on rd.type_id=rt.id left join tbl_appartment_details as ad on rd.appartment_id=ad.id where rd.booking_status=0 and rd.status=1 and rd.id=".$_GET['id'];
	$rows=$conn->query($sql)->fetch_assoc();
	?>
<div class="col-sm-12 col-md-12 col-lg-12">
	<div class="col-sm-12 col-md-6 col-lg-4">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="row scrollmenu">
				<?php 
				$qryimg=$conn->query("select * from tbl_room_image where room_id=".$rows['room_id']);
				while($rowsimg=$qryimg->fetch_assoc()){ ?>
			  <a><div class="column">
			    <img src="<?=$rowsimg['loc'].'/'.$rowsimg['name'];?>" alt="Nature" style="width:auto;height: 60px;" onclick="myFunction(this);">
			  </div></a><?php } ?>
			</div>
		</div>
		<?php $rowsimg=$conn->query("select * from tbl_room_image where room_id=".$rows['room_id'])->fetch_assoc();?>
		<div class="col-sm-12 col-md-12 col-lg-12" style="padding-top: 10px;">
			<img src="<?=$rowsimg['loc'].'/'.$rowsimg['name'];?>" alt="Nature" id="expandedImg" style="width:100%">
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12" style="padding:15px;">
			<div class="col-sm-6 col-md-6 col-lg-6"><label class="btn btn btn-warning btn-block"><i class="fa fa-rupee" style="font-size:14px"></i><?php  echo $rows['price'];?></label></div>
			<form method="post">
			<div class="col-sm-6 col-md-6 col-lg-6"><button class="btn btn-primary btn-block" type="submit" name="submit" value="<?=$rows['room_id'];?>">BOOK NOW</button></div></form>
		</div>
	</div>
	
	<div class="col-sm-12 col-md-6 col-lg-8" style="box-shadow:2px 2px 3px grey; padding:10px;">

		<div class="col-sm-12 col-md-12 col-lg-12">
			<h4>Room Details:-</h4><hr>
			<table width="100%" style="min-height: 130px;">
				<?php if(isset($rows['appart_name'])){ ?><tr>
					<th>Appartment:</th>
					<td><?=$rows['appart_name'];?></td>
				</tr><?php } ?>
				<?php if(isset($rows['appart_id'])){ ?><tr>
					<?php $sqlappart="select * from tbl_appartment_facility where appartment_id=".$rows['appart_id'];
					$qryappart=$conn->query($sqlappart); ?>
					<th>Appartment Comman Facilities:</th>
						<td><?php while($rowsappart=$qryappart->fetch_assoc()){ ?><?=$rowsappart['name'];?>,&nbsp<?php } ?></td>
				</tr><?php } ?>
				<?php if(isset($rows['roomno'])){ ?><tr>
					<th>Room no:</th>
					<td><?=$rows['roomno'];?></td>
				</tr><?php } ?>
				<?php if(isset($rows['room_type'])){ ?><tr>
					<th>Room Type:</th>
					<td><?=$rows['room_type'];?></td>
				</tr><?php } ?>
			</table>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12">
		<hr><h5>Room Facilities:-</h5><hr>
			<?php $qrybed=$conn->query("select * from tbl_bed_room_details where room_id=".$rows['room_id']);
			if(mysqli_num_rows($qrybed)>=1)
			{
				?><div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Bed Room:-</b></div>
				<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?php
				$count=1;
				while($rowsbed=$qrybed->fetch_assoc()){
					echo $rowsbed['name'];
					if($count%4==0)
					{
						echo '<br>';
					}
					else
					{
						echo ',';
					}
					$count++;

				}
				?></div><?php
			}
			 ?>
			<?php $qrybed=$conn->query("select * from tbl_common_area_detail where room_id=".$rows['room_id']);
			if(mysqli_num_rows($qrybed)>=1)
			{
				?><div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Common Room:-</b></div>
				<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?php
				$count=1;
				while($rowsbed=$qrybed->fetch_assoc()){
					echo $rowsbed['name'];
					if($count%4==0)
					{
						echo '<br>';
					}
					else
					{
						echo ',';
					}
					$count++;

				}
				?></div><?php
			}
			 ?>
			<?php $qrybed=$conn->query("select * from tbl_kitchen_details where room_id=".$rows['room_id']);
			if(mysqli_num_rows($qrybed)>=1)
			{
				?><div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Kittchen Room:-</b></div>
				<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?php
				$count=1;
				while($rowsbed=$qrybed->fetch_assoc()){
					echo $rowsbed['name'];
					if($count%4==0)
					{
						echo '<br>';
					}
					else
					{
						echo ',';
					}
					$count++;

				}
				?></div><?php
			}
			 ?>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12">
			<hr><h5>Located At:-</h5><hr>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Address:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['address'];?></div>

			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Near:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['near'];?></div>
			
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Pin/Zip Code:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['pincode'];?></div>
			
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>City:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['city'];?></div>
			
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>District:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['district'];?></div>
			
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>State:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['state'];?></div>
			
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><b>Country:-</b></div>
			<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:12px;padding: 0px;"><?=$rows['country'];?></div>

		</div>

	</div>
</div>
<script>
function myFunction(imgs) {
  var expandImg = document.getElementById("expandedImg");
  var imgText = document.getElementById("imgtext");
  expandImg.src = imgs.src;
  imgText.innerHTML = imgs.alt;
  expandImg.parentElement.style.display = "block";
}
</script>

<?php
include 'footer.html';
	?>