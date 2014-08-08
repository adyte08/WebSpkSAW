<?php
include_once 'header.php';
include_once 'koneksi.php';

//message
if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
}
    
//tambah kebutuhan
if(isset($_POST['add_kategori'])){

    //tambah kategori
    $kategori = $_POST['kategori'];
    $sql = "INSERT INTO kategori VALUES('','$kategori')";
    $result = mysql_query($sql) or die (mysql_error());
    $id_kategori = mysql_insert_id();

    //tambah atribut
    $atribut = $_POST['atribut'];
    $values = '';
    foreach($atribut as $atr){
            $values .= "('','$id_kategori','$atr'),";
    }
    $values = trim($values, ',');
    $sql2 = "INSERT INTO atribut(`id_atribut`,`id_kategori`,`atribut`) VALUES $values";
    $result2 = mysql_query($sql2);
    if ($result){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
        echo "<script>window.location.href='kebutuhan_atribut.php?kategori=".$id_kategori."'</script>";
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal ditambah</p>';
        echo "<script>window.location.href='form_kebutuhan.php'</script>";
    }
}
/*form kategori*/
?>
<div class="span10">
    <h3>Tambah Kebutuhan</h3>
<form action="" method="POST" >
    <label style="font-weight: bold; margin-right: 20px">Kebutuhan</label>
    <input type="text" name="kategori">
    <hr>
    <label style="font-weight: bold">Atribut</label>
    <?php
    $res = mysql_query("SELECT * FROM kriteria");
    while($data = mysql_fetch_assoc($res)){
        echo '<label class="checkbox"><input type="checkbox" name="atribut[]" value="'.$data['field'].'">'.$data['kriteria'].'</label></td>';
    }
    ?>
    </table>
    <br><br>
    <input type="submit" class="btn btn-primary" name="add_kategori" value="Tambah">
    <a href="kategori.php" class="btn">Kembali</a>
</form>
</div>
<?php
include_once 'footer.php';
?>