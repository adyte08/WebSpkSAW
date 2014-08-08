<?php
include_once 'header.php';

/*proses tambah artikel*/
include_once 'validasi.php';
if(isset($_POST['submit_news'])){
    $title = $_POST['judul'];
    if (validfile()){
        $title_image = $_FILES['file']['name'];   
    }
    else {
        $title_image = "";
    }
    $date = date('Y-m-d');
    $author = $_SESSION['adminname'];
    $news = $_POST['artikel'];
    $sql = "INSERT INTO artikel VALUES('','$title','$title_image','$author','$news','$date')";
    $result = mysql_query($sql) or die (mysql_error());
    if ($result){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
        echo "<script>window.location.href='artikel.php'</script>";
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal ditambah</p>';
        echo "<script>window.location.href='artikel.php'</script>";
    }
}


if (isset($_GET['edit_artikel'])){
    $id_artikel = $_GET['edit_artikel'];
    $sql2 = "SELECT * FROM `artikel` WHERE `id_artikel`='$id_artikel'";
    $result2 = mysql_query($sql2);
    $data2 = mysql_fetch_assoc($result2);
    if (isset($_POST['update_news'])){
        if (validfile()== TRUE)
            $title_image=$_FILES['file']['name'];
        else  {
            $title_image = $_POST['title_image'];
        }  
        $title = $_POST['judul'];
        $date = date('Y-m-d');
        $author = $_SESSION['adminname'];
        $news = $_POST['artikel'];
        $sql = "UPDATE artikel SET `title`='$title',`title_image`='$title_image',`author`='$author',`artikel`='$news' WHERE `id_artikel`='$id_artikel'";
        $result = mysql_query($sql) or die (mysql_error());
        if ($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil diubah</p>';
            echo "<script>window.location.href='artikel.php'</script>";    
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal diubah</p>';
            echo "<script>window.location.href='artikel.php'</script>";
        }
    }
}
?>


<!--form artikel-->
<?php
if (isset($_GET['edit_artikel'])){
    echo '<form action="form_artikel.php?edit_artikel='.$_GET['edit_artikel'].'" method="POST" class="form-horizontal" enctype="multipart/form-data">';
}
else {
    echo '<form action="form_artikel.php?form_artikel" method="POST" class="form-horizontal" enctype="multipart/form-data">';
}
?>
<div class="control-group">
    <label class="control-label">Judul</label>
    <div class="controls"><input type="text" name="judul" value="<?php echo (!empty($data2))?$data2['title']:'';?>"></div>
</div>
<div class="control-group">
    <label class="control-label">Gambar</label>
    <div class="controls">
        <?php echo (!empty($data2))?'<img src="../img/upload/'.$data2['title_image'].'" width="80px" height="80px"><br>':'';?>
        <input type="hidden" name="title_image" value="<?php echo (!empty($data2))?$data2['title_image']:'';?>">
        <input type="file" name="file">
    </div>
</div>
<div class="control-group">
    <label class="control-label">Artikel</label>
    <div class="controls">
        <textarea name="artikel" id="artikel_textarea" style="width: 500px; height: 200px;">
            <?php echo (!empty($data2))?$data2['artikel']:'';?>
        </textarea>
        <br>
           
            
<?php
if (isset($_GET['edit_artikel'])){
    echo '<button class="btn btn-primary" name="update_news">Ubah</button>';
}
else {
    echo '<button class="btn btn-primary" name="submit_news">Tambah</button>';
}
?>
        <a href="artikel.php" class="btn" style="margin-left: 20px">Kembali</a>
    </div>
</div>
</form>

<script>
        $("#artikel_textarea").wysihtml5();
</script>

<?php
include_once 'footer.php';
?>