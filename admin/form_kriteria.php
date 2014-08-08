<?php
include_once 'header.php';
include_once 'koneksi.php';

//message
if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
}
 
$errors = array();
//tambah kriteria
if(isset($_POST['add_kriteria'])){

    //tambah kriteria_add
    $kriteria = $_POST['kriteria'];
    $field = $_POST['field'];
    $type = $_POST['type'];
    $value = $_POST['value'];
    
    //cek field sudah dipakai belom
    $sql_field = "SELECT field FROM kriteria WHERE field='$field'";
    $res_field = mysql_query($sql_field);
    $cek_field = mysql_num_rows($res_field);
    //validasi form
    if(empty($kriteria)){
        $errors['kriteria'] = "Kriteria tidak boleh kosong";
    }
    if(empty($field)){
        $errors['field']="Field tidak boleh kosong";
    }
    if($cek_field > 0){
        $errors['field'] = "Field sudah dipakai";
    }
    if(empty($type)){
        $errors['type'] = "Type tidak boleh kosong";
    }
    if(empty($value)){
        $errors['value'] = "Value tidak boleh kosong";
    }
    if(empty($errors)){
        $type_value = $type.'('.$value.')';
        $sql = "INSERT INTO kriteria VALUES('','$kriteria','$field','$type_value')";
        $result = mysql_query($sql) or die (mysql_error());
        $id_kriteria = mysql_insert_id();
    
    //tambah kolom di hp
    $sql_add_col = "ALTER TABLE `skala` ADD $field $type_value ";
    $result2 = mysql_query($sql_add_col);
    if ($result && $result2){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
        echo "<script>window.location.href='kriteria_atribut.php?kriteria=".$id_kriteria."'</script>";
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal ditambah</p>';
        echo "<script>window.location.href='form_kriteria.php'</script>";
    }
}
}
//ambil data kriteria untuk di edit
if(isset($_GET['edit'])){
    $id_kriteria = $_GET['edit'];
    $sql = "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'";
    $result = mysql_query($sql);
    $data_edit = mysql_fetch_assoc($result);
    $split = explode("(", $data_edit['type']);
    $type = $split[0];
    $value = trim($split[1],')');
}
//update data kriteria yang sudah diubah
if(isset($_POST['edit_kriteria'])){
    $id_kriteria = $_POST['id_kriteria'];
    $kriteria = $_POST['kriteria'];
    $field = $_POST['field'];
    $field_ori = $_POST['field_ori'];
    $type = $_POST['type'];
    $value = $_POST['value'];
    $type_value = $type."(".$value.")";
    //validasi form
    if(empty($kriteria)){
        $errors['kriteria'] = "Kriteria tidak boleh kosong";
    }
    if(empty($field)){
        $errors['field']="Field tidak boleh kosong";
    }
    
    if(empty($type)){
        $errors['type'] = "Type tidak boleh kosong";
    }
    if(empty($value)){
        $errors['value'] = "Value tidak boleh kosong";
    }
    if(empty($errors)){
 
    $sql = "UPDATE kriteria SET kriteria='$kriteria', field='$field', type='$type_value' WHERE id_kriteria='$id_kriteria'";
    $result = mysql_query($sql);
    
    $sql2 = "ALTER TABLE skala CHANGE $field_ori $field $type_value";
    $result2 = mysql_query($sql2);
    
    if($result && $result2){
     $_SESSION['message']='<p class="alert alert-success">Data berhasil diubah</p>';
     echo "<script>window.location.href='kriteria.php'</script>";
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal diubah</p>';
        echo "<script>window.location.href='form_kriteria.php'</script>";
    }
}
}
/*form kategori*/
?>
<div class="span10">
    <?php
    if(isset($_GET['add'])){?>
    <h3>Tambah Kriteria</h3>
    <?php 
   }
   else { ?>
     <h3>Ubah Kriteria</h3>  
   <?php } ?>
    
<form action="" method="POST" >
    <label style="font-weight: bold; margin-right: 20px">Kriteria</label>
    <input type="text" name="kriteria" value="<?php echo (empty($data_edit)?(empty($kriteria)?'':$kriteria):$data_edit['kriteria'])?>">
    <?php echo (empty($errors['kriteria']))?'':$errors['kriteria']; ?>
    <label style="font-weight: bold">Field</label>
    <select name="field">
        <option value="">-Pilih-</option>
    <?php //get all column from spesifikasi 
    $result = mysql_query("DESCRIBE spesifikasi");
    while($data=  mysql_fetch_assoc($result)){
        echo '<option value="'.$data['Field'].'" '.(empty($data_edit)?(empty($field)?'':($data['Field']==$field?'selected':'')):($data_edit['field']==$data['Field'] ? 'selected':'')).'>'.$data['Field'].'</option>';
    }
    ?>
    </select>
    <?php echo (empty($errors['field']))?'':$errors['field']; ?>
    <input type="hidden" name="id_kriteria" value="<?php echo empty($data_edit)?'':$data_edit['id_kriteria']?>">
    <input type="hidden" name="field_ori" value="<?php echo empty($data_edit)?'':$data_edit['field']?>">
    <label style="font-weight: bold">Type</label>
    <select name="type">
        <option value="">-Pilih-</option>
        <option value="int" <?php echo empty($type)?'':($type=='int'?'selected':'')?>>INT</option>
        <option value="varchar" <?php echo empty($type)?'':($type=='varchar'?'selected':'')?>>VARCHAR</option>
    </select>
    <?php echo (empty($errors['type']))?'':$errors['type']; ?>
    <label style="font-weight: bold">Value</label>
    <input type="text" name="value" value="<?php echo empty($value)?'':$value ?>">
    <?php echo (empty($errors['value']))?'':$errors['value']; ?>
    <br><br>
    <?php if(isset($_GET['edit'])){
        echo '<input type="submit" class="btn btn-primary" name="edit_kriteria" value="Ubah">';
    }else{
    ?>
    <input type="submit" class="btn btn-primary" name="add_kriteria" value="Tambah">
    <?php } ?>
    <a href="kriteria.php" class="btn">Kembali</a>
</form>
</div>
<?php
include_once 'footer.php';
?>