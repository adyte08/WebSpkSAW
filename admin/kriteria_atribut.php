<?php
include_once 'header.php';
include_once 'koneksi.php';
?>

<!-- ***********************LIST ATRIBUT*************************************** -->

<div class="span11">
    <?php
    if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
    }
$errors = array();
// ************************PAGING CONFIGURATION******************************* -->    
    
    // delete proses
    if (isset($_GET['delete_atribut'])){
        $id_kriteria=$_GET['kriteria'];
        $id_atribut=$_GET['atribut'];
        $sql = "DELETE FROM kriteria_atribut WHERE id_atribut = '$id_atribut' ";
        $result = mysql_query($sql);
        if ($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil dihapus</p>';
             echo '<script>window.location.href="kriteria_atribut.php?kriteria='.$id_kriteria.'"</script>';
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal dihapus</p>';
             echo '<script>window.location.href="kriteria_atribut.php?kriteria='.$id_kriteria.'"</script>';
        }
       
    }
    
    //add proses
    if(isset($_POST['add_atribut'])){
        $id_kriteria = $_POST['id_kriteria'];
        $atribut = $_POST['atribut'];
        $bobot = $_POST['bobot'];
        $rumus = $_POST['rumus'];
        //validasi form
    if(empty($atribut)){
        $errors['atribut'] = "Atribut tidak boleh kosong";
    }
    if(empty($bobot)){
        $errors['bobot']="Bobot tidak boleh kosong";
    }
   
    if(empty($rumus)){
        $errors['rumus'] = "Rumus tidak boleh kosong";
    }
    
    if(empty($errors)){
        $sql = "INSERT INTO kriteria_atribut VALUES('','$id_kriteria','$atribut','$rumus','$bobot')";
        $result = mysql_query($sql);
        if($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
            echo "<script>window.location.href='kriteria_atribut.php?kriteria=$id_kriteria'</script>";
        }
        else{
            $_SESSION['message']='<p class="alert alert-error">Data gagal ditambah</p>';
            
            echo "<script>window.location.href='kriteria_atribut.php?kriteria=$id_kriteria'</script>";
        }
    }
    }
    //get atribut data to edit
    if(isset($_GET['edit_atribut'])){
        $id_atribut = $_GET['edit_atribut'];
        
        $sql = "SELECT * FROM kriteria_atribut WHERE id_atribut = '$id_atribut'";
        $result = mysql_query($sql);
        $data_atribut = mysql_fetch_assoc($result);
    }
    //update atribut data
    if(isset($_POST['edit_atribut'])){
        $id_kriteria = $_POST['id_kriteria'];
        $id_atribut = $_POST['id_atribut'];
        $atribut = $_POST['atribut'];
        $rumus = $_POST['rumus'];
        $bobot = $_POST['bobot'];
        //validasi form
    if(empty($atribut)){
        $errors['atribut'] = "Atribut tidak boleh kosong";
    }
    if(empty($bobot)){
        $errors['$bobot']="Bobot tidak boleh kosong";
    }
   
    if(empty($rumus)){
        $errors['$rumus'] = "Rumus tidak boleh kosong";
    }
    
    if(empty($errors)){
        $sql = "UPDATE kriteria_atribut SET atribut='$atribut', rumus='$rumus',bobot='$bobot' WHERE id_atribut='$id_atribut'";
        $result = mysql_query($sql);
        if($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil diubah</p>';
            echo "<script>window.location.href='kriteria_atribut.php?kriteria=$id_kriteria'</script>";
        }
        else{
            $_SESSION['message']='<p class="alert alert-error">Data gagal diubah</p>';
            
            echo "<script>window.location.href='kriteria_atribut.php?kriteria=$id_kriteria'</script>";
        }
    }
    }
    //get kriteria and attribute data
    $kriteria = $_GET['kriteria'];
    $sql_kriteria = "SELECT * FROM kriteria WHERE id_kriteria='$kriteria'";
    $result_kriteria = mysql_query($sql_kriteria);
    $data_kriteria = mysql_fetch_assoc($result_kriteria);
    ?>
    <div></div>
    <h3>Kriteria : <?php echo  $data_kriteria['kriteria']?></h3>
    <form action="" method="POST" class="form-inline">
        <label style="width:80px">Atribut</label>
        <input type="hidden" name="id_kriteria" value="<?php echo $kriteria?>">
        <input type="hidden" name="id_atribut" value="<?php echo empty($data_atribut)?'':$data_atribut['id_atribut']?>">
        <input type="text" name="atribut" value="<?php echo empty($data_atribut)?'':$data_atribut['atribut']?>"> (cth: < Rp.100.000) 
        <?php echo (empty($errors['atribut']))?'':$errors['atribut']; ?><br><br>
        <label style="width: 80px">Rumus</label>
        <input type="text" name="rumus" value="<?php echo empty($data_atribut)?'':$data_atribut['rumus']?>"> (cth: x < 100000)
        <?php echo (empty($errors['rumus']))?'':$errors['rumus']; ?>
        <br><br>
        <label style="width: 80px">Bobot</label>
        <input type="text" name="bobot" value="<?php echo empty($data_atribut)?'':$data_atribut['bobot']?>"> (range : 1-8)
        <?php echo (empty($errors['bobot']))?'':$errors['bobot']; ?>
        <br><br>
        <?php if(isset($_GET['edit_atribut'])){?>
        <input type="submit" name="edit_atribut" value="Ubah Atribut" class="btn btn-primary">
        <?php } else{ ?>
        <input type="submit" name="add_atribut" value="Tambah Atribut" class="btn btn-primary">
        <?php } ?>
        <a class="btn" href="kriteria.php">Kembali</a>
    </form>
 <!-- ***********************TABLE ATRIBUT***************************************** -->   
    <table class="table table-bordered">
        <thead><th>Nomor</th><th>Atribut</th><th>Rumus</th><th>Bobot</th><th colspan="2">Kelola</th></thead>
    <tbody>
    <?php
    $sql_atribut = "SELECT * FROM kriteria_atribut WHERE id_kriteria='$kriteria'";
    $result_atribut = mysql_query($sql_atribut) or die(mysql_error());  
    $j = 0;
    $i = 1;
    while($data = mysql_fetch_array($result_atribut)){
        echo '<tr>
            <td>'.$i.'</td>
            <td>'.$data['atribut'].'</td>
            <td>'.$data['rumus'].'</td>
            <td>'.$data['bobot'].'</td>
            <td><a href="kriteria_atribut.php?kriteria='.$data['id_kriteria'].'&edit_atribut='.$data['id_atribut'].'">Ubah</a></td>
            <td><a href="#" onclick="delete_confirm('.$data['id_kriteria'].','.$data['id_atribut'].')">Hapus</a></td>
            </tr>';
        $i++;
      
    }
    ?>
    </tbody>
    </table>
</div>

<script>

    function delete_confirm(id1, id2){
        var id_kriteria = id1;
        var id_atribut = id2;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'kriteria_atribut.php?delete_atribut&kriteria='+id_kriteria+'&atribut='+id_atribut;
        });
        confirmModal.modal('show');      
            
    }
</script>

<?php
include_once 'footer.php'
?>