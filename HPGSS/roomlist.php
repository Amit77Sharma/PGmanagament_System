<?php
include 'header.php';
if($rowlog['typeid']!=4)
{
	header('Location:index.php');
}
if (isset($_GET['appart_id'])) {
	if (mysqli_num_rows($conn->query("select * from tbl_appartment_details where id=".$_GET['appart_id']." and ownerid=".$rowlog['id']))<=0) {
		header('Location:appartmentlist.php');
	}
}
if(isset($_GET['id']))
{
$roomid=$_GET['id'];
$sql="delete from tbl_room_details where id=$roomid";
$qry=$conn->query($sql);
if($qry==true)
{
	$sql="delete from tbl_bed_room_details where room_id=$roomid";
	$qry=$conn->query($sql);
	$sql="delete from tbl_common_area_detail where room_id=$roomid";
	$qry=$conn->query($sql);
	$sql="delete from tbl_kitchen_details where room_id=$roomid";
	$qry=$conn->query($sql);
	header('Location:roomlist.php?appart_id='.$_GET['appat_id']);
}
}

?>
<div class="form-group" style="padding-top:20px; min-height: 500px;">
	<a href="Room booking.php?appart_id=<?=$_GET['appart_id'];?>" style="margin-left: 15px;"><button class="btn btn-warning large">Add Room</button></a>
	<?="<br/><br/>&nbsp&nbsp&nbspClick On the Room Number of Room To Add Images of that Room ....";?>
	<table class="table table-form" style="margin-top: 20px;">
		<tr>
		<th>serial no.</th>
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
	$sql="select rd.id as room_id,roomno,name,room_details,price,basis,rd.status as room_status from tbl_room_details as rd join tbl_room_type as rt on rd.type_id=rt.id where rd.appartment_id=".$_GET['appart_id'];
	$qry=$conn->query($sql);
	while($row=$qry->fetch_array())
	{
	?>
	<tr>
		<td>
			<?=$sl++;?>
				
		</td>
		<td>
			<a href="roomdetails.php?id=<?=$row['room_id'];?>&appart_id=<?=$_GET['appart_id'];?>"><?=$row['roomno'];?></a>
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
		<td><?=$row['price'];?></td>
		<td><?=$row['basis'];?></td>
		<td><a href=""></a><a class="danger" style="color: red;" href="?id=<?=$row['room_id'];?>"><i class="glyphicon glyphicon-trash" style="font-size:12px"></i>Delete</a></td>
		<td><?php if($row["room_status"]==0){ ?><button class="btn large btn-warning">Pending</button><?php }elseif ($row["room_status"]==1) {?><button class="btn large btn-success">approved</button><?php } ?>
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