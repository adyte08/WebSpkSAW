<?php
include_once 'header.php';
?>

<div class="span11">
    <h3>Artikel</h3>
    <hr>
</div>
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

<!-- ***********************LIST ARTIKEL*************************************** -->
<div class="span9">
    <?php
    if (isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset ($_SESSION['message']);
    }
    ?>
    <a class="btn" href="form_artikel.php?form_artikel">Tambah Artikel</a>

    
<!--proses delete-->
<?php
if (isset($_GET['delete_artikel'])){
    $id_artikel=$_GET['delete_artikel'];
    $sql3 = "DELETE FROM `artikel` WHERE `id_artikel`='$id_artikel'";
    $result3 = mysql_query($sql3);
    if ($result3){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
        echo '<script>window.location.href="artikel.php?artikel"</script>';
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
        echo '<script>window.location.href="artikel.php?artikel"</script>';
    }
}
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
        $page .= '<li><a href="artikel.php?artikel'.$uri.'&page='.$i.'">'.$i.'</a></li>';
    }
    $page .= '</ul></div>';
}
//ambil data spefikasi berdasarkan merek dan sesuai page link
if(isset($_GET['page'])){
    $offset = ($_GET['page'] - 1) * $limit;
}
else{
    $offset = 0;
}
?>  

 <!-- ***********************TABLE ARTIKEL***************************************** -->   
<table class="table table-bordered">
    <thead><th>Judul</th><th>Gambar</th><th>Isi</th><th colspan="2">Kelola</th></thead>
<tbody>
    <?php
//    $result = mysql_query("SELECT * FROM artikel ORDER BY `tanggal` DESC");
    $sql = "SELECT * FROM artikel WHERE ".$where." ORDER BY `tanggal` DESC LIMIT $offset,$limit";
    $result = mysql_query($sql) or die(mysql_error());    
    while($data = mysql_fetch_assoc($result)){
        if(str_word_count($data['artikel']) <=50){
             $pos= $pos=strlen($data['artikel']);
        }
        else{
             $pos=strpos($data['artikel'], " " , 400);
        }
        echo '<tr>
            <td><p><strong>'.$data['title'].'</strong></p>
            <p>'.$data['author'].' | '.$data['tanggal'].'
            </p></td>
            <td><img src="../img/upload/'.$data['title_image'].'" width="80px" height="80px"></td>
            <td><p class="echtul" style="width:400px;">'.substr($data['artikel'],0,$pos).'</p></td>
            <td><a href="form_artikel.php?edit_artikel='.$data['id_artikel'].'">Ubah</a></td>
            <td><a href="#" onclick="delete_confirm('.$data['id_artikel'].')">Hapus</a></td>
            </tr>';
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
<script>

    function delete_confirm(id){
        var id_artikel = id;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'artikel.php?delete_artikel='+id_artikel;
        });
        confirmModal.modal('show');      
            
    }
</script>

<?php
include_once 'footer.php';
?>