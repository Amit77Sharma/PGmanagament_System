<?php
$server='localhost';
$db='sign in';
$user='root';
$pass='';
$conn=new mysqli($server,$user,$pass,$db);
if ($conn->connect_error) {
  die("Connection failed: " .$conn->connect_error);
}
?>