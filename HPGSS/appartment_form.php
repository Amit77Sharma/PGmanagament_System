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
if(isset($_GET['id']))
{
	$appartment_id=$_GET['id'];
	$sqlget="select * from tbl_appartment_details where id=$appartment_id";
	$rowsget=$conn->query($sqlget)->fetch_assoc();
}
if(isset($_POST["submit"]))
{
	$ownerid=$rowlog['id'];
	$appartment=$_POST["appartment"];
	$address=$_POST["address"];
	$near=$_POST["near"];
	$country=$_POST["country"];
	$pin=$_POST["pin"];
	$state=$_POST["state"];
	$district=$_POST["district"];
	$city=$_POST["city"];
	if(isset($_POST["facility"])){$facility=$_POST["facility"];}
	if(($_POST['submit']=='add'))
	{
		$sql="insert into tbl_appartment_details(id, ownerid, name, address, near, pincode, country, state, district, city, status)values(0,$ownerid,'$appartment','$address','$near','$pin','$country','$state','$district','$city',0)";
		$qry=$conn->query($sql);
		if($qry==true)
		{

			$last_id=$conn->insert_id;

			if(isset($_POST["facility"]))
			{
				foreach ($facility as $value) {
				
				$sqlbed="insert into tbl_appartment_facility(id,appartment_id,name,status)values(0,$last_id,'$value',0)";
				$qrybed=$conn->query($sqlbed);
				}
			}
			header('Location:appartmentlist.php');
		}
		else
		{
			echo 'somthing went wrong';
		}
	}
	else if($_POST['submit']=='update')
	{
		$sql="update tbl_appartment_details set name='$appartment', address='$address', near='$near', pincode='$pin', country='$country', state='$state', district='$district', city='$city' where id=".$_GET['id'];
		$qry=$conn->query($sql);
		if($qry==true)
		{
			$arr=["Water Purifier","Wifi","Washing Machine","Power Backup","Water Supply","Modern Furnish","","House Keeping"];
			if(isset($_POST["facility"]))
			{
				foreach ($facility as $value) {
					$key=array_search($value, $arr);
					unset($arr[$key]);
					$sqlcheck="select * from tbl_appartment_facility where name='$value' and appartment_id=".$_GET['id'];
					if(mysqli_num_rows($conn->query($sqlcheck))<=0)
					{
						$sqlbed="insert into tbl_appartment_facility(id,appartment_id,name,status)values(0,".$_GET['id'].",'$value',0)";
						$qrybed=$conn->query($sqlbed);
					}
				}
				if($arr!=0)
				{
					foreach($arr as $value1)
					{
						$sqlcheck="select * from tbl_appartment_facility where name='$value1' and appartment_id=".$_GET['id'];
						if(mysqli_num_rows($conn->query($sqlcheck))>=1)
						{
							$sqldelete="delete from tbl_appartment_facility where name='$value1' and appartment_id=".$_GET['id'];
							$qrydelete=$conn->query($sqldelete);
						}
					}
				}
			}
			else
			{
				$sqldelete="delete from tbl_appartment_facility where appartment_id=".$_GET['id'];
				$qrydelete=$conn->query($sqldelete);
			}
		}
		else
		{
			echo 'somthing went wrong';
		}
		header('Location:appartmentlist.php');
	}
	else
	{
		echo "Invalid Button";
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
			<input class="form-control" value="<?php if(isset($rowsget['name'])){ echo $rowsget['name']; } ?>" type="text" name="appartment" placeholder="Appartment Name">
		</td>
	</tr>
	<tr>
		<th>
			<label>Address:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<textarea class="form-control" type="text" name="address" placeholder="Address"><?php if(isset($rowsget['address'])){ echo $rowsget['address']; } ?></textarea>
		</td>
	</tr>
	<tr>
		<th>
			<label>Near:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input class="form-control" value="<?php if(isset($rowsget['near'])){ echo $rowsget['near']; } ?>" type="text" name="near" placeholder="Bus Stand / Railway station / School / College etc. Name">
		</td>
	</tr>
	<tr>
		<th>
			<label>Pin/Zip Code:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input class="form-control allow_numeric" maxlength="6" value="<?php if(isset($rowsget['pincode'])){ echo $rowsget['pincode']; } ?>" type="text" name="pin" placeholder="Pin Code">
		</td>
	</tr>
	<tr>
		<th>
			<label>Country:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input class="form-control" value="<?php if(isset($rowsget['country'])){ echo $rowsget['country']; } ?>" type="text" name="country" placeholder="Enter Country">
		</td>
	</tr>
	<tr>
		<th>
			<label>State/Union Teritory:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input list="states" class="form-control" value="<?php if(isset($rowsget['state'])){ echo $rowsget['state']; } ?>" id="state" name="state">
			  <datalist id="states">
				<?php 
				$sqlstate="select distinct(state) as state from tbl_pincode_mstr order by state asc";
				$qrystate=$conn->query($sqlstate);
				while($rowsstate=$qrystate->fetch_assoc())
				{
				 ?>
				<option value="<?=$rowsstate['state'];?>">
			<?php } ?>
			  </datalist>
		</td>
	</tr>
	<tr>
		<th>
			<label>District:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input list="districts" class="form-control" value="<?php if(isset($rowsget['district'])){ echo $rowsget['district']; } ?>" id="district" name="district">
			  <datalist id="districts">
			  	<?php 
				$sqldistrict="select distinct(district) as district from tbl_pincode_mstr order by district asc";
				$qrydistrict=$rowsdistrict=$conn->query($sqldistrict);
				while($rowsdistrict=$qrydistrict->fetch_assoc())
				{
				 ?>
			    <option value="<?=$rowsdistrict['district'];?>">
			  	<?php } ?>
			  </datalist>
		</td>
	</tr>
	<tr>
		<th>
			<label>City/Village/Town:- </label><label style="color: red;float: right;">*</label>
		</th>
		<td>
			<input class="form-control" value="<?php if(isset($rowsget['city'])){ echo $rowsget['city']; } ?>" type="text" id="city" name="city" placeholder="City/Town/Village">
		</td>
	</tr>
	<tr>
		<th>
			<label>Facilities :</label>
		</th>
		<?php 
		$wp=false; $w=false; $wm=false; $pb=false; $ws=false; $mf=false; $g=false; $hk=false;
		?>
		<td>
			<table width="100%">
			<?php if(isset($rowsget['id']))
				{
					$sqlfacility="select * from tbl_appartment_facility where appartment_id=".$rowsget['id'];
					$qryfacility=$conn->query($sqlfacility);
				} ?>
				<tr>
					<?php if(isset($rowsget['id'])){ while($rowsfacility=$qryfacility->fetch_assoc()){ ?>
					<?php if($rowsfacility['name']=='Water Purifier'){ $wp=true; ?><td><div class="checkbox"><label><input checked class="checkbox" name="facility[]" type="checkbox"  value="Water Purifier">Water Purifier</label></div></td><?php } ?>
					<?php if($rowsfacility['name']=='Wifi'){ $w=true; ?><td><div class="checkbox"><label><input class="checkbox" checked="" name="facility[]" type="checkbox" value="Wifi">Wifi</label></div></td><?php } ?>
					<?php if($rowsfacility['name']=='Washing Machine'){ $wm=true; ?><td><div class="checkbox"><label><input checked class="checkbox" name="facility[]" type="checkbox" value="Washing Machine">Washing Machine</label></div></td><?php } ?>
					<?php if($rowsfacility['name']=='Power Backup'){ $pb=true; ?><td><div class="checkbox"><label><input class="checkbox" checked="" name="facility[]" type="checkbox" value="Power Backup">Power Backup</label></div></td><?php } } } ?>

					<?php if($wp==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox"  value="Water Purifier">Water Purifier</label></div></td><?php } ?>
					<?php if($w==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="Wifi">Wifi</label></div></td><?php } ?>
					<?php if($wm==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="Washing Machine">Washing Machine</label></div></td><?php } ?>
					<?php if($pb==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="Power Backup">Power Backup</label></div></td><?php } ?>
				</tr>
				<?php if(isset($rowsget['id']))
				{
					$sqlfacility="select * from tbl_appartment_facility where appartment_id=".$rowsget['id'];
					$qryfacility=$conn->query($sqlfacility);
				} ?>
				<tr>
					<?php if(isset($rowsget['id'])){ while($rowsfacility=$qryfacility->fetch_assoc()){ ?>
					<?php if($rowsfacility['name']=='Water Supply'){ $ws=true; ?><td><div class="checkbox"><label><input class="checkbox" checked="" name="facility[]" type="checkbox" value="Water Supply">Water Supply</label></div></td><?php } ?>
					<?php if($rowsfacility['name']=='Modern Furnish'){ $mf=true; ?><td><div class="checkbox"><label><input class="checkbox" checked="" name="facility[]" type="checkbox" value="Modern Furnish">Modern Furnish</label></div></td><?php } ?>
					<?php if($rowsfacility['name']=='Gym'){ $g=true; ?><td><div class="checkbox"><label><input class="checkbox" checked="" name="facility[]" type="checkbox" value="Gym">Gym</label></div></td><?php } ?>
					<?php if($rowsfacility['name']=='House Keeping'){ $hk=true; ?><td><div class="checkbox"><label><input class="checkbox" checked="" name="facility[]" type="checkbox" value="House Keeping">House Keeping</label></div></td><?php } } } ?>

					<?php if($ws==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="Water Supply">Water Supply</label></div></td><?php } ?>
					<?php if($mf==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="Modern Furnish">Modern Furnish</label></div></td><?php } ?>
					<?php if($g==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="Gym">Gym</label></div></td><?php } ?>
					<?php if($hk==false){ ?><td><div class="checkbox"><label><input class="checkbox" name="facility[]" type="checkbox" value="House Keeping">House Keeping</label></div></td><?php } ?>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table style="float:right; width:200px;"><tr>
<td><a class="btn btn-warning large" href="appartmentlist.php" >Back</a> </td>


<td><input class="btn btn-success" type="submit" value="<?php if(isset($_GET['id'])){ echo 'update'; }else{ echo 'add'; } ?>" name="submit"  /></td> 
</tr> </table>
</form> 
</div>
</div>

<?php
include("footer.html")
?> 

</body>  
</html>  