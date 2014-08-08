<?php
include_once 'header.php';

/*proses tambah user*/
if(isset($_POST['submit_user'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO users VALUES('','$username','$password','editor')";
    $result = mysql_query($sql) or die (mysql_error());
    if ($result){
        $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
        echo "<script>window.location.href='user.php'</script>";
    }
    else {
        $_SESSION['message']='<p class="alert alert-error">Data gagal ditambah</p>';
        echo "<script>window.location.href='user.php'</script>";
    }
}

if (isset($_GET['edit_user'])){
    $id_user = $_GET['edit_user'];
    $sql2 = "SELECT * FROM `users` WHERE `ID`='$id_user'";
    $result2 = mysql_query($sql2);
    $data2 = mysql_fetch_assoc($result2);
    if (isset($_POST['update_user'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "UPDATE users SET `Username`='$username',`Password`='$password' WHERE `ID`='$id_user'";
        $result = mysql_query($sql) or die (mysql_error());
        if ($result){
            $_SESSION['message']='<p class="alert alert-success">Data berhasil diubah</p>';
            echo "<script>window.location.href='user.php'</script>";
        }
        else {
            $_SESSION['message']='<p class="alert alert-error">Data gagal diubah</p>';
            echo "<script>window.location.href='user.php'</script>";
        }
    }
}
?>


<!--form user-->
<div class="span10">
    <?php
    if(isset($_GET['edit_user'])){?>
    <h3>Ubah Pengguna</h3>
    <?php 
   }
   else { ?>
     <h3>Tambah Pengguna</h3>  
   <?php } ?>
<?php
if (isset($_GET['edit_user'])){
    echo '<form action="form_user.php?edit_user='.$_GET['edit_user'].'" method="POST" class="form-horizontal">';
}
else {
    echo '<form action="form_user.php" method="POST" class="form-horizontal" >';
}
?>

<div class="control-group">
    <label class="control-label">Nama Pengguna</label>
    <div class="controls"><input type="text" name="username" value="<?php echo (!empty($data2))?$data2['Username']:'';?>"></div>
</div>
<?php if ($_SESSION['hak_akses'] == "admin"){ ?>
<div class=""control-group">
     <label class="control-label">Kata Sandi</label>
    <div class="controls"><input type="text" name="password"></div>
</div>
<br>
<?php } ?>

<div class="control-group">
    <div class="controls">
           <?php
            if (isset($_GET['edit_user'])){
                echo '<button class="btn btn-primary" name="update_user">Ubah</button>';
            }
            else {
                echo '<button class="btn btn-primary" name="submit_user">Tambah</button>';
            }
            ?>
        <a href="user.php" button class="btn">Kembali</a>
    </div>
</div>
</form>

<?php
include_once 'footer.php';
?>