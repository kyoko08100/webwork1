<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script src="../assets/js/color-modes.js"></script>

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
    $conn=new mysqli("127.0.0.1","root","","webwork"); //連接資料庫
    if(isset($_COOKIE['account'])){
        echo"<script>alert('登入成功')</script>";
       }
    $query="SELECT * FROM `comment`";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_all($result);
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
    
    <div class="message">
      <p class="name">John Doe</p>
      <p class="timestamp">2023-07-06 10:30 AM</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla interdum tincidunt ipsum ac placerat.</p>
    </div>
    
    <div class="message">
      <p class="name">Jane Smith</p>
      <p class="timestamp">2023-07-06 11:15 AM</p>
      <p>Donec ultricies ligula nec nulla scelerisque, eget lobortis leo tincidunt.</p>
      <button type="button">修改</button>
    </div>
    
    <!-- 留言表單 -->
    <form>
      <div class="form-group">
        <label for="name">姓名:</label>
        <input type="text" id="name" name="name">
      </div>
      
      <div class="form-group">
        <label for="message">留言:</label>
        <textarea id="message" name="message"></textarea>
      </div>
      
      <button type="submit">送出</button>
      
    </form>

  </div>
</body>
</html>