<?php
include_once 'header.php';
include_once 'koneksi.php';
?>
<div class="span11">
<h3>Opini</h3>
<hr>
</div>
<!-- ***********************LIST OPINI*************************************** -->
<div class="span11">
    <?php
    if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
    }
    ?>
   <!-- ************************PAGING CONFIGURATION******************************* -->    
    <?php
//    // delete proses
    if (isset($_GET['delete_opini'])){
        $id_opini=$_GET['delete_opini'];
        $sql3 = "DELETE FROM `opini` WHERE `id`='$id_opini'";
        $result3 = mysql_query($sql3);
        if ($result3){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
             echo '<script>window.location.href="opini.php?opini"</script>';
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
             echo '<script>window.location.href="opini.php?opini"</script>';
        }
       
    }
    //approved process
    if(isset($_GET['approved'])){
        $id_opini = $_GET['approved'];
        $sql = "UPDATE opini SET approved = '1' WHERE `id`='$id_opini'";
        $result = mysql_query($sql) or die (mysql_error());
        if ($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil di-approved</p>';
            echo '<script>window.location.href="opini.php?opini"</script>';
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal di-approved</p>';
            echo '<script>window.location.href="opini.php?opini"</script>';
        }

    }
    ///////////////////////////////////////////////////////////////////////////////////////

$limit = 10;
$offset = 0;
/*-------------------PAGING LINK ---------------------------------*/
$sql_page = "SELECT opini.id_hp,opini.approved, opini.opini, opini.username, opini.tanggal, opini.id, spesifikasi.versi_hp 
    FROM opini
    INNER JOIN `spesifikasi` ON opini.id_hp=spesifikasi.ID ";
$result_page = mysql_query($sql_page);
$total_data = mysql_num_rows($result_page);
$total_page = ceil($total_data / $limit);

    if(!empty($total_page)){
    $page = '<div class="pagination pull-right" style="float:none; margin:0 auto"><ul>';
    for($i=1;$i<=$total_page;$i++){
        $page .= '<li><a href="opini.php?opini&page='.$i.'">'.$i.'</a></li>';
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
 <!-- ***********************TABLE OPINI***************************************** -->   
    <table class="table table-bordered">
        <thead><th>Author</th><th>Opini</th><th>Opini terhadap</th></thead>
    <tbody>
    <?php
    $sql = 
    "SELECT opini.id_hp,opini.approved, opini.opini, opini.username, opini.tanggal, opini.id, spesifikasi.versi_hp
    FROM opini
    INNER JOIN `spesifikasi` ON opini.id_hp=spesifikasi.ID
    ORDER BY opini.tanggal DESC LIMIT $offset,$limit";
    $result = mysql_query($sql) or die(mysql_error());    
    while($data = mysql_fetch_assoc($result)){
        echo '<tr>';
        echo '<td>'.$data['username'].'</td>';
           echo '<td><span style="font-size:10px">'.$data['tanggal'].'</span><br><p class="echtul" style="width:550px;">'.$data['opini'].'</p></td>';
            echo '
            <td>'.$data['versi_hp'].'</td>
            <td><a href="#" onclick="delete_confirm('.$data['id'].')">Hapus</a></td><td>';
            if($data['approved']==0){
            echo '<a href="opini.php?approved='.$data['id'].'">Approved</a>';
            }
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
        var id_opini = id;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'opini.php?opini&delete_opini='+id_opini;
        });
        confirmModal.modal('show');      
            
    }
</script>
<?php
    include_once 'footer.php';
    ?>