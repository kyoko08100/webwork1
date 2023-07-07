<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫

$index_num=(int)$_POST["ID"];
$sql="DELETE FROM `comment` WHERE `ID` = {$index_num} ";
$re=mysqli_query($conn,$sql);

?>