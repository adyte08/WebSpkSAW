<?php 
//pemanggilan koneksi.php
include_once 'koneksi.php';
include_once 'login.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-wysihtml5-0.0.2.css">
        <link rel="stylesheet" type="text/css" href="../css/datepicker.css">
        <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../js/wysihtml5-0.3.0_rc2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap-wysihtml5-0.0.2.min.js"></script>
        <title>Admin SPK Android</title>
    </head>
    <body>
        
<!--header logo-->
<div class="headeradmin"> 
    ADMINISTRATOR 
</div>
<!--~~~~~~~~~~~-->

<!--layout-->
<?php if(isset($_SESSION['isAdmin'])!=TRUE){
    echo ' <div class="container-fluid">
        <div class="row-fluid">
        <div class="row-fluid">&nbsp;</div>
        <div class="kotaklogin offset4 well" >
        <div class="span8 offset2" style="background-color:#fff; padding-left:auto;">
        <h3>Silahkan Masuk</h3>';
    if(isset($_POST['login'])){
        isError($error);
    }
    echo '<form action="index.php" method="POST">
        <label>Nama Pengguna</label><input type="text" name="username">
        '.  isvalid("username",$msg, $error).'
        <label>Kata Sandi</label><input type="password" name="password">
        '.  isvalid("password", $msg, $error).'
        <br>
        <button name="login" class="btn btn-primary" type="submit">Masuk</button>
        </form>
        </div>'; 
    echo '</div>'; //div class span6
    echo '</div>'; //div row-fluid
    echo '</div>'; //div container fluid
} 
else{
    ?>
    <script> window.location.href="mobile.php"</script>
<?php } ?>
    </body>
</html>
<style>
    .wrap{
        -moz-box-shadow: 
            15px 0 15px -1px #ccc,
            -15px 0 15px -1px #ccc;
        -webkit-box-shadow: 
            15px 0 15px -1px #ccc,
            -15px 0 15px -1px #ccc;
        box-shadow: 
            15px 0 15px -1px #ccc,
            -15px 0 15px -1px #ccc;
        height: 100%;
       
    }
</style>
