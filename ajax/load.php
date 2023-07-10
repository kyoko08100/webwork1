<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
$query="SELECT * FROM `comment`";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result);
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
        echo"
        <button type='button' id='update-{$value[0]}'>修改</button>
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
        echo"
        </div>";
    }  
}
?>