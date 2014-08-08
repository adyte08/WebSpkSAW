<?php
include_once 'validasi.php';
include_once 'header.php';
include_once 'koneksi.php';
//proses update data
if(isset($_POST['save'])){
    $ID=$_POST['id'];
    $merek=$_GET['merek'];
    $versi=$_POST['nama_hp'];
 if (validfile()== TRUE){
     $gambar=$_FILES['file']['name'];
 }
 else {
    $gambar=$_POST ['gambar'];}
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
    $waktu_bicara = $_POST['waktu_bicara'];

    $sql="UPDATE `spesifikasi` SET `nama_merek`='$merek',`versi_hp`='$versi',`gambar`='$gambar',`harga_baru`='$harga_baru',`harga_bekas`='$harga_bekas',
        `dua_g`='$dua_g',`tiga_g`='$tiga_g',`empat_g`='$empat_g',`sim`='$sim',`rilis`='$rilis',
        `ukuran_hp`='$ukuran_hp',`berat_hp`='$berat_hp',`keyboard`='$keyboard',`tipe_layar`='$tipe_layar',`dalam_warna`='$kedalaman_warna',
        `reso_layar`='$resolusi_layar',`ukuran_layar`='$ukuran_layar',`fitur_layar`='$fitur_layar',`alert_tipe`='$alert',`speaker`='$speaker',
        `jack`='$jack',`eksternal`='$eksternal',`internal`='$internal',`ram`='$ram',`rom`='$rom',
        `gprs`='$gprs',`edge`='$edge',`speed`='$speed',`wlan`='$wlan',`bluetooth`='$bluetooth',
        `infrared`='$infrared',`usb`='$usb',`primer`='$primer',`fitur_kamera`='$fitur_kamera',`video`='$video',
        `sekunder`='$sekunder',`os_versi`='$os_versi',`os_nama`='$os_nama',`chipset`='$chipset',`cpu_core`='$cpu_core',
        `kapasitas_cpu`='$kapasitas_cpu',`gpu`='$gpu',`sensors`='$sensors',`messaging`='$messaging',`browser`='$browser',
        `radio`='$radio',`gps`='$gps',`java`='$java',`fitur_lain`='$fitur_lain',`tipe_baterai`='$tipe_baterai',
        `kapasitas_baterai`='$kapasitas_baterai',`standby`='$standby',`waktu_bicara`='$waktu_bicara' WHERE `ID`='$ID'";
    if (mysql_query($sql)) 
        $_SESSION ['add']='<div class="alert alert-success"> Data berhasil diubah </div>';
    else 
        $_SESSION ['add']='<div class="alert alert-error"> Data gagal diubah </div>';
  echo "<script> window.location.href='mobile.php?merek=".$merek."'</script>";
}

$id_hp=$_GET['id'];
$sql2 = "SELECT * FROM `spesifikasi` WHERE `ID`='$id_hp'";
$result2 = mysql_query($sql2);
$data =  mysql_fetch_assoc($result2);

?>
<div class="span10">
<p><strong style="font-size: 20px"> Ubah Handphone <?php echo $_GET['merek']?></strong><hr>

