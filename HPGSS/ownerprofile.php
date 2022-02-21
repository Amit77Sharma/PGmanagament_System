<?php
include 'header.php';
if(!isset($_SESSION['username']))
{
  header("Location:index.php");
}
else
{
  $loginid=$rowlog['id'];
  $sqlowner="select * from tbl_owner_details where login_id=$loginid";
  $qryowner=$conn->query($sqlowner);
  $countowner=mysqli_num_rows($qryowner);
  if($countowner>=1)                             
  {
    $rowowner=$qryowner->fetch_assoc();
    $usergender=$rowowner['gender'];
  }
  $sqluser="select * from tbl_user_details where login_id=$loginid";
  $qryuser=$conn->query($sqluser);
  $countuser=mysqli_num_rows($qryuser);
  if($countuser>=1)                             
  {
    $rowowner=$qryuser->fetch_assoc();
    $usergender=$rowlog['gender'];
  }
  $sqlimg="select * from ownerprofile_uploading where ownerid=$loginid";
  $qryimg=$conn->query($sqlimg);
  $countimg=mysqli_num_rows($qryimg);
  if($countimg>=1)                             
  {
    $rowimg=$qryimg->fetch_assoc();
  }
}
?>

<div class="container1">
<div class="basic col-sm-12 col-md-12 col-lg-12" style="background-color:white; box-shadow:5px 10px 10px 5px grey; padding: 10px; margin-bottom: 25px;">
  <div class="col-sm-12 col-md-6 col-lg-2" style="padding: 5px; text-align: center;">
  <div class="image" style="border-radius: 50%; ">
<?php if($countimg>=1){ ?><img onclick="imgchange(<?=$rowimg['id']?>)" data-toggle="modal" data-target="#myModal" style="width:200px; height: 200px; border-radius: 50%;" id="profile_image" src="<?=$rowimg['imagename'];?>">
<?php }else{ if($rowlog['gender']=='female'){ ?><img data-toggle="modal" data-target="#myModal" style="width:200px; height: 200px; border-radius: 50%;"id="profile_image" src="album/19-512.png">
<?php }else if($rowlog['gender']=='male'){ ?><img data-toggle="modal" data-target="#myModal" style="width:200px; height: 200px; border-radius: 50%;" id="profile_image" src="album/corporate.png">
<?php }else{ ?><img data-toggle="modal" data-target="#myModal" style="width:200px; height: 200px; border-radius: 50%;" id="profile_image" src="album/2688079.png"><?php } } ?>
</div>
    <div class="containerprofile"  style="margin-top:20px; font-family:verdana;"><?=strtoupper($rowlog['name']);?></div>
  </div>
</div>
<div class="full_detail" style="background-color:white; box-shadow:5px 10px 10px 5px grey; padding: 10px;">
<?php if($rowlog['typeid']==4){ ?><a class="btn btn-primary" style="float: right;" href="owner_detail_form.php?id=<?=$rowowner['id'];?>"><i class="glyphicon glyphicon-edit" style="font-size:12px"></i>Edit</a><?php } ?>
<table class="table table-responsive"  >
  <?php if(isset($rowowner['f_name'])||isset($rowowner['m_name'])||isset($rowowner['l_name'])){ ?>
    <tr>
    <th style="border:none;">Full Name</th>
    <td style="border:none;"><?=$rowowner['f_name'].' '.$rowowner['m_name'].' '.$rowowner['l_name'];?></td>
  </tr>
  <?php } if(isset($rowlog['email'])){ ?>
  <tr>
    <th style="border:none;">Email</th>
    <td style="border:none;"><?=$rowlog['email'];?></td>
  </tr>
  <?php } if(isset($usergender)){ ?>
  <tr>
    <th style="border:none;">Gender</th>
    <td style="border:none;"><?=$usergender;?></td>
  </tr>
  <?php } if(isset($rowlog['phonenumber'])){ ?>
  <tr>
    <th style="border:none;">Phone No.</th>
    <td style="border:none;"><?=$rowlog['phonenumber'];?></td>
</tr>
<?php } if(isset($rowowner['address'])){ ?>
 <tr>
    <th style="border:none;">Address</th>
    <td style="border:none;"><?=$rowowner['address'];?></td>
</tr>
<?php } if(isset($rowowner['adhaar'])){ ?>
 <tr>
    <th style="border:none;">Adhaar</th>
    <td style="border:none;"><?=$rowowner['adhaar'];?></td>
</tr>
<?php } if(isset($rowowner['pincode'])){ ?>
 <tr>
    <th style="border:none;">Pincode</th>
    <td style="border:none;"><?=$rowowner['pincode'];?></td>
</tr>
<?php } if(isset($rowowner['city'])){ ?>
 <tr>
    <th style="border:none;">City</th>
    <td style="border:none;"><?=$rowowner['city'];?></td>
</tr>
<?php } if(isset($rowowner['country'])){ ?>
 <tr>
    <th style="border:none;">Coutnry</th>
    <td style="border:none;"><?=$rowowner['country'];?></td>
</tr>
<?php } ?>

  </table>

	</div>

</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Pic</h4>
        </div>
        <div class="modal-body">
    	<form method="post" action="upload.php" enctype="multipart/form-data">
              <input class="hidden" type="text" name="imageid" id="imgid" hidden="" value="" />
          <p><input id="imageupload" type="file" name="fileToUpload" capture></p>
		<input class="btn large btn-success" type="submit" name="submit" value="Upload">
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
</html>
<script type="text/javascript">
  function imgchange(imgid)
  {
    document.getElementById('imgid').value=imgid;
  }
</script>