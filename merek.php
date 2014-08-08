<?php
include_once 'header.php';
echo '<div class="span10">';
?>
<style>
    .produk-212{
        float:left;
        width:230px;
        border: 1px solid #CCC;
        margin:5px;
        height:170px;
        text-align: center;
        padding: 20px 0 20px 0;
    }
</style>
<?php
$limit = 15;
//buat link paging sesuai dengan total data hp berdasarkan merek - ke tampilan A
$sql_page = "SELECT * FROM `spesifikasi` WHERE `nama_merek`='".$_GET['merek']."'";
$result_page = mysql_query($sql_page);
$total_data = mysql_num_rows($result_page);
$total_page = ceil($total_data / $limit);

    if(!empty($total_page)){
    $page = '<div class="pagination pull-right" style="float:none; margin:0 auto"><ul>';
    for($i=1;$i<=$total_page;$i++){
        $page .= '<li '.((isset($_GET['page']) && $_GET['page']==$i)?'class="active"':'').'><a href="merek.php?merek='.$_GET['merek'].'&page='.$i.'">'.$i.'</a></li>';
    }
    $page .= '</ul></div>';
    }
    //ambil data spefikasi berdasarkan merek dan sesuai page link
    if(isset($_GET['page'])){
        $offset = ($_GET['page'] - 1) * $limit;
    }else{
        $offset = 0;
        }
    $sql = "SELECT * FROM `spesifikasi` WHERE `nama_merek` = '".$_GET['merek']."' ORDER BY `id` DESC LIMIT $offset,$limit";
    $result = mysql_query($sql) or die(mysql_error());
    
    //buat tabel list hp
    $i = 1;
    echo '<h3>'.$_GET['merek'].'</h3>';
   
//    echo '<table class="table table-bordered">
//        <tbody><tr>';
    while($data = mysql_fetch_assoc($result)){
//        echo '<td><a href="spesifikasi.php?spesifikasi='.$data['ID'].'"><img src="img/upload/'.$data['gambar'].'" style="width:80px; height:100px;"></a>
//             <br><strong>'.$data['versi_hp'].'</strong><br> Harga Baru : Rp. '
//             .number_format($data['harga_baru'],0,'','.').'<br>Harga bekas: Rp. '.number_format($data['harga_bekas'],0,'','.').'</td>';
//        if(($i % 3 == 0) && ($i != $total_data)){
//            echo '</tr><tr>';
//        }
//        $i++;
        echo '<div class="produk-212"><a href="spesifikasi.php?spesifikasi='.$data['ID'].'"><img src="img/upload/'.$data['gambar'].'" style="width:80px; height:100px;"></a>
             <br><strong>'.$data['versi_hp'].'</strong><br> Harga Baru : Rp. '
             .number_format($data['harga_baru'],0,'','.').'<br>Harga bekas: Rp. '.number_format($data['harga_bekas'],0,'','.').'</div>';
    }
//    echo '</tr></tbody></table>';
    echo '<div style="width:100%; text-align:center;float:left">'.$page.'</div>';
    echo '</div>';
    
    include_once 'footer.php';
?>
