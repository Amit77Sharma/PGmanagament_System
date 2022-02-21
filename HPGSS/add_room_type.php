<?php
include "connect.php";
if(isset($_POST['submit']))
{
	$type=$_POST['room_type'];
	$sql="insert into tbl_room_type(id,name,status)values(0,'$type',0)";
	$qry=$conn->query($sql);
	if($qry==true)
	{
		echo "data inserted successefully";
	}
	else
		{echo "somethig wrong";}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>add room type</title>
</head>
<body>
<div class="container">
	<div class="heading">
		<h3>Add Room Type</h3>
	</div>
	<form method="post">
		<table>
			<tr>
				<th>
					<label>   
						Bed room details :  
					</label>
				</th>
			</tr>
			<tr>
				<td>
					<input type="text" name="room_type">
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" name="submit" value="add">
						Add
					</button>
					<button>
						 <a href="address"> Cancel</a>
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>