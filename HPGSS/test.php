<?php
if (isset($_GET['add'])) {
  $a = $_GET['a'];
  $b = $_GET['b'];
  $c = $a+$b;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body>
  <form method="get">
    <input type="text" name="a" value="<?php if(isset($a)){echo $a; }?>" placeholder="Enter First number">
    <input type="text" name="b" value="<?php if(isset($b)){echo $b; }?>" placeholder="Enter Second number">
    <button type="submit" name="add" value="add">+</button><br>Sum = 
    <input type="text" name="c" value="<?php if(isset($c)){echo $c; }?>" readonly>
  </form>
</body>
</html>