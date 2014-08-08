<?php
include_once 'header.php';

//ambil nama kategori
$id_kategori = $_GET['kategori'];
$sql = "SELECT nama_kategori FROM kategori WHERE id_kategori = '$id_kategori'";
$result = mysql_query($sql);
$data = mysql_fetch_assoc($result);
//ambil atribut
$query = "SELECT * FROM atribut WHERE id_kategori='$id_kategori'";
$result2 = mysql_query($query);
$atr = array();
$skala = array();
while($data2 = mysql_fetch_array($result2)){
    $atr[] = $data2['atribut'];
    $skala[$data2['atribut']] = $data2['skala'];
    
}

//message success/error
if(isset($_SESSION['message'])){
    $message =  $_SESSION['message'];
    unset($_SESSION['message']);

}

//proses tambah skala
if(isset($_POST['add_skala'])){
    foreach($atr as $a){
    $sql = "UPDATE `atribut` SET `skala`='".$_POST[$a]."' WHERE `id_kategori` = '$id_kategori' AND `atribut`='$a' ";
    mysql_query($sql);
    }
    //redirect to kategori
    $_SESSION['message']='<p class="alert alert-success">Data berhasil ditambah</p>';
    echo '<script>window.location.href="kebutuhan_atribut.php?kategori='.$id_kategori.'"</script>';
}

?>
<div class="span10">
    <h3>Atribut Kebutuhan <?php echo ucfirst($data['nama_kategori'])?></h3><hr>
<form action="kebutuhan.php?kategori=<?php echo $id_kategori?>" method="POST">
    <table class="table table-bordered">
        <thead> <th> Atribut </th>
        <th>Nilai</th>
    </thead>
    <tbody>
        <?php
        $res = mysql_query("SELECT * FROM atribut WHERE id_kategori='$id_kategori'");
        while($dat_kategori = mysql_fetch_assoc($res)){
            $res2 = mysql_query("SELECT * FROM kriteria WHERE field='".$dat_kategori['atribut']."'");
            $dat_kriteria = mysql_fetch_assoc($res2);
        ?>
        <tr><td><?php echo $dat_kriteria['kriteria']?></td>
            <td> <select name="<?php echo $dat_kriteria['field']?>"><option value="NULL">Pilih</option>
                    <?php 
                    $res3 = mysql_query("SELECT * FROM kriteria_atribut WHERE id_kriteria = '".$dat_kriteria['id_kriteria']."'");
                    while($dat_atr = mysql_fetch_assoc($res3)){
                        echo '<option value="'.$dat_atr['bobot'].'" '.($dat_kategori['skala']==$dat_atr['bobot']? 'selected':'').' >'.$dat_atr['atribut'].'</option>';

                    }
                    ?>
                   
                </select></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <input type="submit" name="add_skala" class="btn btn-primary" value="Simpan">
    <a href="kategori.php" class="btn" style="margin-left: 20px">Kembali</a>
</form>
</div>

<?php
include_once 'footer.php';
?>