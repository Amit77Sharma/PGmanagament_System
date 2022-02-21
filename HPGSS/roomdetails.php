<?php
if(!isset($_GET['id']) or $_GET['id']=="")
{
	header("Location:roomlist.php");
}
include 'header.php';
if($rowlog['typeid']!=4)
{
header('Location:index.php');
}
$room_id=$_GET['id'];
if(isset($_GET['img_id']))
{
	$img_id=$_GET['img_id'];
	$sqldeleteimg="select * from tbl_room_image where id=$img_id";
	$qrydeleteimg=$conn->query($sqldeleteimg);
	$rowdeleteimg=$qrydeleteimg->fetch_assoc();
	unlink( $rowdeleteimg['loc'] .'/'. $rowdeleteimg['name']);
	$sqldelete="delete from tbl_room_image where id=$img_id";
	$qrydelete=$conn->query($sqldelete);
	header("Location:roomdetails.php?id=$room_id&appart_id=".$_GET['appart_id']);
}
$sql="select rd.id as room_id,ad.name as appart_name,address,near,city,district,state,country,roomno,rt.name as type_name,rd.status as room_status from tbl_room_details as rd join tbl_room_type as rt on rd.type_id=rt.id join tbl_appartment_details as ad on rd.appartment_id=ad.id where rd.id=$room_id";
$qry=$conn->query($sql);
if($roomcount=mysqli_num_rows($qry)>=1)
{
$row=$qry->fetch_array();
if(isset($_POST["submit"])) {

	$imgid=$_POST['imgid'];
	$path = "uploads/";
	$room_id=$row['room_id'];
	$target_dir = $path.$row['appartment'].$room_id;
	if (!is_dir($target_dir)) {
	    mkdir($target_dir, 0777, true);
	}
	$basename=basename($_FILES["image"]["name"]);
	$target_file = $target_dir .'/'. $basename;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	  $check = getimagesize($_FILES["image"]["tmp_name"]);
	  if($check !== false) {
	    $uploadOk = 1;
	  } else {
	    $uploadOk = 0;
	  }

	// Check if file already exists
	if (file_exists($target_file)) {
	  ?><script type="text/javascript">alert("Sorry, file already exists.");</script><?php
	  $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["image"]["size"] > 500000) {
	  ?><script type="text/javascript">alert("Sorry, your file is too large.");</script><?php
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  ?><script type="text/javascript">alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script><?php
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  ?><script type="text/javascript">alert("Sorry, your file was not uploaded.");</script><?php
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	  	if($imgid=="")
	  	{
	    $sqlupload="INSERT INTO tbl_room_image (id,room_id,name,loc,status) VALUES(0,$room_id,'$basename','$target_dir',0)";
	    $qryupload=$conn->query($sqlupload);
	    if($qryupload==true)
	    {
	    	$sqlupdate1="update tbl_room_details set status=1 where id=$room_id";
	    	$qryupdate1=$conn->query($sqlupdate1);
	    }
	  	}else{
	  		$sqlchangeimg="select name from tbl_room_image where id=$imgid";
	  		$qrychangeimg=$conn->query($sqlchangeimg);
	  		$rowchangeimg=$qrychangeimg->fetch_assoc();
	  		unlink( $target_dir .'/'. $rowchangeimg['name']);
	  		$sqlupdate="update tbl_room_image set name='$basename' where id=$imgid";
	  		$qryupdate=$conn->query($sqlupdate);
	  	}
	    header("Location:roomdetails.php?id=$room_id&appart_id=".$_GET['appart_id']);
	  } else {
	    ?><script type="text/javascript">alert("Sorry, there was an error uploading your file.");</script><?php
	  }
	}
} }
?>
<div class="container form-group" style="box-shadow: 5px 5px 10px 2px gray; margin-top:15%;">
	<div class="top col-lg-12"><div class="col-sm-10 col-md-10 col-lg-10"><h3>Room Details:- </h3></div><div class="col-sm-2 col-md-2 col-lg-2"><a class="btn btn-warning large" style="float:right;margin-top: 10px;" href="roomlist.php?appart_id=<?=$_GET['appart_id'];?>" >Back</a></div></div>
	<div class="col-sm-12 col-lg-3">
	<table class="table table-responsive" style="border:none;">
		<tr>
			<th style="border: none;"><label class="">Appartment:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['appart_name']; } ?></span></td>
		</tr>
		<tr>
			<th style="border: none;"><label class="">Address:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['address']; } ?></span></td>
		</tr>
		<tr>
			<th style="border: none;"><label class="">Near:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['near']; } ?></span></td>
		</tr>
		<tr>
			<th style="border: none;"><label class="">City:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['city']; } ?></span></td>
		</tr>
		<tr>
			<th style="border: none;"><label class="">District:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['district']; } ?></span></td>
		</tr>
		<tr>
			<th style="border: none;"><label class="">Room no:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['roomno']; } ?></span></td>
		</tr>
		<tr>
			<th style="border: none;"><label class="">Room type:- </label></th><td style="border: none;"><span class="control-label col-sm-2 col-lg-12"><?php if($roomcount>=1){ echo $row['type_name']; } ?></span></td>
		</tr>
	</table>
	</div>
	<div class="col-sm-12 col-lg-3">
		<div class="top col-lg-12"><h5> <b>Bed room Details:</b></h5></div>
		<div class="col-lg-12">
		<?php 
		$count=1;
		$sqlbed="select * from tbl_bed_room_details where room_id=$room_id";
		$query=$conn->query($sqlbed);
		while ($rowbed=$query->fetch_array())
		{
			echo $rowbed['name'].'<br>';
		} ?>
		</div>
	</div>
	<div class="col-sm-12 col-lg-3">
	<div class="top col-lg-12"><h5> <b> Common area Details:</b></h5></div>
		<div class="col-lg-12">
		<?php 
		$count=1;
		$sqlbed="select * from tbl_common_area_detail where room_id=$room_id";
		$query=$conn->query($sqlbed);
		while ($rowbed=$query->fetch_array())
		{
			echo $rowbed['name'].'<br>';
		} ?>
		</div>	
	</div>
	<div class="col-sm-12 col-lg-3">
	<div class="top col-lg-12"><h5> <b> Kittchen area Details:</b></h5></div>
		<div class="col-lg-12">
		<?php 
		$count=1;
		$sqlbed="select * from tbl_kitchen_details where room_id=$room_id";
		$query=$conn->query($sqlbed);
		while ($rowbed=$query->fetch_array())
		{
			echo $rowbed['name'].'<br>';
		} ?>
		</div>	
	</div>
