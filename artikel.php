<?php
include_once 'header.php';
?>
<!-- *******************************SIDE  MENU ARCHIVE**************************** -->
<div class="span10">
<h3> Artikel </h3><hr>
</div>
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

<div class="span10">
    

   <?php
/*---------------------IF ARCHIVE SELECTED-------------------------*/
if(isset($_GET['months'])){
    $where = "Year(`tanggal`)='".$_GET['year']."' AND Monthname(`tanggal`)='".$_GET['months']."'";
    $uri = '&year='.$_GET['year'].'&months='.$_GET['months'];
}
else{
    $where = 1;
    $uri='';
}
$limit = 10;
/*-------------------PAGING LINK ---------------------------------*/
$sql_page = "SELECT * FROM artikel WHERE ".$where;
$result_page = mysql_query($sql_page);
$total_data = mysql_num_rows($result_page);
$total_page = ceil($total_data / $limit);

if(!empty($total_page)){
    $page = '<div class="pagination pull-right" style="float:none; margin:0 auto"><ul>';
    for($i=1;$i<=$total_page;$i++){
        $page .= '<li '.((isset($_GET['page']) && $_GET['page']==$i)?'class="active"':'').'><a href="artikel.php?artikel&page='.$i.'">'.$i.'</a></li>';
    }
    $page .= '</ul></div>';
    }

    //ambil data spefikasi berdasarkan merek dan sesuai page link
    if(isset($_GET['page'])){
        $offset = ($_GET['page'] - 1) * $limit;
    }else{
        $offset = 0;
        }
   
?>  
 <!-- ***********************TABLE artikel***************************************** -->   
    <table class="table table-bordered">
        
    <tbody>
    <?php
//    $result = mysql_query("SELECT * FROM artikel ORDER BY `tanggal` DESC");
    $sql = "SELECT * FROM artikel WHERE ".$where." ORDER BY `tanggal` DESC LIMIT $offset,$limit";
    $result = mysql_query($sql) or die(mysql_error());    
    while($data = mysql_fetch_assoc($result)){
        echo '<tr>';
                echo    '<td><h3>'.$data['title'].'</h3>';
                echo '<img src="img/upload/'.$data['title_image'].'" width="80px" height="80px">';
                   echo '<p style="font-size:12px">Dibuat oleh : '.$data['author'].', pada tanggal : '.$data['tanggal'].'</p>';
                    echo '<p class="echtul">'.substr($data['artikel'],0,140).'...</p>
                        <a class="pull-right" href="view_artikel.php?artikel&view='.$data['id_artikel'].'"> Selengkapnya >> </a></td>';
                    echo '</tr>';
    }
    
    ?>
    </tbody>
    </table>
<?php 
echo '<div style="width:100%; text-align:center;float:left">'.$page.'</div>';
?>
</div>
<script>
$(document).ready(function () {
  $('#nav > li > a').click(function(){
    if ($(this).attr('class') != 'active'){
      $('#nav li ul').slideUp();
      $(this).next().slideToggle();
      $('#nav li a').removeClass('active');
      $(this).addClass('active');
    }
  });
});
</script>
<style>
    #nav li ul {
    display: none; 
}
</style>

<?php
    include_once 'footer.php';
    ?>
