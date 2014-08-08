<?php
include_once 'header.php';
include_once 'validasi.php';

//proses simpan data hp baru ke database
if(isset ($_POST['add_hpbaru'])){
    //ambil semua data
    $merek = $_POST['merek'];
    $nama_hp = $_POST ['nama_hp'];
    $harga_baru = $_POST['harga_baru'];
    $harga_bekas = $_POST['harga_bekas'];
    $dua_g = $_POST['2g'];
    $tiga_g = $_POST['3g'];
    $empat_g = $_POST['4g'];
    $sim = $_POST['sim'];
    $rilis = $_POST['rilis'];
    $ukuran_hp = $_POST['ukuran_hp'];
    $berat_hp = $_POST['berat_hp'];
    $keyboard = $_POST['keyboard'];
    $tipe_layar = $_POST['tipe_layar'];
    $kedalaman_warna = $_POST['dalam_warna'];
    $resolusi_layar = $_POST['reso_layar'];
    $ukuran_layar = $_POST['ukuran_layar'];
    $fitur_layar = $_POST['fitur_layar'];
    $alert = $_POST['alert_tipe'];
    $speaker = $_POST['speaker'];
    $jack = $_POST['jack'];
    $eksternal = $_POST['eksternal'];
    $internal = $_POST['internal'];
    $ram = $_POST['ram'];
    $rom = $_POST['rom'];
    $gprs = $_POST['gprs'];
    $edge = $_POST['edge'];
    $speed = $_POST['speed'];
    $wlan = $_POST['wlan'];
    $bluetooth = $_POST['bluetooth'];
    $infrared = $_POST['infrared'];
    $usb = $_POST['usb'];
    $primer = $_POST['primer'];
    $fitur_kamera = $_POST['fitur_kamera'];
    $video = $_POST['video'];
    $sekunder = $_POST['sekunder'];
    $os_versi = $_POST['os_versi'];
    $os_nama = $_POST['os_nama'];
    $chipset = $_POST['chipset'];
    $cpu_core = $_POST['cpu_core'];
    $kapasitas_cpu = $_POST['kapasitas_cpu'];
    $gpu = $_POST['gpu'];
    $sensors = $_POST['sensors'];
    $messaging = $_POST['messaging'];
    $browser = $_POST['browser'];
    $radio = $_POST['radio'];
    $gps = $_POST['gps'];
    $java = $_POST['java'];
    $fitur_lain = $_POST['fitur_lain'];
    $tipe_baterai = $_POST['tipe_baterai'];
    $kapasitas_baterai = $_POST['kapasitas_baterai'];
    $standby = $_POST['standby'];
    $waktu_bicar = $_POST['waktu_bicara'];
    
    if (validfile()){
        $gambar_hp = $_FILES["file"]["name"]; //file nama 
    }
    else {
        $gambar_hp='';
    }
    
$sql = "INSERT INTO `spesifikasi`(`nama_merek`,`versi_hp`,`gambar`,`harga_baru`,`harga_bekas`,
    `dua_g`,`tiga_g`,`empat_g`,`sim`,`rilis`,
    `ukuran_hp`,`berat_hp`,`keyboard`,`tipe_layar`,`dalam_warna`,
    `reso_layar`,`ukuran_layar`,`fitur_layar`,`alert_tipe`,`speaker`,
    `jack`,`eksternal`,`internal`,`ram`,`rom`,
    `gprs`,`edge`,`speed`,`wlan`,`bluetooth`,
    `infrared`,`usb`,`primer`,`fitur_kamera`,`video`,
    `sekunder`,`os_versi`,`os_nama`,`chipset`,`cpu_core`,
    `kapasitas_cpu`,`gpu`,`sensors`,`messaging`,`browser`,
    `radio`,`gps`,`java`,`fitur_lain`,`tipe_baterai`,
    `kapasitas_baterai`,`standby`,`waktu_bicara`) 
VALUES ('$merek','$nama_hp','$gambar_hp','$harga_baru','$harga_bekas',
    '$dua_g','$tiga_g','$empat_g','$sim','$rilis',
    '$ukuran_hp','$berat_hp','$keyboard','$tipe_layar','$kedalaman_warna',
    '$resolusi_layar','$ukuran_layar','$fitur_layar','$alert','$speaker',
    '$jack','$eksternal','$internal','$ram','$rom',
    '$gprs','$edge','$speed','$wlan','$bluetooth',
    '$infrared','$usb','$primer','$fitur_kamera','$video',
    '$sekunder','$os_versi','$os_nama','$chipset','$cpu_core',
    '$kapasitas_cpu','$gpu','$sensors','$messaging','$browser',
    '$radio','$gps','$java','$fitur_lain','$tipe_baterai',
    '$kapasitas_baterai','$standby','$waktu_bicara')";
        
if (mysql_query($sql)) 
        $_SESSION ['add']='<div class="alert alert-success"> Data berhasil ditambah </div>';
    else 
        $_SESSION ['add']='<div class="alert alert-error"> Data gagal ditambah </div>';
echo '<script> window.location.href="mobile.php?merek='.$_GET['merek'].'" </script>';
}

