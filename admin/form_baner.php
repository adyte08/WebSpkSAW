<?php
include_once 'header.php';
include_once 'koneksi.php';
/*proses tambah artikel*/
include_once 'validasi.php';

//proses tambah baner
if(isset($_POST['submit_baner'])){
    $title = $_POST['judul'];
    if (validfile()){
        $image = $_FILES['file']['name'];
    }
    else {
        $image = "";
    }
    
    $status = $_POST['status'];
    $sql = "INSERT INTO banners VALUES('','$image','$title','$status')";
    $result = mysql_query($sql) or die (mysql_error());
    if ($result){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
        echo "<script>window.location.href='baner.php'</script>";
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal ditambah</p>';
        echo "<script>window.location.href='baner.php'</script>";
    }
}

//ambil data baner yang mau diedit
if (isset($_GET['edit_baner'])){
    $id = $_GET['edit_baner'];
    $sql2 = "SELECT * FROM `banners` WHERE `id_banner`='$id'";
    $result2 = mysql_query($sql2);
    $data2 = mysql_fetch_assoc($result2);
//proses update baner
    if (isset($_POST['update_baner'])){
        echo 'edit baner';
        if (validfile()== TRUE){
            $image=$_FILES['file']['name'];
        }
        else  {
            $image = $_POST['image'];
        }
        $title = $_POST['judul'];
        $status = $_POST['status'];
        $sql = "UPDATE banners SET `image`='$image',`title`='$title',`status`='$status' WHERE `id_banner`='$id'";
        $result = mysql_query($sql) or die (mysql_error());
        if ($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil diubah</p>';
            echo "<script>window.location.href='baner.php'</script>";
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal diubah</p>';
            echo "<script>window.location.href='baner.php'</script>";
        }
    }
}
?>

<?php
if (isset($_GET['edit_baner'])){
    echo '<form action="form_baner.php?edit_baner='.$_GET['edit_baner'].'" method="POST" class="form-horizontal" enctype="multipart/form-data">';
}
else {
    echo '<form action="form_baner.php?add_baner" method="POST" class="form-horizontal" enctype="multipart/form-data">';
}
?>

<div class="control-group">
    <label class="control-label">Banner</label>
    <div class="controls">
        <?php echo (!empty($data2))?'<img src="../img/upload/'.$data2['image'].'" width="80px" height="80px"><br>':'';?>
        <input type="hidden" name="image" value="<?php echo (!empty($data2))?$data2['image']:'';?>">
        <input type="file" name="file">
    </div>
</div>
<div class="control-group">
    <label class="control-label">Judul</label>
    <div class="controls"><input type="text" name="judul" value="<?php echo (!empty($data2))?$data2['title']:'';?>"></div>
</div>

<div class="control-group">
    <label class="control-label">Status</label>
    <div class="controls">
        <select name="status">
            <option value="active" <?php echo (!empty($data2))?($data2['status']=='active'?'selected':''):'';?>>Aktif</option>
            <option value="non-active"<?php echo (!empty($data2))?($data2['status']=='non-active'?'selected':''):'';?>>Tidak Aktif</option>
        </select>
        <br>
        <br><br>
            <?php
            if (isset($_GET['edit_baner'])){
                echo '<button class="btn btn-primary" name="update_baner">Ubah</button>';
            }
            else {
                echo '<button class="btn btn-primary" name="submit_baner">Tambah</button>';
            }
            ?>
        <a href="baner.php" class="btn" style="margin-left: 20px">Kembali</a>
    </div>
</div>
</form>

<?php
include_once 'footer.php';
?>