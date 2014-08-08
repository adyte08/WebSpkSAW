<?php 
include_once 'header.php';
include_once 'koneksi.php';
include_once 'skala.php';
?>

<div class="span11">
    <h3>Rating Kecocokan</h3>
    <hr>
</div>
<?php
$limit = 10;
/*-------------------PAGING LINK ---------------------------------*/
$sql_page = "SELECT * FROM skala ";
$result_page = mysql_query($sql_page);
$total_data = mysql_num_rows($result_page);
$total_page = ceil($total_data / $limit);

    if(!empty($total_page)){

    $page = '<div class="pagination"><ul>';
    for($i=1;$i<=$total_page;$i++){
        $page .= '<li '.(isset($_GET['page'])?($_GET['page'] == $i ? 'class="active"' :''):'').'><a href="spk.php?page='.$i.'">'.$i.'</a></li>';
    }
    $page .= '</ul></div>';
    }
    //ambil data spefikasi berdasarkan merek dan sesuai page link
    if(isset($_GET['page'])){
        $offset = ($_GET['page'] - 1) * $limit;
    }else{
        $offset = 0;
        }

//ambil data hp (nilai skala smua hp)

echo '<div style="width:900px; overflow:auto; margin: 0 auto;">';
echo '<table class="table table-bordered">';
echo '<thead><th>Versi HP</th>';
$sql_kriteria = "SELECT kriteria FROM kriteria";
$result_kriteria = mysql_query($sql_kriteria);
while($data_kriteria = mysql_fetch_assoc($result_kriteria)){
    echo '<th>'.$data_kriteria['kriteria'].'</th>';
    
}

$sql = "SELECT * FROM skala LIMIT  $offset, $limit";
$result = mysql_query($sql);
while ($data = mysql_fetch_assoc($result)){
    echo '<tr><td>'.$data['versi_hp'].'</td>';
    $res = mysql_query("SELECT field FROM kriteria");
    while($field=  mysql_fetch_assoc($res)){
    echo '<td>'.$data[$field['field']].'</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '<div style="width:100%; text-align:center;float:left">'.$page.'</div>';
?>
<button onclick="window.location.href='spk.php?set'">Hitung</button> 
<button onclick="window.location.href='spk.php?delete'">Hapus</button>
<br>
<?php
if (isset($_GET['set'])){
    $sql="SELECT * FROM spesifikasi";
//    $sql="SELECT * FROM spesifikasi WHERE nama_merek='Samsung'";
    $result = mysql_query($sql);
    while ($data = mysql_fetch_assoc($result)){
        $fields="";
        $res = mysql_query("SELECT field, id_kriteria, type FROM kriteria");
        while($dat = mysql_fetch_assoc($res)){
            $type = explode("(", $dat['type']);
            $skala = hitung_skala($data[$dat['field']],$dat['id_kriteria'],$type[0]);
            $fields .= "'".$skala."',";
        }
        $fields = substr($fields, 0,-1);
        $sql2="INSERT INTO `skala` VALUES ('','".$data['nama_merek']."','".$data['versi_hp']."','".$data['ID']."', $fields)";
        mysql_query($sql2)or die(mysql_error());
    }
    echo "<script>window.location.href='spk.php'</script>";
}
if (isset($_GET['delete'])){
    $sql="TRUNCATE TABLE `skala`";
    mysql_query($sql);
    echo "<script>window.location.href='spk.php'</script>";
}
?>
<?php 
include_once 'footer.php';

?>