<?php 
//pemanggilan koneksi.php
include_once 'koneksi.php';
session_start();
if (isset($_POST['search_button'])){
    $versi_hp = $_POST['search'];
    $sql="SELECT ID FROM spesifikasi WHERE versi_hp='$versi_hp'";
    $result = mysql_query($sql) or die (mysql_error());
    $data =  mysql_fetch_assoc($result);
    header("Location:spesifikasi.php?spesifikasi=".$data['ID']);
}
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
<script type="text/javascript" src="js/jquery.carouFredSel-5.5.0-packed.js"></script> 

<script>
$(document).ready(function(){
    $("#rp-carousel").carouFredSel({
	circular: false,
    infinite: false,
    auto    : false,
    width		: 480,
    height		: 213,
    scroll		: {
    	items		: 2,
    	duration    : 500
    },
	prev    : {
        button  : "#rp-carousel_prev",
        key     : "left"
    },
    next    : {
        button  : "#rp-carousel_next",
        key     : "right"
    }
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
                <!--<li><a  href="filter.php" style="color: #99cc33;">Filter</a></li>-->
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
                 <button class="btn" name="search_button">Cari</button>
                </form>
                </div>
           
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
           
          


      <!---->  
        <div class="span10">
            <!-- START CAROUSEL -->
<div id="myCarousel" class="carousel slide span11" style="margin-left:50px">
     <ol class="carousel-indicators">
         <?php
         $query1 = "SELECT* FROM banners WHERE status='active'";
         $result1=  mysql_query($query1);
         $total = mysql_num_rows($result1);
         for($j=0;$j<$total;$j++){
             ?>
         
         <li data-target="#myCarousel" data-slide-to="<?php echo $j?>" <?php echo ($j==0)?'class="active"':'' ?>></li>
         <?php } ?>
     </ol>
    <div class="carousel-inner">
        <?php
        $query = "SELECT * FROM banners WHERE status='active'";
        $result = mysql_query($query);
        $i=0;
        while($data = mysql_fetch_assoc($result)){
        ?>
        <div class="item <?php echo (($i == 0 )? 'active':'') ?>">
            <img src="img/upload/<?php echo $data['image']?>" alt="" height="500px">
            <div class="carousel-caption">
                <h4><?php echo $data['title']?></h4>
                <p><?php echo $data['description']?></p>
            </div>
        </div>
            <?php $i++; } ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
            
<!-- END CAROUSEL-->
<div class="clearfix"></div>
            <!--<div style="margin-left: 120px">-->
<!-- START RECENT CELLPHONE -->
            <div class="rp-block-main">
                <h3>Android Terbaru</h3>
<!-- CarouFredSel - Recent Projects -->
                    <div class="projects_carousel">
                        <div id="rp-carousel">
                            <?php
                            $query = "SELECT * FROM spesifikasi ORDER BY rilis DESC LIMIT 0,10";
                            $result = mysql_query($query);
                            while($data = mysql_fetch_array($result)){
                            ?>
                            
                            <!-- start recent hp block -->
                            <div class="rp-block rp-bg">
                                <div class="rp-bg-white">
                                    <img src="img/upload/<?php echo $data['gambar']?>" alt=""/>
                                    <div class="rp-arrow-up"></div>
                                    <div class="rp-content">
                                        <h6><strong><?php echo $data['nama_merek']?></strong></h6>
                                        <p><a href="spesifikasi.php?spesifikasi=<?php echo  $data['ID']?>"><?php echo $data['versi_hp']?></a></p>
                                    </div><!-- .rp-content -->
				</div><!-- .rp-bg-white -->
                            </div><!-- .rp-block -->
                                <?php } ?>
                        </div><!-- #rp-carousel -->
                        <div class="clearfix"></div>
                        <a class="prev" id="rp-carousel_prev" href="#"><span>prev</span></a>
                        <a class="next" id="rp-carousel_next" href="#"><span>next</span></a>
                    </div><!-- .projects_carousel -->
        </div>
        <!--</div>-->
            
            <div class="clearfix"></div>
            <hr>
            <br>
                  <!-- Artikel terbaru -->
                  <div style="margin-left: 20px">
                      <h3>Artikel Terbaru</h3>
                      <?php
                      $query = "SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 0,5";
                      $result = mysql_query($query);
                      while($data=  mysql_fetch_assoc($result)){
                            if(str_word_count($data['artikel']) <=50){
                                 $pos=strlen($data['artikel']);
                            }
                            else{
                                 $pos=strpos($data['artikel'], " " , 400);
                            }

                      ?>
                      <div style="border: solid 1px #eee; padding: 10px; margin-bottom: 20px;">
                          <div style="float:left; width: 20%; padding-top: 10px "><img src="img/upload/<?php echo $data['title_image']?>" width="80px" height="80px"></div>
                          <div style="float:left;">
                            <h4><?php echo $data['title'];?></h4>
                            <p class="echtul">
                                <?php echo substr($data['artikel'],0,$pos);?>
                            </p>
                            <p><a class="btn" href="view_artikel.php?artikel&view=<?php echo $data['id_artikel']?> ">Selengkapnya &raquo;</a></p>
                          </div>
                          <div style="clear: both"></div>
                      </div>
                      <?php }?>

                    <p><a class="" href="artikel.php">Semua Artikel</a></p>
                  </div>
		</div><!-- span9 -->
                     <!-- ****************************************************************************** -->
                  
              </div>
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
        <?php include_once 'footer.php';?>
    
