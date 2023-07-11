<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫

$index_num=(int)$_POST["ID"];
$id_name_arr=explode("-",$_POST["ID"]);
$id_name=$id_name_arr[0];
$f_name_arr=explode("/",$_POST["filename"]);
$f_name=$f_name_arr[count($f_name_arr) - 1];
$sql="DELETE FROM `file` WHERE `filename` = '{$f_name}' AND `ID` = {$id_name}";
$re=mysqli_query($conn,$sql);
// function deleteFolder($folderPath) {
//     if (!is_dir($folderPath)) {
//         return;
//     }

//     $files = array_diff(scandir($folderPath), array('.', '..'));

//     foreach ($files as $file) {
//         $filePath = $folderPath . '/' . $file;

//         if (is_dir($filePath)) {
//             deleteFolder($filePath);
//         } else {
//             unlink($filePath);
//         }
//     }

//     rmdir($folderPath);
// }

$filePath = "../{$_POST["filename"]}";
echo $sql;
unlink($filePath);

?>