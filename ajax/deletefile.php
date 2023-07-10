<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫

$index_num=(int)$_POST["ID"];
$sql="DELETE FROM `file` WHERE `ID` = {$index_num} ";
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

$folderPath = "../file/{$_COOKIE["account"]}/{$index_num}/{$_POST["filename"]}";
unlink($filePath);
?>