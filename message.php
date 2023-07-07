<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="../assets/js/color-modes.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.112.5">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>留言板</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
      text-align: center;
    }
    
    .message {
      margin-bottom: 20px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 20px;
    }
    
    .message p {
      margin: 0;
    }
    
    .message .name {
      font-weight: bold;
    }
    
    .message .timestamp {
      font-size: 0.8em;
      color: #999;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    
    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
      resize: none;
    }
    
    button {
      padding: 10px 20px;
      background-color: #4caf50;
      border: none;
      color: #fff;
      cursor: pointer;
    }
  </style>
</head>
<body>
    <?php
        if(isset($_COOKIE['account']) && !isset($_POST["add_comment"])){
            echo"<script>alert('登入成功')</script>";
        }
    ?>
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Carousel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class='nav-link active' aria-current='page' href='#'>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        
          
            <?php
            // if(!isset($_SESSION['account'])){
            //   $_SESSION['account']=$_POST['account'];
            // }
            
            if(!isset($_COOKIE['account'])){
              echo "<a class='nav-link active' href='/webwork1/sign-in/sign-in.php'>登入/註冊</a>";
            }
            else{
              echo "<a class='nav-link active' href='/webwork1/index.php?d=1'>登出</a>";
            }
            
            ?>
          
        
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="button" >Search</button>
        </form> -->
      </div>
    </div>
  </nav>
</header>
  <div class="container">
    
  <h1>留言板</h1>
    <!-- <div class="message">
      <p class="name">John Doe</p>
      <p class="timestamp">2023-07-06 10:30 AM</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla interdum tincidunt ipsum ac placerat.</p>
    </div>
    
    <div class="message">
      <p class="name">Jane Smith</p>
      <p class="timestamp">2023-07-06 11:15 AM</p>
      <p>Donec ultricies ligula nec nulla scelerisque, eget lobortis leo tincidunt.</p>
      <button type="button">修改</button>
    </div> -->
    
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
    ?>

          

    <!-- 留言表單 -->
    <form id="form">
      <!-- <div class="form-group">
        <label for="name">姓名:</label>
        <input type="text" id="name" name="name">
      </div> -->
      
      <div class="form-group">
        <label for="message">留言:</label>
        <textarea id="message" name="message"></textarea>
      </div>
      
      <button type="submit" name="add_comment" id="add_comment">送出</button>
      
    </form>

  </div>

  <script>
    $(document).ready(function() {
        var temp;
        $.ajax({
            url: 'ajax/load.php',
            type: 'POST',
            success: function (result) {
              $(".container").html(result);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Status: ' + textStatus)
                alert('Error: ' + errorThrown)
            }
        }); //ajax
        $(document).on("click","button[id^='update-']",function(){
            const id=$(this).attr("id").split("-")[1];
            temp=$("#oldTxt-" + id).text();
            $("#delete-"+id).remove(); //移除刪除按鈕
            $("#message-"+id).append(`<textarea id='newTxt-${id}' placeholder='${temp}'></textarea>`); //出現textarea
            $("#message-"+id).append(`<button id='complete-${id}'>完成</button>`); //出現完成按鈕
            $("#update-"+id).remove(); //移除修改按鈕
            $("#oldTxt-"+id).remove(); //移除舊的內容
        });//on update

        $(document).on("click","button[id^='complete-']",function(){
            const id=$(this).attr("id").split("-")[1];
            if($("#newTxt-" + id).val()!=""){
              $.ajax({
                url: 'ajax/update.php',
                type: 'POST',
                data: {ID: id, text:$("#newTxt-" + id).val()},
                success: function (result) {
                  $("#message-"+id).append(`<p id='oldTxt-${id}'>${result}</p><button id='update-${id}'>修改</button><button id='delete-${id}'>刪除</button>`); //出現新的留言  
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('Status: ' + textStatus)
                    alert('Error: ' + errorThrown)
                }
              }); //ajax
              }
            else{
              $("#message-"+id).append(`<p id='oldTxt-${id}'>${temp}</p><button id='update-${id}'>修改</button><button id='delete-${id}'>刪除</button>`); //出現舊的留言
            }
              $("#newTxt-"+id).remove(); //移除textarea
              $("#complete-"+id).remove(); //移除完成按鈕
              
              
          });//on complete  

        $(document).on("click","button[id^='delete-']",function(){
            const id=$(this).attr("id").split("-")[1];
            temp=$("#oldTxt-" + id).text();
            $("#message-"+id).remove(); //移除message

            $.ajax({
                url: 'ajax/delete.php',
                type: 'POST',
                data: {ID: id},
                success: function () {
                  alert('刪除成功') //出現刪除成功  
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('Status: ' + textStatus)
                    alert('Error: ' + errorThrown)
                }
              }); //ajax

        });//on delete

        $("form").submit(function(){
            // const id=$(this).attr("id").split("-")[1];
            console.log('有進來');

            $.ajax({
                url: 'ajax/submit.php',
                type: 'POST',
                data: {ID: id,message: $("message").val()},
                success: function (result) {
                  $(".container").html(result);
                  console.log(result);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('Status: ' + textStatus)
                    alert('Error: ' + errorThrown)
                }
            }); //ajax

        });//submit



    }); // ready
    </script>
</body>

</html>