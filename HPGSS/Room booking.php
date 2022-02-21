<?php
include 'header.php';
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
if($rowlog['typeid']!=4)
{
header('Location:index.php');
}
if (isset($_GET['appart_id'])) {
	if (mysqli_num_rows($qryappart=$conn->query("select * from tbl_appartment_details where id=".$_GET['appart_id']." and ownerid=".$rowlog['id']))<=0) {
		header('Location:appartmentlist.php');
	}
	$rowsappart=$qryappart->fetch_assoc();
}
if(isset($_POST["submit"]))
{
	$type=$_POST["type"];
	$details=$_POST['roomdetails'];
	$price=$_POST['price'];
	$basis=$_POST['basis'];
	if(isset($_POST["bed"])){$bed=$_POST["bed"];}
	if(isset($_POST["kittchen"])){$Kittchen=$_POST["kittchen"];}
	if(isset($_POST["comman"])){$comman=$_POST["comman"];}
	$roomno=$_POST["roomnumber"];
//echo "select * from tbl_room_details where roomno=$roomno and appartment_id=".$_GET['appart_id'];
	if(mysqli_num_rows($conn->query("select * from tbl_room_details where roomno=$roomno and appartment_id=".$_GET['appart_id']))<=0)
	{
		$sql="insert into tbl_room_details(id,appartment_id,roomno,type_id,room_details,price,basis,status)values(0,".$_GET['appart_id'].",'$roomno','$type','$details','$price','$basis',0)";
		$qry=$conn->query($sql);
		if($qry==true)
		{

			$last_id=$conn->insert_id;

			if(isset($_POST["bed"]))
			{
				foreach ($bed as $value) {
				
				$sqlbed="insert into tbl_bed_room_details(id,room_id,name,satus)values(0,$last_id,'$value',0)";
				$qrybed=$conn->query($sqlbed);
				}
			}
			if(isset($_POST["comman"])){
				foreach ($comman as $value) {
				
				$sqlcomman="insert into tbl_common_area_detail(id,room_id,name,status)values(0,$last_id,'$value',0)";
				$qrycomman=$conn->query($sqlcomman);
				}
			}
			if(isset($_POST["kittchen"])){
				foreach ($Kittchen as $value) {
				
				$sqlkittchen="insert into tbl_kitchen_details(id,room_id,name,staus)values(0,$last_id,'$value',0)";
				$qrykittchen=$conn->query($sqlkittchen);
				}
			header('Location:roomlist.php?appart_id='.$_GET['appart_id']);
			}
		}
		else
		{
			echo 'somthing went wrong';
			header('Location:Room bokking.php?appart_id='.$_GET['appart_id']);
		}
	}
	else
	{
		?><script type="text/javascript">alert('Room Number <?=$roonno?> already exists !!!');</script><?php
		header('Location:roomlist.php?appart_id='.$_GET['appart_id']);
	}
}
?>  
<div class="center" style="margin-top:20%;">
<div class="container form-group" style="box-shadow: 5px 10px 10px 5px gray; padding: 10px; background-color:#D3D3D3">
<div class="top">
	<h3>Add Room</h3>
</div>
<form method="post">  
<table class="table table-form">
	<tr>
		<th>
			<label>Apartment Name:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input class="form-control" value="<?=$rowsappart['name'];?>" type="text" name="appartment" placeholder="Appartment Name" readonly="" required>
		</td>
	</tr>
	<tr>
		<th>
			<label>Room No.:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input class="form-control allow_numeric" type="text" name="roomnumber" placeholder="Room Number" required="">
		</td>
	</tr>
		<tr>
		<th>
			<label> Room type </label><label style="color: red;float: right;">*</label>
		</th>
		<td>       
			<?php		
			$sql="select * from tbl_room_type";
			$qry =$conn->query($sql);
			?>
			<select name="type" class="form-control">
			<?php
			while($row=$qry->fetch_array())
			{
			?>
			<option value="<?=$row['id'];?>"><?=$row["name"];?></option>
			<?php
			}									
			?>

			</select>
		</td>
	</tr>
	<tr>
		<th>
			<label>Room Details.:- </label>
		</th>
		<td>
			<textarea class="form-control" type="text" name="roomdetails" placeholder="Room Details"></textarea>
		</td>
	</tr>
	<tr>
		<th> 
			<label>   Bed room details :  </label> 
		</th>
		<td>
			<table width="100%">
			<tr>
			<td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Bed">Bed</label></div>  
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Pillow & cover">Pillow & cover </label></div>
			</td><td> 
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox"type="checkbox" value="Tv">Tv  </label></div>
			</td></tr><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Ac">Ac  </label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Almirah">Almirah  </label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="chair">chair</label></div>
			</td></tr><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Light">Light</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="fan" >Fan</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Table">Table</label></div>
			</td></tr><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="curttain">curttain</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="mattress">mattress</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="cable connection">cable connection</label></div>
			</td></tr><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="bed[]" type="checkbox" value="Geyser">Geyser</label></div>
			</td></tr></table>
		</td>
	</tr>
	<tr>
		<th>
			<label>Comman area :</label>
		</th>
		<td>
			<table width="100%"><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox"  value="Tv">Tv</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" vlue="Ac/Cooler">Ac/Cooler</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" value="Washing machine">Washing machine</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" value="Power backup">Power backup</label></div>
			</td></tr><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" value="Dinning table">Dinning table</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" value="Modern furnish">Modern furnish</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" value="Refrigerator">Refrigertor</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="comman[]" type="checkbox" value="House keeping">House keeping</label></div>
			</td></tr></table>
		</td>
	</tr>
	<tr>
		<th> 
			<label>Kitchen area:</label>
		</th>
		<td>
			<table width="100%"><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="kittchen[]" type="checkbox" value="RO water">RO water</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="kittchen[]" type="checkbox" value="Gas cylinder">Gas cylinder</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="kittchen[]" type="checkbox" value="Stove">Stove
			</td></tr><tr><td>
			<div class="checkbox"><label><input class="checkbox" name="kittchen[]" type="checkbox" value="Kitchen set">Kitchen set</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="kittchen[]" type="checkbox" value="Cutlery">Cutlery</label></div>
			</td><td>
			<div class="checkbox"><label><input class="checkbox" name="kittchen[]" type="checkbox" value="Utensils">Utensils</label></div>
			</td></tr></table>
		</td>  
	</tr>
	<tr>
		<th><label>Rate:</label><label style="color: red;float: right;">*</label></th>
		<td>
			<div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px;">
				<div class="col-sm-9 col-md-9 col-lg-9" style="padding:0px;">
					<input style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;" type="text" class="form-control" name="price" placeholder="Price" required>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3" style="padding:0px; margin-left: -2px;">
					<select class="form-control" style="background-color: #ececec; border-left: 0px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;" name="basis">
						<option value="">--Select--</option>
						<option value="Daily">Daily</option>
						<option selected value="Monthly">Monthly</option>
						<option value="Yearly">Yearly</option>
					</select>
				</div>
			</div>
		</td>
	</tr>
</table>
<table style="float:right; width:200px;"><tr>
<td><a class="btn btn-warning large" href="roomlist.php?appart_id=<?=$_GET['appart_id'];?>" >Back</a></td>


<td><input class="btn btn-success" type="submit" value="Submit" name="submit"  /></td> 
</tr> </table>
</form> 
</div>
</div>

<?php
include("footer.html")
?> 

</body>  
</html>  