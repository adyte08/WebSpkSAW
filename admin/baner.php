<?php
include_once 'header.php';
?>

<div class="span11">
    <h3>Banner</h3>
    <hr>
</div>

<!-- ***********************LIST BANNER*************************************** -->
<div class="span11">
    <?php
    if (isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset ($_SESSION['message']);
    }

// delete proses
if (isset($_GET['delete_baner'])){
    $id_banner=$_GET['delete_baner'];
    $sql3 = "DELETE FROM `banners` WHERE `id_banner`='$id_banner'";
    $result3 = mysql_query($sql3);
    if ($result3){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
        echo '<script>window.location.href="baner.php"</script>';
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
        echo '<script>window.location.href="baner.php"</script>';
    }
}

//change status process
if(isset($_GET['status'])){
    $status = $_GET['status'];
    $id = $_GET['id'];
    $sql = "UPDATE banners SET status = '$status' WHERE `id_banner`='$id'";
    $result = mysql_query($sql) or die (mysql_error());
    if ($result){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil diubah</p>';
        echo '<script>window.location.href="baner.php"</script>';
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal diubah</p>';
        echo '<script>window.location.href="baner.php"</script>';
    }
}

echo '<a href="form_baner.php" class="btn">Tambah Banner</a>';

    ///////////////////////////////////////////////////////////////////////////////////////

$limit = 10;
$offset = 0;
/*-------------------PAGING LINK ---------------------------------*/
$sql_page = "SELECT * FROM banners";
$result_page = mysql_query($sql_page);
$total_data = mysql_num_rows($result_page);
$total_page = ceil($total_data / $limit);
if(!empty($total_page)){
    $page = '<div class="pagination pull-right" style="float:none; margin:0 auto"><ul>';
    for($i=1;$i<=$total_page;$i++){
        $page .= '<li><a href="baner.php?page='.$i.'">'.$i.'</a></li>';
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
   
 <!-- ***********************TABLE OPINI***************************************** -->
    <table class="table table-bordered">
        <thead><th>Gambar</th><th>Judul</th><th>Status</th><th colspan="3">Kelola</th></thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM banners ORDER BY id_banner DESC LIMIT $offset,$limit";
    $result = mysql_query($sql) or die(mysql_error());
    while($data = mysql_fetch_assoc($result)){
        echo '<tr>';
        echo '<td><img src="../img/upload/'.$data['image'].'" width="80px" height="80px"></td>';
        echo '<td>'.$data['title'].'</td>';
        echo '<td>'.$data['status'].'</td>';
        if($data['status'] == 'active'){
            $status = 'non-active';
        }
        else{
            $status = 'active';
        }
        echo '<td><a href="form_baner.php?edit_baner='.$data['id_banner'].'">Ubah</a></td><td>';
        echo '<a href="#" onclick="delete_confirm('.$data['id_banner'].')">Hapus</a>';
        echo '</td></tr>';
    }
    ?>
    </tbody>
    </table>
 
        <?php
        echo '<div style="width:100%; text-align:center;float:left">'.$page.'</div>';
        ?>
</div>


<script>
    function delete_confirm(id){
        
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'baner.php?delete_baner='+id;
        });
        confirmModal.modal('show');

    }
</script>

    <?php
    include_once 'footer.php';
    ?>