</div>
<div class="container form-group" style="min-height: 300px;">
<?php	$sqlimg="select * from tbl_room_image where room_id=$room_id";
			$qryimg=$conn->query($sqlimg);
			if($qryimg==true){
			while($rowimg=$qryimg->fetch_assoc()){
?>
	<div style="width: 110px;height: 140px;float: left;"><div class="containerroom"><img class="imageroom " src="<?=$rowimg['loc'].'/'.$rowimg['name'];?>"><div class="middleroom"><div class="textroom"><button class="btn btn-warning" onclick="imgid(this)" data-toggle="modal" data-target="#myModal1" value="<?=$rowimg['id'];?>">Change</button>&nbsp&nbsp&nbsp&nbsp<a style="color:red;" href="?id=<?=$room_id;?>&img_id=<?=$rowimg['id'];?>&appart_id=<?=$_GET['appart_id'];?>"><button class="btn btn-danger">Delete</button></a></div></div></div></div><?php }} ?><img src="album/add.jpg" data-toggle="modal" data-target="#myModal1" style="max-width: 80px; max-height: 80px;">
</div>
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Room Image</h4>
      </div>
      <div class="modal-body">
      	<form method="post" enctype="multipart/form-data">
        	<input class="form-group" type="file" accept="image/png, image/gif, image/jpeg" name="image">
        	<input class="hidden" id="imgtagid" type="text" name="imgid" hidden="" value="">
        	<input class="btn btn-success" type="submit" name="submit" value="Upload" style="margin-top: 20px;">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php
include("footer.html")
?> 

</body>
</htm>
<script type="text/javascript">
	function imgid(val)
	{
		var abc=val.value;
		document.getElementById('imgtagid').value = abc;
	}
</script>