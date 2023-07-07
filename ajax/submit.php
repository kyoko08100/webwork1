<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
$sql="SELECT `ID` FROM `comment`";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($result);

// echo "<script>alert('".$row[1][0]."')</script>"; // ID是長 [[0],[1]] 這樣
if($_POST["message"]){ //輸入內容是否為空
    $count=count($row) == 0 ? 0 : $row[count($row)-1][0] + 1;
    $query="INSERT INTO `comment`(`ID`,`account`, `date`, `text`) VALUES ('{$count}','{$_COOKIE["account"]}',now(),'{$_POST["message"]}')";
    $result=mysqli_query($conn,$query);
    // $_POST=array();
    // unset($_POST);
    // if(isset($_POST)){
    //   echo "<script>console.log('POST還在')</script>";
    // }
    // else{
    //   echo "<script>console.log('{$_POST["message"]}')</script>";
    // }

}
else{
    echo"<script>alert('請輸入內容{$_POST["message"]}')</script>";
}
    
//if的括號


?>