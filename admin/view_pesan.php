<?php
include_once 'header.php';
include_once 'koneksi.php';

$query = mysql_query ("SELECT * FROM `pesan_masuk` WHERE `viewed`=0");
$total_inbox = mysql_num_rows($query);
?>
<!--sub menu-->

<div class="span10">
    <h3>View Pesan</h3><hr>
<?php
    $sql="SELECT * FROM `pesan_masuk` WHERE `id`='".$_GET['view']."'";
    $result=mysql_query($sql);
    
    $data=mysql_fetch_assoc($result);
    echo '<fieldset><label><strong>nama:</strong></label><span>'.$data['nama'].'</span>';
    echo '<label style=" clear : left"><strong>email:</strong></label><span>'.$data['email'].'</span>';
    echo '<label style=" clear : left"><strong>subjek:</strong></label><span>'.$data['subjek'].'</span></fieldset>';
    echo '<fieldset><label><strong>pesan:</strong></label><span class="echtul">'.$data['isi_pesan'].'</span></fieldset>';
?>
    <a href="pesan.php" class="btn pull-right" style="margin-left: 20px">Kembali</a>
</div>
<style>
    fieldset {
        width : 100%;
        float :left;
        border : 1px solid #ccc;
    }
    fieldset label {
        float : left;
        width : 10%;
    }
    fieldset span {
        float : left;
        width : 90%;
    }
</style>

<?php
include_once 'footer.php';
?>
