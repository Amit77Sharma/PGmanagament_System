<?php
include 'header.php';
if($rowlog['typeid']!=4)
{
header('Location:index.php');
}
if(isset($_GET['id']))
{
$roomid=$_GET['id'];
$sql="delete from tbl_appartment_details where id=$roomid";
$qry=$conn->query($sql);
if($qry==true)
{
	$sql="delete from tbl_bed_appartment_facility where appartment_id=$roomid";
	$qry=$conn->query($sql);
	header('Location:appartmentlist.php');
}
}
?>
<div class="form-group" style="padding-top:20px; min-height: 500px;">
	<a href="appartment_form.php" style="margin-left: 15px;"><button class="btn btn-warning large">Add Appartment</button></a>
	<?="<br/><br/>&nbsp&nbsp&nbspClick On the Name of Appartment To Add Rooms of that Appartment ....";?>
	<table class="table table-form" style="margin-top: 20px;">
		<tr>
		<th>serial no.</th>
		<th>Apartment name</th>
		<th>Address</th>
		<th>Near</th>
		<th>Facilities</th>
		<th>Pincode</th>
		<th>City/Town/Village</th>
		<th>District</th>
		<th>State</th>
		<th>Country</th>
		<th>Action</th>
		<th>status</th>
	</tr>
	<?php
	$sl=1;
	$ownerid=$rowlog['id'];
	$sql="select * from tbl_appartment_details where ownerid=$ownerid";
	$qry=$conn->query($sql);
	while($row=$qry->fetch_array())
	{
	?>
	<tr>
		<td>
			<?=$sl++;?>
				
		</td>
		<td>
			<a href="roomlist.php?appart_id=<?=$row['id'];?>"><?=$row['name'];?></a>
		</td>
		<td>
			<?=$row['address'];?>
		</td>
		<td><?=$row['near'];?></td>
		<?php 
			$room_id=$row['id'];
			$sqlbed="select * from tbl_appartment_facility where appartment_id=$room_id";
			$qrybed=$conn->query($sqlbed);
		?>
		<td>
			<?php
			while($rowbed=$qrybed->fetch_array())
			{
				echo $rowbed['name'].',';
			}
			?>
		</td>
		<td>
			<?=$row['pincode'];?>
		</td>
		<td>
			<?=$row['city'];?>
		</td>
		<td>
			<?=$row['district'];?>
		</td>
		<td>
			<?=$row['state'];?>
		</td>
		<td>
			<?=$row['country'];?>
		</td>
		<td><a class="danger" style="color: red;" href="appartment_form.php?id=<?=$row['id'];?>">Edit<i class="glyphicon glyphicon-edit"></i></a>&nbsp<a class="danger" style="color: red;" href="?id=<?=$row['id'];?>">Delete<i class="glyphicon glyphicon-trash"></i></a></td>
		<td><?php if($row["status"]==0){ ?><button class="btn large btn-warning">Pending</button><?php }elseif ($row["status"]==1) {?><button class="btn large btn-success">approved</button><?php } ?>
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