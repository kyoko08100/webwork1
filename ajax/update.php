<?php
$response=[];
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
$sql="SELECT `ID` FROM `comment`";
$re=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($re);
$index_num=(int)$_POST["ID"];
if($_POST["text"] != ""){
    $sql="UPDATE `comment` SET `text`='{$_POST["text"]}' WHERE `ID` = {$index_num} ";
    $re=mysqli_query($conn,$sql);
}
// $response["text"]=$_POST["text"];
$response=[];
//新增檔案
if(isset($_FILES["fileInputs"])){
    for($i=0;$i < count($_FILES["fileInputs"]["name"]);$i++){
        $tmp_name=$_FILES["fileInputs"]["tmp_name"][$i];
        $fileName=$_FILES["fileInputs"]["name"][$i];
        $target_dir="../file/{$_COOKIE["account"]}/{$index_num}/";
        $response[$i]="file/{$_COOKIE["account"]}/{$index_num}/".$fileName;
        if (!move_uploaded_file($tmp_name, $target_dir . $fileName)) {
            // $response["trans"] = false;
            // $response["response"] = "image upload failed";
        }
    
        $sql="INSERT INTO `file`(`ID`, `filename`) VALUES ('{$index_num}','{$fileName}')";
        $re=mysqli_query($conn,$sql);
    }
}


echo json_encode($response);
// {$_POST["text"]}
?>