<?php
//pemanggilan koneksi.php
include_once 'header.php';
include_once 'koneksi.php';
session_start();
?><!DOCTYPE html>

     <!-- *******************************SIDE  MENU ARCHIVE**************************** -->
<div class="span2">
     <div class="accordion" id="accordion1">
        Archive

        <?php
        $result = mysql_query("SELECT Year(`tanggal`) AS year FROM artikel GROUP BY Year(`tanggal`)") or die(mysql_error());
        $i =0;
        echo '<ul id="nav">'; 
        while($data = mysql_fetch_assoc($result)){
            echo '<li><a href="#">'.$data['year'].'</a><ul>';
            $result2 = mysql_query("SELECT Monthname(`tanggal`) AS month FROM artikel WHERE Year(`tanggal`)='".$data['year']."' GROUP BY Month(`tanggal`)") or die(mysql_error());
            while($data2 = mysql_fetch_assoc($result2)){               
                echo '<li><a href="artikel.php?artikel&year='.$data['year'].'&months='.$data2['month'].'">'.$data2['month'].'</a></li>';
            }
            echo '</ul></li>';
            $i++;
        }
        echo '</ul>';
        ?>
    </div>
</div>


<div class="span9">
<?php

$sql = "SELECT * FROM `artikel` WHERE `id_artikel`='".$_GET['view']."'";
$result = mysql_query($sql);
$data = mysql_fetch_assoc($result);
echo '<h3>'.$data['title'].'</h3>';
 echo '<img src="img/upload/'.$data['title_image'].'" width="120px" height="120px">';
echo '<p style="font-size: 12px">Dibuat oleh : '.$data['author'];
echo ', pada tanggal : '.$data['tanggal'].'</p>';
echo '<fieldset style="width:100%;border:1px solid #ccc; float:left"><p class="echtul">'.$data['artikel'].'</p></fieldset>';
?>
</div>
<?php
include_once 'footer.php';
?>