<?php
//pemanggilan koneksi.php
include_once 'header.php';
include_once 'koneksi.php';
?><!DOCTYPE html>

<div class="span10">
    <?php
    //ambil atribut brdsrkan nama kategori
    $skala = array();
    if(isset($_GET['kebutuhan'])){
        $id_kategori = $_GET['kebutuhan'];
//ambil atribut
    $query = "SELECT * FROM atribut WHERE id_kategori='$id_kategori'";
    $result2 = mysql_query($query);
    while($data2 = mysql_fetch_array($result2)){
        $skala[$data2['atribut']] = $data2['skala']; 
    }
    }
    ?>
                
<h3>Pemilihan Handphone Android</h3><hr>
<h6>Pilihlah kriteria handphone yang kamu inginkan pada form dibawah ini.</h6>
<form action="hasil_spk.php" method="POST" class="form-inline">
    <label><strong>Kebutuhan</strong></label>
    <select name="kebutuhan" style="margin-left: 280px" onchange="window.location = 'spk.php?kebutuhan='+this.options[this.selectedIndex].value">
        <?php
        $sql = "SELECT * FROM kategori";
        $result = mysql_query($sql);
        echo '<option value="">Pilih</option>';
        while($data = mysql_fetch_assoc($result)){
            echo '<option value="'.$data['id_kategori'].'" '.
            (isset($_GET['kebutuhan'])?($_GET['kebutuhan']==$data['id_kategori']?'selected':''):'').'>'
            .$data['nama_kategori'].'</option>';
        }
        ?>
    </select>
    <br><br>
    <table class="table table-bordered">
        <thead> <th> Kategori </th>
        <th>Nilai</th>
       
    </thead>
    <tbody>
        <tr>
            <td>Merek</td>
            <td>
                <select name="merek">
                    <option value="0">Pilih</option>
            <?php
            $resmerek = mysql_query("SELECT * FROM merek_hp");
            while($datmerek = mysql_fetch_assoc($resmerek)){
                echo '<option value="'.$datmerek['nama_merek'].'">'.$datmerek['nama_merek'].'</option>';
            }
            ?>
                </select>
            </td>
        </tr>
        <?php 
        $res = mysql_query("SELECT * FROM kriteria");
        while($data1 = mysql_fetch_assoc($res)){
        ?>
        <tr> <td><?php echo $data1['kriteria']?> </td>
            <td> <select name="<?php echo $data1['field']?>"><option value="0">Pilih</option>
                 <?php 
                 $res2 = mysql_query("SELECT * FROM kriteria_atribut WHERE id_kriteria = '".$data1['id_kriteria']."'");
                 while($data2 = mysql_fetch_assoc($res2)){
                     echo '<option value="'.$data2['bobot'].'" '. (isset($skala[$data1['field']])?($skala[$data1['field']]==$data2['bobot']? 'selected':''):'').' >'.$data2['atribut'].'</option>';
                 }
                 ?>
                 </select></td>
                
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <button type="submit" name="hitung" class="btn btn-primary"> Cari </button>
</form>
</div>
<?php
include_once 'footer.php';
?>