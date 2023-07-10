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
    for($i=0;$i<count($_FILES["fileInput"]["name"]);$i++){
        $query="INSERT INTO `file`(`ID`,`filename`) VALUES ('{$count}','{$_FILES["fileInput"]["name"][$i]}')";
        $result=mysqli_query($conn,$query);
    }
    // upload image
    if(is_dir("../file/{$_COOKIE["account"]}")){
        mkdir("../file/{$_COOKIE["account"]}/{$count}");
    }
    else{
        mkdir("../file/{$_COOKIE["account"]}");
        mkdir("../file/{$_COOKIE["account"]}/{$count}");
    }
    for($i=0;$i < count($_FILES["fileInput"]["name"]);$i++){
        $tmp_name=$_FILES["fileInput"]["tmp_name"][$i];
        $fileName=$_FILES["fileInput"]["name"][$i];
        $target_dir="../file/{$_COOKIE["account"]}/{$count}/";
        if (!move_uploaded_file($tmp_name, $target_dir . $fileName)) {
            // $response["trans"] = false;
            // $response["response"] = "image upload failed";
        }
    }
    $query="SELECT * FROM `comment`";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_all($result);
    // $lab->debug_to_console($row);
    // 印出留言
    foreach($row as $value){
        if($value[1] == $_COOKIE["account"]){
            //有按鈕的
            echo "<div class='message' id='message-{$value[0]}'> 
            <p class='name'>{$value[1]}</p>
            <p class='timestamp'>{$value[2]}</p>
            <p id='oldTxt-{$value[0]}'>{$value[3]}</p>";
            $target_dir="../file/{$value[1]}/{$value[0]}/";
            $existFiles = glob($target_dir  . "*");
            for($i=0;$i<count($existFiles);$i++){
                $tempfile=substr($existFiles[$i],3);
                echo "<a href='download.php?path={$tempfile}' id='file-{$value[0]}-{$i}'>{$tempfile}</a><button type='button' id='delete-{$value[0]}-{$i}' hidden>刪除</button><br>";
            }
            echo"<button type='button' id='update-{$value[0]}'>修改</button>
            <button type='button' id='delete-{$value[0]}'>刪除</button>
            </div>";
        }
        else{
            //沒按鈕的
            echo "<div class='message' id='message-{$value[0]}'> 
            <p class='name'>{$value[1]}</p>
            <p class='timestamp'>{$value[2]}</p>
            <p id='oldTxt-{$value[0]}'>{$value[3]}</p>";
            $target_dir="../file/{$value[1]}/{$value[0]}/";
            $existFiles = glob($target_dir  . "*");
            for($i=0;$i<count($existFiles);$i++){
                $tempfile=substr($existFiles[$i],3);
                echo "<a href='download.php?path={$tempfile}' id='file-{$value[0]}-{$i}'>{$tempfile}</a><button type='button' id='delete-{$value[0]}-{$i}' hidden>刪除</button><br>";
            }
            echo "</div>";
        }  
    }// foreach end 
    
    
    

}
else{
    echo"<script>alert('請輸入內容')</script>";
}
   
//if的括號


?>