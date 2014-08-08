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
        <link rel="stylesheet" type="text/css" href="../css/docs.css">
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
    <p class="headeradmins2">ADMINISTRATOR<br></p>
    <p class="headeradmins">Sistem Pendukung Keputusan Pemilihan Handphone Android</p>
</div>
<!--~~~~~~~~~~~-->

<div class="container wrap">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="navbar navbar-inverse">
                    <div class="navbar-inner">
                        <div class="nav-collapse collapse">
                            <ul class="nav">
				
                                <li  <?php echo ($_SERVER['REQUEST_URI'] == '/spk_android/admin/index.php')?'class="active"':'';?>><a href="index.php"><i class="icon-home icon-white"></i></a></li> 
                                <?php
                                if ($_SESSION['hak_akses']=='admin'){
                                $where=1;
                                ?>  
                                <li <?php echo (isset($_GET['user']))?'class="active"':'';?>><a href="user.php">Kelola Pengguna</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelola SPK<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="kriteria.php">Kriteria Atribut</a></li>
                                        <li><a href="spk.php">Rating Kecocokan</a></li>
                                        <li><a href="kebutuhan.php">Kebutuhan</a></li>
                                    </ul>
                                </li>
                                <?php
                                } 
                                ?> 
                                <?php
                                if ($_SESSION['hak_akses']=='editor'){
                                $where=1;
                                ?>  
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelola Konten<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li <?php echo (isset($_GET['spek']))?'class="active"':'';?>><a href="baner.php">Banner</a></li>
                                        <li <?php echo (isset($_GET['artikel']))?'class="active"':'';?>><a href="artikel.php">Artikel</a></li>
                                        <li <?php echo (isset($_GET['spek']))?'class="active"':'';?>><a href="mobile.php">Handphone</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelola Pesan<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                <li <?php echo (isset($_GET['opini']))?'class="active"':'';?>><a href="opini.php">Opini</a></li>
                                <li <?php echo (isset($_GET['pesan']))?'class="active"':'';?>><a href="pesan.php">Pesan</a></li>
                                    </ul>
                                </li>
                                <?php
                                } 
                                ?> 
                                <li> <a href="../index.php" target="_blank">View Web</a></li>
                            </ul>
                        </div>
                        <ul class="nav pull-right">
                            <li><a href="logout.php">Keluar</a></li>
                        </ul>
                    </div><!-- navbar-inner -->
                </div><!-- navbar-inverse -->
            </div><!-- span12-->
        </div><!-- row  fluid-->