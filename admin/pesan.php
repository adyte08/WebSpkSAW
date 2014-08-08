<?php
include_once 'header.php';
include_once 'koneksi.php';
$query = mysql_query ("SELECT * FROM `pesan_masuk` WHERE `viewed`=0");
$total_inbox = mysql_num_rows($query);
?>
<div class="span11">
<h3>Pesan</h3>
<hr>
</div>
<?php
if(isset($_POST['hapus'])){
        $id=$_POST['bulk'];
foreach ($id as $i){
mysql_query("DELETE FROM `pesan_masuk` WHERE `id`='$i'");
}
echo '<p class="alert alert-success span11">Data berhasil dihapus</p>';
}


?>
<div class="span11">
    <?php
    $limit=10;
    $sql= "SELECT * FROM `pesan_masuk`";
    $result = mysql_query ($sql);
    $totaldata=  mysql_num_rows($result);
    $totalpage= ceil($totaldata / $limit);
//    link 1 2 3
    echo '<div class="pagination">
        <ul>';
//    looping
    for ($i=1;$i<=$totalpage;$i++){
        echo '<li '.((isset($_GET['page'])&& $_GET['page']==$i)?'class="active"':'').'> 
            <a href="pesan.php?page='.$i.'">'.$i.'</a></li>';
    }
    echo '</ul></div>';
    
//    list inbox
    if (isset($_GET['page'])){
        $offset=($_GET['page']-1) * $limit;
       
    }
    else {
        $offset = 0;
        }
        $sql = "SELECT * FROM `pesan_masuk` ORDER BY `tanggal` DESC limit $offset,$limit";
        $result = mysql_query($sql);
        ?>
    
    <table class="table">
        <form action="pesan.php" method="POST">
            <tbody>
                <?php
                while ($pesan=mysql_fetch_assoc($result)){
                    ?>
                <tr <?php echo ($pesan['viewed']==0)?'style="font-weidth:bold;background-color:#eee"':''?>>
                    <td><input type="checkbox" name="bulk[]" value="<?php echo $pesan['id']?>"></td>
                    <td><span class="pull-left" style="font-size:16px"><a href="view_pesan.php?view=<?php echo $pesan['id']?>"> <?php echo $pesan['nama']?></a></span>
                        <span class="pull-right"> <?php echo $pesan['tanggal'] ?> </span>
                        <div class="clearfix"></div>
                        <span style="font-size:14px" class="pull-left"> <?php echo $pesan['subjek'] ?> </span>
                        <div class="clearfix"></div>
                        <span  style="font-size:13px" class="pull-left echtul"> <?php echo $pesan['isi_pesan'] ?> </span>
                    </td>
                    </tr>
               <?php } ?>
                    <tr><td> <button class="btn" name="hapus">Hapus</button></td></tr>
                        
            </tbody>
            
        </form>
        
    </table>
</div>
<?php
include_once 'footer.php';
?>