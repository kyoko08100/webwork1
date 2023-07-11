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
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
              echo "<a class='nav-link active' style='color:blue' href='/webwork1/index.php?d=1'>登出</a>";
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
  <div class="print">
    </div>
      <!-- 留言表單 -->
    <form id="form">
      
      <div class="form-group">
        <label for="message">留言:</label>
        <textarea id="message" name="message"></textarea>
      </div>
      <input type="file" id="fileInput" name="fileInput[]" accept=".pdf,.doc,.docx,.jpg" multiple="multiple">
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
              $(".print").html(result);
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
            
            var aArr = $(`a[id^='file-${id}']`);
            aArr.each(function() {
              Id = $(this).attr("id").substr(5);
              $("#delete-" + Id).prop("hidden", false);
            });
            $("#message-"+id).append(`<textarea id='newTxt-${id}' placeholder='${temp}'></textarea>`); //出現textarea
            $("#message-"+id).append(`<button id='complete-${id}'>完成</button>`); //出現完成按鈕
            $("#message-"+id).append(`<input type="file" id="fileInputs-${id}" name="fileInputs[]" accept=".pdf,.doc,.docx,.jpg" multiple="multiple">`); //出現上傳檔案按鈕
            $("#update-"+id).remove(); //移除修改按鈕
            $("#oldTxt-"+id).remove(); //移除舊的內容
        });//on update

        $(document).on("click","button[id^='complete-']",function(){
          const id=$(this).attr("id").split("-")[1];
            event.preventDefault();
            var formData=new FormData();
            formData.append('ID',id);
            formData.append('text',$("#newTxt-" + id).val());
            var files = $('#fileInputs-' + id)[0].files;
            for (var i = 0; i < files.length; i++) {
              formData.append('fileInputs[]',files[i],files[i].name);
            }
            // console.log(formData.getAll('fileInputs[]'));
            var content=$("#newTxt-" + id).val()!="" ? $("#newTxt-" + id).val() : temp; //判斷484沒修改內文
            // console.log(content,$("#newTxt-" + id).val(),temp);
            $.ajax({
                url: 'ajax/update.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                  var response=JSON.parse(result,true);
                  var aArr = $(`a[id^='file-${id}']`);
                  var fid = "";
                  aArr.each(function() {
                    Id = $(this).attr("id").substr(5);
                    fid = $(this).attr("id").split("-")[2];
                    // console.log(Id);
                    $("#delete-" + Id).prop("hidden", true);
                  });// 將檔案的刪除按鈕變回隱形
                  for(var i=0;i < response.length;i++){
                    var t = i + parseInt(fid) + 1;
                    $("#message-"+id).append(`<a href='download.php?path=${response[i]}' id='file-${id}-${t}'>${response[i]}</a>
                    <button type='button' id='delete-${id}-${t}' hidden>刪除</button><br>`);
                  } // 插入超連結
                  
                  
                  $("#message-"+id).append(`<p id='oldTxt-${id}'>${content}</p>`); //出現新的留言
                  $("#message-"+id).append(`<button type='button' id='update-${id}' margin-right='5px'>修改</button><button type='button' id='delete-${id}'>刪除</button>`); //出現新的button
                  $("#newTxt-"+id).remove(); //移除textarea
                  $("#complete-"+id).remove(); //移除完成按鈕
                  $("#fileInputs-"+id).remove(); //移除檔案按鈕
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('Status: ' + textStatus)
                    alert('Error: ' + errorThrown)
                }
              }); //ajax
              
              
                
          });//on complete  

        $(document).on("click","button[id^='delete-']",function(){
          const idArr=$(this).attr("id").split("-");
            if(idArr.length > 2){
              id=idArr[1]+"-"+idArr[2];
              console.log($("#file-"+id).text()); 
              
              $.ajax({
                url: 'ajax/deletefile.php',
                type: 'POST',
                data: {ID: id,filename:$("#file-"+id).text()},
                success: function (result) {
                  console.log(result);
                  $("#file-"+id).remove(); //移除message
                  $("#delete-"+id).remove(); //移除刪除檔案按鈕
                  alert('刪除成功') //出現刪除成功  
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  alert('Status: ' + textStatus)
                  alert('Error: ' + errorThrown)
                }
              }); //ajax
            }
            else{
              id=idArr[1];
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
            }
            

        });//on delete

        $("form").submit(function(){
          const id=$(this).attr("id").split("-")[1];
            event.preventDefault();
            var formData=new FormData(this);
            formData.append('ID',id);
            $.ajax({
                url: 'ajax/submit.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                  $(".print").html(result);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('Status: ' + textStatus)
                    alert('Error: ' + errorThrown)
                }
            }); //ajax
            // $.ajax({
            //     url: 'ajax/load.php',
            //     type: 'POST',
            //     processData: false,
            //     contentType: false,
            //     success: function (result) {
            //       $(".print").html(result);
            //     },
            //     error: function (XMLHttpRequest, textStatus, errorThrown) {
            //         alert('Status: ' + textStatus)
            //         alert('Error: ' + errorThrown)
            //     }
            // }); //ajax

        });//submit



    }); // ready
    </script>
</body>

</html>