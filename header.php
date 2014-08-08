<?php 
//pemanggilan koneksi.php
include_once 'koneksi.php';
session_start();
?><!DOCTYPE html>
<html>
    <head>
       
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-wysihtml5-0.0.2.css">
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">
        <link rel="stylesheet" type="text/css" href="css/docs.css">
        <link rel="stylesheet" type="text/css" href="css/caroufred.css">
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/wysihtml5-0.3.0_rc2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-wysihtml5-0.0.2.min.js"></script>
<?php
        if (!empty($js)){
            echo $js;
        }
        ?>
       <script>
            $(document).ready(function(){
                $('.dropdown-toggle').dropdown();
                $('.dropdown input, .dropdown label').click(function(e){
                  e.stopPropagation(); 
               });
            });
        </script>
        <title>Android SPK</title>
    </head>
    <body>
        
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-inner">
            <div class="nav-collapse">
                <ul class="nav">
                <li><a  href="index.php" style="color: #99cc33;">Home</a></li>
                <li><a  href="spk.php" style="color: #99cc33;">Pemilihan</a></li>
                <li><a  href="artikel.php" style="color: #99cc33;">Artikel</a></li>
                <li><a  href="compare.php" style="color: #99cc33;">Compare</a></li>
                <li><a  href="contactus.php" style="color: #99cc33;">Kontak Kami</a></li>
            </ul>
                <ul class="nav pull-right">
                    <li><a href="http://facebook.com/norma.s.rianingsih"><img src="img/fb.png" width="25px" height="25px" alt=""></a></li>
                    <li><a href="http://facebook.com/norma.s.rianingsih"><img src="img/twitter.png" width="25px" height="25px" alt=""></a></li>
                    <li><a href="http://facebook.com/norma.s.rianingsih"><img src="img/google.png" width="25px" height="25px" alt=""></a></li>
                </ul>
                <div class="input-append">
                <form action="index.php" method="POST" class="navbar-search">
                 <input type="text" name="search" data-provider="typeahead" data-items="4" id="search" autocomplete="off" placeholder="Nama Handphone...">
                 <button class="btn" name="search_button">Cari </button>
                </form>
                </div>
            <?php
        
            ?>
            </div>
            </div> <!-- navbar-inner -->
            </div><!-- navbar fixed top -->
            <div class="hero-unit">
                 <img src="img/logo2.png" width="380px"> 
            </div>
     <div class="container">
        <div class="row-fluid">
            <div class="span2">
                <?php 
                $sql = "SELECT * FROM merek_hp";
                $result = mysql_query($sql);
                echo '<ul class="nav nav-list bs-docs-sidenav affix">';
                while($data = mysql_fetch_assoc($result)){
                    echo '<li><a href="merek.php?merek='.$data['nama_merek'].'">'.$data['nama_merek'].'</a></li>';
                }
                echo '</ul>'
                ?>
            </div>
            <?php
            $result = mysql_query("SELECT `ID`,`versi_hp` FROM `spesifikasi`");
$hp='[';
while ($rawdata = mysql_fetch_assoc($result)){
    $hp.="'".$rawdata['versi_hp']."',";
}
$hp .=']';
            ?>

            <script>
                var hp = <?php echo $hp;?>;
                $('#search').typeahead({source:hp});
            </script>