<?php
include_once 'header.php';

/*--------------------Proses edit merek-------------------------------------------*/
if(isset($_POST['edit_mrk'])){
    $nama = $_POST['editmerek'];
    $id = $_POST['id'];
    $sql = "UPDATE merek_hp SET `nama_merek`='$nama' WHERE `id` = '$id'";
    mysql_query($sql) or die(mysql_error);
    echo '<script>window.location.href="mobile.php"</script>';
}
else{
$sql = 'SELECT * FROM merek_hp';
$result = mysql_query($sql);
?>
<div class="span3">
    <table class="table table-bordered">
        <thead>
        <th colspan="3"><center>Merek</center></th>
        <tbody>
            <tr><td colspan="3"><center><a class="btn" href="addnew_merek.php">Tambah Merek</a></center></td></tr>
                <?php
                while($data = mysql_fetch_object($result)){
                    if($_GET['id'] == $data->id){                    
                ?>
                    <form action="edit_merek.php" method="POST" class="form-horizontal">
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                                <input type="text" name="editmerek" value="<?php echo $data->nama_merek; ?>" class="input-small">
                            </td>
                            <td>
                                <button class="btn btn-primary" type="submit" name="edit_mrk" style="font-size: 10px; padding: 4px 3px;">Simpan</button>
                            </td>
                            <td>
                                <a class="btn" href="?hp" style="font-size: 10px; padding: 4px 3px;">Batal</a>
                            </td>
                        </tr>
                    </form>
<?php
                    }
                    else{
                        echo '<tr><td><a href="mobile.php?merek='.$data->nama_merek.'">'.$data->nama_merek.'</a></td>
                        <td><a href="edit_merek.php?id='.$data->id.'"><i class="icon-pencil"></i></a></td>
                         <td><a href="#" onclick="delete_confirm(\''.$data->id.'\')"><i class="icon-trash"></i></a></td></tr>';
                    }
                }
}
?>
    </table>
</div>

<?php
include_once 'footer.php';
?>