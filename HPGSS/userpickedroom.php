<?php
include 'header.php';
if($rowlog['typeid']!=3)
{
	header('Location:index.php');
}
if(isset($_GET['id']))
{
	$roomid=$_GET['id'];
	$sql="delete from tbl_booking_list where id=$roomid";
	$qry=$conn->query($sql);
	if($qry==true)
	{
		header('Location:choosenroomlist.php');
	}
}

?>
<div class="form-group" style="padding-top:20px; min-height: 500px;">
	<a href="index.php" style="margin-left: 15px;"><button class="btn btn-warning large">Watch More Rooms</button></a>
	<?="<br/><br/>&nbsp&nbsp&nbspClick On the Room Number of Room To Add Images of that Room ....";?>
	<table class="table table-form" style="margin-top: 20px;">
		<tr>
		<th>serial no.</th>
		<th>Profile</th>
		<th>Room no.</th>
		<th>Room type</th>
		<th>Bed room details</th>
		<th>Comman area details</th>
		<th>Kitchen area details</th>
		<th>Details</th>
		<th>Rate</th>
		<th>Basis</th>
		<th>Action</th>
		<th>status</th>
	</tr>
	<?php
	$sl=1;
	$ownerid=$rowlog['id'];
	$sql="select bl.id as booking_list_id, rd.id as room_id,roomno,name,room_details,price,basis,rd.status as room_status, booking_status from tbl_room_details as rd join tbl_room_type as rt on rd.type_id=rt.id join tbl_booking_list as bl on bl.room_id=rd.id where bl.login_id=".$rowlog['id'];
	$qry=$conn->query($sql);
	while($row=$qry->fetch_array())
	{
	?>
	<tr>
		<td>
			<?=$sl++;?>
				
		</td>
		<?php $rowimg=$conn->query("select * from tbl_room_image where room_id=".$row['room_id'])->fetch_assoc(); ?>
		<td>
			<img src="<?=$rowimg['loc'].'/'.$rowimg['name'];?>" style="max-width: 120px;" >
		</td>
		<td>
			<a href="roomviewdetails.php?id=<?=$row['room_id'];?>"><?=$row['roomno'];?></a>
		</td>
		<td><?=$row['name'];?></td>
		<?php 
			$room_id=$row['room_id'];
			$sqlbed="select * from tbl_bed_room_details where room_id=$room_id";
			$qrybed=$conn->query($sqlbed);
		?>
		<td>
			<?php
			while($rowbed=$qrybed->fetch_array())
			{
				echo $rowbed['name'].', ';
			}
			?>
		</td>
		<?php 
			$room_id=$row['room_id'];
			$sqlbed="select * from tbl_common_area_detail where room_id=$room_id";
			$qrybed=$conn->query($sqlbed);
		?>
		<td>
			<?php
			while($rowbed=$qrybed->fetch_array())
			{
				echo $rowbed['name'].', ';
			}
			?>
		</td>
		<?php 
			$room_id=$row['room_id'];
			$sqlbed="select * from tbl_kitchen_details where room_id=$room_id";
			$qrybed=$conn->query($sqlbed);
		?>
		<td>
			<?php
			while($rowbed=$qrybed->fetch_array())
			{
				echo $rowbed['name'].', ';
			}
			?>
		</td>
		<td><?=$row['room_details'];?></td>
		<td style="font-size:12px;"><i class="fa fa-rupee" style="font-size:12px"></i><?=$row['price'];?></td>
		<td><?=$row['basis'];?></td>
		<td><a href="payment.php?room_id=<?$row['room_id'];?>" class="btn btn-primary">Pay</a>&nbsp <a class="danger" style="color: red;" href="?id=<?=$row['booking_list_id'];?>"><i class="glyphicon glyphicon-trash" style="font-size:12px"></i></a></td>
		<td><?php if($row["booking_status"]==1){ ?><button class="btn large btn-warning">Out of Stock</button><?php }elseif ($row["booking_status"]==0) {?><button class="btn large btn-success">Available</button><?php } ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
</div>

<?php
include("footer.html")
?> 

</body>
</html>