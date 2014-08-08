<?php
include_once 'header.php';
include_once 'koneksi.php';
?>

<!-- ***********************LIST KATEGORI*************************************** -->
<div class="span11">
    <h3>Kebutuhan</h3>
    <hr>
</div>
<div class="span11">
    <?php
    if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
    }
	?>
    <a class="btn" href="form_kebutuhan.php">Tambah Kebutuhan</a>
    
<?php
// ************************PAGING CONFIGURATION******************************* -->    
    
//    // delete proses
    if (isset($_GET['delete_kategori'])){
        $id_kategori=$_GET['delete_kategori'];
        $sql3 = "DELETE FROM kategori WHERE id_kategori = '$id_kategori' ";
        $result3 = mysql_query($sql3);
        $sql4 = "DELETE FROM atribut WHERE id_kategori = '$id_kategori' ";
        $result4 = mysql_query($sql4);
        if ($result3 && $result4){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
             echo '<script>window.location.href="kebutuhan.php"</script>';
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
             echo '<script>window.location.href="kebutuhan.php"</script>';
        }
       
    }

    ?>
 <!-- ***********************TABLE Kategori***************************************** -->   
    <table class="table table-bordered">
        <thead><th>Nomor</th><th>Kebutuhan</th><th colspan="2">Kelola</th></thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM kategori";
    $result = mysql_query($sql) or die(mysql_error());  
    $j = 0;
    $i = 1;
    while($data = mysql_fetch_array($result)){
        echo '<tr>
            <td>'.$i.'</td>
            <td>'.$data['nama_kategori'].'</td>
            <td><a href="kebutuhan_atribut.php?kategori='.$data['id_kategori'].'">Detil Atribut</a></td>
            <td><a href="#" onclick="delete_confirm('.$data['id_kategori'].')">Hapus</a></td>
            </tr>';
        $i++;
      
    }
    ?>
    </tbody>
    </table>
</div>

<script>

    function delete_confirm(id){
        var id_kategori = id;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'kebutuhan.php?delete_kategori='+id_kategori;
        });
        confirmModal.modal('show');      
            
    }
</script>

<?php
include_once 'footer.php'
?>