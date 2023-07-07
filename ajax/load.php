<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
$query="SELECT * FROM `comment`";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result);
echo"<h1>留言板</h1>";
// 印出留言
foreach($row as $value){
    if($value[1] == $_COOKIE["account"]){
        //有按鈕的
        echo "<div class='message' id='message-{$value[0]}'> 
        <p class='name'>{$value[1]}</p>
        <p class='timestamp'>{$value[2]}</p>
        <p id='oldTxt-{$value[0]}'>{$value[3]}</p>
        <button type='button' id='update-{$value[0]}'>修改</button>
        <button type='button' id='delete-{$value[0]}'>刪除</button>
        </div>";
    }
    else{
        //沒按鈕的
        echo "<div class='message' id='message-{$value[0]}'> 
        <p class='name'>{$value[1]}</p>
        <p class='timestamp'>{$value[2]}</p>
        <p id='oldTxt-{$value[0]}'>{$value[3]}</p>
        </div>";
    }  
}
echo "<form method='POST' action='/webwork1/message.php'>

<div class='form-group'>
<label for='message'>留言:</label>
<textarea id='message' name='message'></textarea>
</div>

<button type='submit' name='add_comment' id='add_commit'>送出</button>

</form>";
?>