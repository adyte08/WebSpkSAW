<?php
include_once 'header.php';
include_once 'koneksi.php';
?>
<div class="span11">
<h3>Pengguna</h3>
<hr>
</div>
<!-- ***********************LIST USER*************************************** -->
<div class="span11">
    <?php
    if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
    }
    if ($_SESSION['hak_akses']=='admin'){
        $where=1;
    echo '<a class="btn" href="form_user.php">Tambah Pengguna</a>';
    }
    else {
        $where="`Hak_Akses`='editor'";
    }
// ************************PAGING CONFIGURATION******************************* -->    
    
//    // delete proses
    if (isset($_GET['delete_user'])){
        $id_user=$_GET['delete_user'];
        $sql3 = "DELETE FROM `users` WHERE `ID`='$id_user'";
        $result3 = mysql_query($sql3);
        if ($result3){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
             echo '<script>window.location.href="user.php"</script>';
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
             echo '<script>window.location.href="user.php"</script>';
        }
       
    }
/*---------------------IF ARCHIVE SELECTED-------------------------*/

$limit = 10;
/*-------------------PAGING LINK ---------------------------------*/
$sql_page = "SELECT * FROM users WHERE ".$where;
$result_page = mysql_query($sql_page);
$total_data = mysql_num_rows($result_page);
$total_page = ceil($total_data / $limit);

    if(!empty($total_page)){

    $page = '<div class="pagination"><ul>';
    for($i=1;$i<=$total_page;$i++){
        $page .= '<li><a href="user.php?page='.$i.'">'.$i.'</a></li>';
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
 <!-- ***********************TABLE ARTIKEL***************************************** -->   
    <table class="table table-bordered">
        <thead><th>Nama Pengguna</th><th>Hak Akses</th><th colspan="2">Kelola</th></thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM users WHERE ".$where." ORDER BY `Username` ASC LIMIT $offset,$limit";
    $result = mysql_query($sql) or die(mysql_error());    
    while($data = mysql_fetch_assoc($result)){
        echo '<tr>
            <td>'.$data['Username'].'</td>
            <td>'.$data['Hak_Akses'].'</td>
            <td><a href="form_user.php?edit_user='.$data['ID'].'">Ubah</a></td>
            <td><a href="#" onclick="delete_confirm('.$data['ID'].')">Hapus</a></td>
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

    function delete_confirm(id){
        var id_user = id;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'user.php?delete_user='+id_user;
        });
        confirmModal.modal('show');      
            
    }
</script>

<?php
include_once 'footer.php'
?>