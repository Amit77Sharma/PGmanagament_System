<?php
session_start();
include 'connect.php';
if(isset($_FILES["fileToUpload"]["name"]))
{
$ownermailid=$_SESSION['username'];
$sqlownerid="SELECT * from tbl_login_details where email='$ownermailid' or phonenumber='$ownermailid'";
$qryownerid=$conn->query($sqlownerid);
$rowownerid=$qryownerid->fetch_array();
$loginid=$rowownerid["id"];
$imageid="";

$target_dir = "uploads/".$rowownerid['name'].$rowownerid['id'];
if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
  }
$target_file = $target_dir .'/'. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  if(!$_POST['imageid']=="")
  {
    $imageid=$_POST['imageid'];
    $sqlgetimg="select * from ownerprofile_uploading where id=$imageid";
    $qrygetimg=$conn->query($sqlgetimg);
    if(mysqli_num_rows($qrygetimg)>=1)
    {
      $rowgetimg=$qrygetimg->fetch_assoc();
      unlink($rowgetimg['imagename']);
    }
  }
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";  
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    if(!$imageid=="")
    {
      $sqlimage="update ownerprofile_uploading set imagename='$target_file' where id=$imageid";
      $qryimage=$conn->query($sqlimage);  
    }
    else
    {
      $sqlimage="insert into ownerprofile_uploading(id, ownerid, imagename, status) values(0,$loginid,'$target_file',0)";
      if($qryimage=$conn->query($sqlimage)==true)
      {
        if(mysqli_num_rows($conn->query("select * from tbl_owner_details where login_id=$loginid"))>=1)
        {
          $qryupdate=$conn->query("update tbl_owner_details set status=1 where login_id=$loginid");
        }
      }
    }
    header("Location:ownerprofile.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?>



