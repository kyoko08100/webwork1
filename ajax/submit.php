<?php
$conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
$sql="SELECT `ID` FROM `comment`";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($result);
if(isset($_POST["add_comment"])){ //看有沒有按送出按鈕
// echo "<script>alert('".$row[1][0]."')</script>"; // ID是長 [[0],[1]] 這樣
    if($_POST["message"]){ //輸入內容是否為空，這個功能暫時沒用
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
    
}//if的括號
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