else {  
?>
<div class="span10">
<p><strong style="font-size: 20px"> Tambah Handphone <?php echo $_GET['merek']?> </strong>
<hr>
</p>
<br>
<form class="form-horizontal" action="tambah_hp.php?merek=<?php echo $_GET['merek'];?>" method="POST" enctype="multipart/form-data"> <!--upload gambar-->
    <input type="hidden" name="merek" value="<?php echo $_GET['merek'];?>">
    
    <div class="control-group">
        <label class="control-label"> Nama HP </label>
            <div class="controls"> <input type="text" name="nama_hp"> </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> Gambar </label>
            <div class="controls"> <input type="file" name="file"> </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> Harga Baru </label>
            <div class="controls"> <input type="text" name="harga_baru"> </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> Harga Bekas </label>
            <div class="controls"> <input type="text" name="harga_bekas"> </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> GENERAL </label>
            <div class="controls">
               <span> Jaringan 2G </span> <input type="text" name="2g"> <br><br>
               <span> Jaringan 3G </span> <input type="text" name="3g"> <br><br>
               <span> Jaringan 4G </span> <input type="text" name="4g"> <br><br>
               <span> SIM </span> <input type="text" name="sim"> <br><br>
               <span> Rilis </span> <input type="text" name="rilis"> <br><br>
           </div>
    </div> <br>
     
    <div class="control-group">
         <label class="control-label"> DIMENSI </label>
            <div class="controls">
                <span> Ukuran </span> <input type="text" name="ukuran_hp"> <br><br>
                <span> Berat </span> <input type="text" name="berat_hp"> <br><br>
                <span> Keyboard </span> <input type="text" name="keyboard"> <br><br>
            </div> 
     </div> <br>
           
    <div class="control-group">
        <label class="control-label"> LAYAR </label>
            <div class="controls">
                <span> Tipe </span> <input type="text" name="tipe_layar"> <br><br>
                <span> Kedalaman Warna </span> <input type="text" name="dalam_warna"> <br><br>
                <span> Kerapatan Piksel </span> <input type="text" name="reso_layar"> <br><br>
                <span> Ukuran </span> <input type="text" name="ukuran_layar"> <br><br>
                <span> Fitur </span> <input type="text" name="fitur_layar"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> AUDIO </label>
            <div class="controls">
                <span> Fitur </span> <input type="text" name="alert_tipe"> <br><br>
                <span> Loudspeaker </span> <input type="text" name="speaker"> <br><br>
                <span> 3.5mm jack </span> <input type="text" name="jack"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> MEMORY </label>
            <div class="controls">
                <span> Eksternal </span> <input type="text" name="eksternal"> <br><br>
                <span> Internal </span> <input type="text" name="internal"><br><br>
                <span> RAM </span> <input type="text" name="ram"><br><br>
                <span> ROM </span> <input type="text" name="rom"><br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> DATA </label>
            <div class="controls">
                <span> GPRS </span> <input type="text" name="gprs"> <br><br>
                <span> EDGE </span> <input type="text" name="edge"> <br><br>
                <span> 3G </span> <input type="text" name="speed"> <br><br>
                <span> WLAN </span> <input type="text" name="wlan"> <br><br>
                <span> Bluetooth </span> <input type="text" name="bluetooth"> <br><br>
                <span> Infrared </span> <input type="text" name="infrared"> <br><br>
                <span> USB </span> <input type="text" name="usb"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> KAMERA </label>
            <div class="controls">
                <span> Primer </span> <input type="text" name="primer"> <br><br>
                <span> Fitur </span> <input type="text" name="fitur_kamera"> <br><br>
                <span> Video </span> <input type="text" name="video"> <br><br>
                <span> Sekunder </span> <input type="text" name="sekunder"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> FITUR </label>
            <div class="controls">
                <span> Sistem Operasi (versi) </span> <input type="text" name="os_versi"> <br><br>
                <span> Sistem Operasi (nama) </span> <input type="text" name="os_nama"> <br><br>
                <span> Chipset </span> <input type="text" name="chipset"> <br><br>
                <span> CPU core </span> <input type="text" name="cpu_core"> <br><br>
                <span> Kapasitas CPU </span> <input type="text" name="kapasitas_cpu"> <br><br>
                <span> GPU </span> <input type="text" name="gpu"> <br><br>
                <span> Sensors </span> <input type="text" name="sensors"> <br><br>
                <span> Messaging </span> <input type="text" name="messaging"> <br><br>
                <span> Browser </span> <input type="text" name="browser"> <br><br>
                <span> Radio </span> <input type="text" name="radio"> <br><br>
                <span> GPS </span> <input type="text" name="gps"> <br><br>
                <span> Java </span> <input type="text" name="java"> <br><br>
                <span> Fitur Tambahan </span> <input type="text" name="fitur_lain"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> BATERAI </label>
            <div class="controls">
                <span> Tipe </span> <input type="text" name="tipe_baterai"> <br><br>
                <span> Kapasitas </span> <input type="text" name="kapasitas_baterai"> <br><br>
                <span> Stand-by </span> <input type="text" name="standby"> <br><br>
                <span> Waktu Bicara </span> <input type="text" name="waktu_bicara"> <br><br>
            </div>
    </div> <br>
           
    <button class="btn btn-primary" name="add_hpbaru">Tambah</button>
    <a href="mobile.php?merek=<?php echo $_GET['merek']?>" class="btn">Kembali</a>

</form>
</div>

<?php
}
?>

<style>
    span {
        float: left;
        width: 100px;
    }
</style>

<?php
include_once 'footer.php';
?>
