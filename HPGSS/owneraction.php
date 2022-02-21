<?php
include "connect.php";
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$action=$_GET["type"];
	if($action=='activate')
	{
		echo $sql="update tbl_owner_details set status=1 where id=$id";
		$qry=$conn->query($sql);
	}
	elseif($action=="deactivate")
	{
         echo $sql="update tbl_owner_details set status=0 where id=$id";
         $qry=$conn->query($sql);												
	}
}
header('location: ownerlisting.php');
?>