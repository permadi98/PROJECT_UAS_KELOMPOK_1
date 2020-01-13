<?php 
include_once "koneksi.php";
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin/index.php");
} elseif (isset($_SESSION["kasir"])) {
    header("Location: kasir/index.php");
}



if (isset($_POST["admin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
	$akses = "admin";


  $res = $DB_con->query("SELECT * FROM kasir where username='$username' and password='$password' and akses='$akses'");
  $row = $res->fetch(PDO::FETCH_ASSOC);
  $user = $row['username'];
  $pass = $row['password'];
  $aks = $row['akses'];
  if($user==$username && $pass=$password && $aks=$akses)
 {
      $_SESSION["admin"] = $akses;
      $_SESSION["username"] = $username;
	  $_SESSION["password"] = $password;
	  $_SESSION["akses"] = $akses;

      header("Location: admin/index.php");
      exit;
  
    } else {
		echo"<script>alert('Gagal Masuk..!!');
		document.location.href='index.php'; </script>\n";
    }
} elseif (isset($_POST["kasir"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
	$akses = "kasir";


  $res = $DB_con->query("SELECT * FROM kasir where username='$username' and password='$password' and akses='$akses'");
  $row = $res->fetch(PDO::FETCH_ASSOC);
  $user = $row['username'];
  $pass = $row['password'];
  $aks = $row['akses'];
  if($user==$username && $pass=$password && $aks=$akses)
 {
      $_SESSION["kasir"] = $akses;
      $_SESSION["username"] = $username;
	  $_SESSION["password"] = $password;
	  $_SESSION["akses"] = $akses;

      header("Location: kasir/index.php");
      exit;
  
    } else {
		echo"<script>alert('Gagal Masuk..!!');
		document.location.href='index.php'; </script>\n";
    }
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Form Login Toko Buku</title>
  <link rel="stylesheet" href="login/css/normalize.min.css">
  
      <link rel="stylesheet" href="login/css/gaya.css">
      <link rel="stylesheet" href="loader/loader.css">

  
</head>

<body>
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <div class="form" style="margin-top:100px;">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#kasir">Kasir</a></li>
        <li class="tab"><a href="#admin">Admin</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="kasir"> 
          <h1>KASIR</h1>
          
          <form method="post">
          
          <div class="field-wrap">
            <label>
              Username
            </label>
            <input name="username" type="text"required autofocus autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>
          
		  <input class="button button-block" name="kasir" type="submit" value="MASUK">
          
          </form>

        </div>
        
        <div id="admin">
          <h1>ADMIN</h1>
          
          <form method="post">
          
            <div class="field-wrap">
            <label>
              Username
            </label>
            <input name="username" type="text"required autofocus autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>
          
		  <input class="button button-block" name="admin" type="submit" value="MASUK">
          
          </form>

        </div>
        
      </div>
      
</div> 
  <script src="login/js/jquery.min.js"></script>

    <script src="login/js/gaya.js"></script>
    <script src="loader/loader.js"></script>

</body>
</html>