</p>
<form class="form-horizontal" action="ubah_hp.php?merek=<?php echo $_GET['merek'];?>" method="POST" enctype="multipart/form-data"> <!--upload gambar-->
    <input type="hidden" name="merek" value="<?php echo $_GET['merek'];?>">
    <input type="hidden" name="id" value="<?php echo $data['ID']?>">   
    <div class="control-group">
        <label class="control-label"> Nama HP </label>
            <div class="controls"> <input type="text" name="nama_hp" value="<?php echo $data['versi_hp']?>"> </div>
    </div>
    
    <div class="control-group">
        
        <label class="control-label"> Gambar </label>
        <label><img src="../img/upload/<?php echo $data['gambar']?>" width="60px" height="60px" style="margin-left: 20px"></label>
            <div class="controls"> 
                <input type="hidden" name="gambar" value="<?php echo $data['gambar']?>">
                <input type="file" name="file">
            </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> Harga Baru </label>
            <div class="controls"> <input type="text" name="harga_baru" value="<?php echo $data['harga_baru']?>"> </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> Harga Bekas </label>
            <div class="controls"> <input type="text" name="harga_bekas" value="<?php echo $data['harga_bekas']?>"> </div>
    </div>
    
    <div class="control-group">
        <label class="control-label"> GENERAL </label>
            <div class="controls">
                <span> Jaringan 2G </span> <input type="text" name="2g" value="<?php echo $data['dua_g']?>"> <br><br>
                <span> Jaringan 3G </span> <input type="text" name="3g" value="<?php echo $data['tiga_g']?>"> <br><br>
                <span> Jaringan 4G </span> <input type="text" name="4g" value="<?php echo $data['empat_g']?>"> <br><br>
                <span> SIM </span> <input type="text" name="sim" value="<?php echo $data['sim']?>"> <br><br>
                <span> Rilis </span> <input type="text" name="rilis" value="<?php echo $data['rilis']?>"> <br><br>
            </div>
    </div> <br>
     
    <div class="control-group">
        <label class="control-label"> DIMENSI </label>
            <div class="controls">
                <span> Ukuran </span> <input type="text" name="ukuran_hp" value="<?php echo $data['ukuran_hp']?>"> <br><br>
                <span> Berat </span> <input type="text" name="berat_hp" value="<?php echo $data['berat_hp']?>"> <br><br>
                <span> Keyboard </span> <input type="text" name="keyboard" value="<?php echo $data['keyboard']?>"> <br><br>
            </div> 
     </div> <br>
           
    <div class="control-group">
        <label class="control-label"> LAYAR </label>
            <div class="controls">
                <span> Tipe </span> <input type="text" name="tipe_layar" value="<?php echo $data['tipe_layar']?>"> <br><br>
                <span> Kedalaman Warna </span> <input type="text" name="dalam_warna" value="<?php echo $data['dalam_warna']?>"> <br><br>
                <span> Kerapatan Piksel </span> <input type="text" name="reso_layar" value="<?php echo $data['reso_layar']?>"> <br><br>
                <span> Ukuran </span> <input type="text" name="ukuran_layar" value="<?php echo $data['ukuran_layar']?>"> <br><br>
                <span> Fitur </span> <input type="text" name="fitur_layar" value="<?php echo $data['fitur_layar']?>"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> AUDIO </label>
            <div class="controls">
                <span> Fitur </span> <input type="text" name="alert_tipe" value="<?php echo $data['alert_tipe']?>"> <br><br>
                <span> Loudspeaker </span> <input type="text" name="speaker" value="<?php echo $data['speaker']?>"> <br><br>
                <span> 3.5mm jack </span> <input type="text" name="jack" value="<?php echo $data['jack']?>"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> MEMORY </label>
            <div class="controls">
                <span> Eksternal </span> <input type="text" name="eksternal" value="<?php echo $data['eksternal']?>"> <br><br>
                <span> Internal </span> <input type="text" name="internal" value="<?php echo $data['internal']?>"> <br><br>
                <span> RAM </span> <input type="text" name="ram" value="<?php echo $data['ram']?>"> <br><br>
                <span> ROM </span> <input type="text" name="rom" value="<?php echo $data['rom']?>"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> DATA </label>
            <div class="controls">
                <span> GPRS </span> <input type="text" name="gprs" value="<?php echo $data['gprs']?>"> <br><br>
                <span> EDGE </span> <input type="text" name="edge" value="<?php echo $data['edge']?>"> <br><br>
                <span> 3G </span> <input type="text" name="speed" value="<?php echo $data['speed']?>"> <br><br>
                <span> WLAN </span> <input type="text" name="wlan" value="<?php echo $data['wlan']?>"> <br><br>
                <span> Bluetooth </span> <input type="text" name="bluetooth" value="<?php echo $data['bluetooth']?>"> <br><br>
                <span> Infrared </span> <input type="text" name="infrared" value="<?php echo $data['infrared']?>"> <br><br>
                <span> USB </span> <input type="text" name="usb" value="<?php echo $data['usb']?>"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> KAMERA </label>
            <div class="controls">
                <span> Primer </span> <input type="text" name="primer" value="<?php echo $data['primer']?>"> <br><br>
                <span> Fitur </span> <input type="text" name="fitur_kamera" value="<?php echo $data['fitur_kamera']?>"> <br><br>
                <span> Video </span> <input type="text" name="video" value="<?php echo $data['video']?>"> <br><br>
                <span> Sekunder </span> <input type="text" name="sekunder" value="<?php echo $data['sekunder']?>"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> FITUR </label>
            <div class="controls">
                <span> Sistem Operasi (versi) </span> <input type="text" name="os_versi" value="<?php echo $data['os_versi']?>"> <br><br>
                <span> Sistem Operasi (nama) </span> <input type="text" name="os_nama" value="<?php echo $data['os_nama']?>"> <br><br>
                <span> Chipset </span> <input type="text" name="chipset" value="<?php echo $data['chipset']?>"> <br><br>
                <span> CPU core </span> <input type="text" name="cpu_core" value="<?php echo $data['cpu_core']?>"> <br><br>
                <span> Kapasitas CPU </span> <input type="text" name="kapasitas_cpu" value="<?php echo $data['kapasitas_cpu']?>"> <br><br>
                <span> GPU </span> <input type="text" name="gpu" value="<?php echo $data['gpu']?>"> <br><br>
                <span> Sensors </span> <input type="text" name="sensors" value="<?php echo $data['sensors']?>"> <br><br>
                <span> Messaging </span> <input type="text" name="messaging" value="<?php echo $data['messaging']?>"> <br><br>
                <span> Browser </span> <input type="text" name="browser" value="<?php echo $data['browser']?>"> <br><br>
                <span> Radio </span> <input type="text" name="radio" value="<?php echo $data['radio']?>"> <br><br>
                <span> GPS </span> <input type="text" name="gps" value="<?php echo $data['gps']?>"> <br><br>
                <span> Java </span> <input type="text" name="java" value="<?php echo $data['java']?>"> <br><br>
                <span> Fitur Tambahan </span> <input type="text" name="fitur_lain" value="<?php echo $data['fitur_lain']?>"> <br><br>
            </div>
    </div> <br>
           
    <div class="control-group">
        <label class="control-label"> BATERAI </label>
            <div class="controls">
                <span> Tipe </span><input type="text" name="tipe_baterai" value="<?php echo $data['tipe_baterai']?>"> <br><br>
                <span> Kapasitas </span><input type="text" name="kapasitas_baterai" value="<?php echo $data['kapasitas_baterai']?>"> <br><br>
                <span> Stand-by </span><input type="text" name="standby" value="<?php echo $data['standby']?>"> <br><br>
                <span> Waktu Bicara </span><input type="text" name="waktu_bicara" value="<?php echo $data['waktu_bicara']?>"> <br><br>
            </div>
    </div> <br>
           
    <button class="btn btn-primary" name="save">Ubah</button>
    <a href="mobile.php?merek=<?php echo $_GET['merek']?>" class="btn">Kembali</a>
</form>
</div>
<style>
    span {
        float: left;
        width: 100px;
    }
</style>
<?php
include_once 'footer.php';
?>