<?php
include_once 'header.php';

/*---------- Proses add new merek --------------------------------*/
if(isset($_POST['add_merek'])){
    $nama = $_POST['merek'];
    $sql = "INSERT INTO merek_hp VALUES('','$nama')";
    mysql_query($sql) or die(mysql_error);
    echo '<script>window.location.href="mobile.php"</script>';
}
?>

<div class="span3"><table class="table table-bordered">
        <thead>
        <th colspan="3"><center>Merek</center></th>
        <tbody>
            <tr><td colspan="3">
        <center>
            <form action="?hp&add_merek=merek" method="POST">
                <input type="text" name="merek" placeholder="Tambah merek..." class="input-medium"> <br>
                <button class="btn btn-primary" type="submit" name="add_merek" style="padding:5px 4px;">Simpan</button>
                <a class="btn" href="?hp" style="padding: 5px 4px;">Batal</a>
            </form>
        </center>
        </td></tr>
            <?php  
            $sql="SELECT * FROM `merek_hp`";
            $result=  mysql_query($sql);
            while($data = mysql_fetch_object($result)){
                echo '<tr> <td> <a href="mobile.php?merek='.$data->nama_merek.'">'.$data->nama_merek.'</a></td>
                    <td><a href="edit_merek.php?id='.$data->id.'"><i class="icon-pencil"></i></a></td>
                        <td><a href="#" onclick="delete_confirm(\''.$data->id.'\')"><i class="icon-trash"></i></a></td></tr>';
            }
            ?> 
        </tbody>
    </table>
</div>

<?php
include_once 'footer.php';
?>
    
