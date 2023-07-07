<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
$sql="SELECT `ID` FROM `comment`";
$re=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($re);

$index_num=(int)$_POST["ID"];
$sql="UPDATE `comment` SET `text`='{$_POST["text"]}' WHERE `ID` = {$index_num} ";
$re=mysqli_query($conn,$sql);

echo $_POST["text"];
// {$_POST["text"]}
?>