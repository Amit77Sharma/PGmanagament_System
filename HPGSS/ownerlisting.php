<?php
include 'header.php';
if($rowlog['typeid']!=1 or $rowlog['typeid']!=2)
{
header('Location:index.php');
}
if(isset($_GET["id"]))
{
  $sql="delete from tbl_owner_details where id="."'".$_GET['id']."'";
  $qry=$conn->query($sql);
  if($qry==true)

  {

header('Location: ownerlisting.php');
  }
}
?> 

<div style="width=100%; background-color: pink;"> 
	 <table class="roomandtable" border='0' width='90%' cellpadding='0' cellspacing='0' align='left'>
  <tr>
    <th class="th1">Serial No.</th>
    <th class="th1">Name</th>
    <th class="th1">E-mail</th>
    <th class="th1">IP adress</th>
    <th class="th1">Date</th>
    <th class="th1">Action</th>
    <th class="th1">Status</th>
  </tr>
  <?php
  $sl=1;
  $sql="select * from tbl_owner_details";
  $qry=$conn->query($sql);
   if($qry==true)
   {
    while($row=$qry->fetch_array())
    {  
?>
  <tr>
    <td class="td1"><?=$sl++;?></td>
    <td class="td1"><?=$row["name"];?></td>
    <td class="td1"><?=$row["email"];?></td>
    <td class="td1"><?=$row["ip"];?></td>
    <td class="td1"><?=$row["date"];?></td>
    <td class="td1"><a href="?id=<?=$row['id'];?>">Delete</a></td>
    <td class="td1"><?php if($row["status"]==0){?><button><a href="owneraction.php?id=<?=$row['id'];?>&type=activate">Activate</a></button><?php }else if($row["status"]==1){ ?><button><a href="owneraction.php?id=<?=$row['id']; ?>&type=deactivate">Deactivate</a></button><?php } ?></td>
  </tr>
<?php }} ?>
 </table>
</div>	
</body>
</html>

