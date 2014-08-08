<?php
include_once 'header.php';
include_once 'koneksi.php';
?>

<div class="span11">
    <h3>Kriteria Atribut</h3>
    <hr>
</div>
<!-- ***********************LIST KRITERIA*************************************** -->
<div class="span11">
    <?php
    if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
    }
    if ($_SESSION['hak_akses']=='admin'){
        $where=1;
    echo '<a class="btn" href="form_kriteria.php?add">Tambah Kriteria</a>';
    }
    else {
        $where="`Hak_Akses`='editor'";
    }
// ************************PAGING CONFIGURATION******************************* -->    
    
//    // delete proses
    if (isset($_GET['delete_kriteria'])){
        $id_kriteria=$_GET['delete_kriteria'];
        $field = $_GET['field'];
        $sql3 = 'ALTER TABLE `skala` DROP `'.$field.'`';
        $result3 = mysql_query($sql3);
        $sql4 = "DELETE FROM kriteria WHERE id_kriteria = '$id_kriteria' ";
        $result4 = mysql_query($sql4);
        $sql5 = "DELETE FROM kriteria_atribut WHERE id_kriteria = '$id_kriteria' ";
        $result5 = mysql_query($sql5);
//if ($result3 && $result4){
        if ($result4){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
             echo '<script>window.location.href="kriteria.php"</script>';
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
             echo '<script>window.location.href="kriteria.php"</script>';
        }
       
    }

    ?>
 <!-- ***********************TABLE KRITERIA***************************************** -->   
    <table class="table table-bordered">
        <thead><th>Nomor</th><th>Kriteria</th><th>Field</th><th>Type</th><th colspan="3">Kelola</th></thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM kriteria";
    $result = mysql_query($sql) or die(mysql_error());  
    $j = 0;
    $i = 1;
    while($data = mysql_fetch_array($result)){
        echo '<tr>
            <td>'.$i.'</td>
            <td>'.$data['kriteria'].'</td>
            <td>'.$data['field'].'</td>
            <td>'.$data['type'].'</td>
            <td><a href="kriteria_atribut.php?kriteria='.$data['id_kriteria'].'">Detail Atribut</a></td>
            <td><a href="form_kriteria.php?edit='.$data['id_kriteria'].'">Ubah</a></td>
            <td><a href="#" onclick="delete_confirm('.$data['id_kriteria'].',\''.$data['field'].'\')">Hapus</a></td>
            </tr>';
        $i++;
      
    }
    ?>
    </tbody>
    </table>
</div>

<script>

    function delete_confirm(id,field){
        var id_kategori = id;
        var field_name = field;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'kriteria.php?delete_kriteria='+id_kategori+'&field='+field_name;
        });
        confirmModal.modal('show');      
            
    }
</script>

<?php
include_once 'footer.php'
?>