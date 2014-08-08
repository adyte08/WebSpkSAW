<?php
include_once 'koneksi.php';
include_once 'header.php';
include_once 'hitung_spk.php';
?>

<div class="span10">
    <h3>Hasil Rekomendasi Pemilihan Handphone Android</h3><hr>
<form action="compare.php?compare" method="POST" class="form-inline pull-right">
<input type="text" name="compare1" id="compare1" autocomplete="off" placeholder="Handphone 1...">
<input type="text" name="compare2" id="compare2" autocomplete="off" placeholder="Handphone 2...">
<button class="btn btn primary" name="banding"> Bandingkan </button>
</form>
<table class="table table-bordered">
    <thead>
   
    <th>Nama</th>
    <th>Pilih untuk perbandingan</th>
    <th>Total</th>
    </thead>
    <tbody>
        
    
    <?php
    $i = 0;
    foreach ($hasil as $h){
        if($i<10){
        echo '<tr>
            <td><a href="spesifikasi.php?spesifikasi='.$h['id_hp'].'">'.$h['versi_hp'].'</a></td>
                <td><a class="btn" onclick="set_compare(\''.$h['versi_hp'].'\')">Pilih</a>
                </td>
                <td>'.number_format($h['total'], 2,",", "").'</td>
            </tr>';
        }
        $i++;
    }
    ?>
    </tbody>
</table>
</div>
<script>
function set_compare(versi_hp){
    var comp1 = $("#compare1").val();
    var comp2 = $("#compare2").val();
    
    if(comp1 == ''){
        $("#compare1").val(versi_hp);
    }
    else{
        $("#compare2").val(versi_hp);
    }
}
</script>
<?php
include_once 'footer.php';
?>
