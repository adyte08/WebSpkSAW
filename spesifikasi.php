<?php
include_once 'header.php';
$id = $_GET['spesifikasi'];
$sql = "SELECT * FROM `spesifikasi` WHERE `id` = '$id'";
$result = mysql_query($sql);
$data = mysql_fetch_assoc($result);
$result = mysql_query("SELECT `ID`,`versi_hp` FROM `spesifikasi`");
$hp='[';
while ($rawdata = mysql_fetch_assoc($result)){
    $hp.="'".$rawdata['versi_hp']."',";
}
$hp .=']';
?>
<div class="span10">
 <!--input banding-->
 <form action="spesifikasi.php?spesifikasi=<?php echo $id;?>" method="POST" class="form-inline pull-right">
    <input type="text" name="compare" data-provider="typeahead" data-items="4" id="compare" autocomplete="off" placeholder="Bandingkan Ponsel...">
    <button class="btn btn-primary" name="banding"> Bandingkan </button>
</form>
 <div class="clearfix"></div>

 <!--tampilan detail hp pertama-->
 
<?php
if (isset($_POST['banding'])){
    echo '<div class="span5">';
    echo '<table class="table table-bordered">';
    echo '<tr><td colspan="2"><h3>'.$data['nama_merek'].' '.$data['versi_hp'].'</td></h3></tr>';
    echo '<tr><td colspan="2"><img src="img/upload/'. $data['gambar'].'" style="width:70px; height:110px;"></td>';
}
else {
    echo '<div class="span10">';
    echo '';
    echo '<table class="table table-bordered">';
    echo '<tr><td colspan="2"><h3>'.$data['nama_merek'].' '.$data['versi_hp'].'</td></h3></tr>';
    echo '<tr><td colspan="2"><img src="img/upload/'. $data['gambar'].'"></td></tr>';
}
?>
    
<?php 
echo '<tr><td><strong>'.'Harga Baru : </strong></td><td>Rp. '.number_format($data['harga_baru'],0,'','.').'</td></tr>';
echo '<tr><td><strong>'.'Harga Bekas : </strong></td><td>Rp. '.number_format($data['harga_bekas'],0,'','.').'</td></tr>';
echo '<tr><td> GENERAL </td><td>';
    echo '<p><strong>'.'Jaringan 2G : </strong>'.$data['dua_g'].'</p>';
    echo '<p><strong>'.'Jaringan 3G : </strong>'.$data['tiga_g'].'</p>';
    echo '<p><strong>'.'Jaringan 4G : </strong>'.$data['empat_g'].'</p>';
    echo '<p><strong>'.'SIM : </strong>'.$data['sim'].'</p>';
    echo '<p><strong>'.'Rilis : </strong>'.$data['rilis'].'</p>';
echo '</td></tr>'; 
echo '<tr><td> DIMENSI </td><td>';
    echo '<p><strong>'.'Ukuran : </strong>'.$data['ukuran_hp'].'</p>';
    echo '<p><strong>'.'Berat : </strong>'.$data['berat_hp'].'</p>';
    echo '<p><strong>'.'Keyboard : </strong>'.$data['keyboard'].'</p>';
echo '</td></tr>';
echo '<tr><td> LAYAR </td><td>';
    echo '<p><strong>'.'Tipe : </strong>'.$data['tipe_layar'].'</p>';
    echo '<p><strong>'.'Kedalaman Warna : </strong>'.$data['dalam_warna'].'</p>';
    echo '<p><strong>'.'Resolusi : </strong>'.$data['reso_layar'].'</p>';
    echo '<p><strong>'.'Ukuran : </strong>'.$data['ukuran_layar'].'</p>';
    echo '<p><strong>'.'Fitur : </strong>'.$data['fitur_layar'].'</p>';
echo '</td></tr>';
echo '<tr><td> AUDIO </td><td>';
    echo '<p><strong>'.'Fitur : </strong>'.$data['alert_tipe'].'</p>';
    echo '<p><strong>'.'Loudspeaker : </strong>'.$data['speaker'].'</p>';
    echo '<p><strong>'.'3.5mm jack : </strong>'.$data['jack'].'</p>';
echo '</td></tr>';
echo '<tr><td> MEMORY </td><td>';
    echo '<p><strong>'.'Eksternal : </strong>'.$data['eksternal'].'</p>';
    echo '<p><strong>'.'Internal : </strong>'.$data['internal'].'</p>';
    echo '<p><strong>'.'RAM : </strong>'.$data['ram'].'</p>';
    echo '<p><strong>'.'ROM : </strong>'.$data['rom'].'</p>';
echo '</td></tr>'; 
echo '<tr><td> DATA </td><td>';
    echo '<p><strong>'.'GPRS : </strong>'.$data['gprs'].'</p>';
    echo '<p><strong>'.'EDGE : </strong>'.$data['edge'].'</p>';
    echo '<p><strong>'.'3G : </strong>'.$data['speed'].'</p>';
    echo '<p><strong>'.'WLAN : </strong>'.$data['wlan'].'</p>';
    echo '<p><strong>'.'Bluetooth : </strong>'.$data['bluetooth'].'</p>';
    echo '<p><strong>'.'Infrared : </strong>'.$data['infrared'].'</p>';
    echo '<p><strong>'.'USB : </strong>'.$data['usb'].'</p>';
echo '</td></tr>';
echo '<tr><td> KAMERA </td><td>';
    echo '<p><strong>'.'Primer : </strong>'.$data['primer'].'</p>';
    echo '<p><strong>'.'Fitur : </strong>'.$data['fitur_kamera'].'</p>';
    echo '<p><strong>'.'Video : </strong>'.$data['video'].'</p>';
    echo '<p><strong>'.'Sekunder : </strong>'.$data['sekunder'].'</p>';
echo '</td></tr>'; 
echo '<tr><td> FITUR </td><td>';
    echo '<p><strong>'.'Sistem Operasi (versi) : </strong>'.$data['os_versi'].'</p>';
    echo '<p><strong>'.'Sistem Operasi (nama) : </strong>'.$data['os_nama'].'</p>';
    echo '<p><strong>'.'Chipset : </strong>'.$data['chipset'].'</p>';
    echo '<p><strong>'.'CPU Core : </strong>'.$data['cpu_core'].'</p>';
    echo '<p><strong>'.'Kapasitas CPU : </strong>'.$data['kapasitas_cpu'].'</p>';
    echo '<p><strong>'.'GPU : </strong>'.$data['gpu'].'</p>';
    echo '<p><strong>'.'Sensors : </strong>'.$data['sensors'].'</p>';
    echo '<p><strong>'.'Messaging : </strong>'.$data['messaging'].'</p>';
    echo '<p><strong>'.'Browser : </strong>'.$data['browser'].'</p>';
    echo '<p><strong>'.'Radio : </strong>'.$data['radio'].'</p>';
    echo '<p><strong>'.'GPS : </strong>'.$data['gps'].'</p>';
    echo '<p><strong>'.'Java : </strong>'.$data['java'].'</p>';
    echo '<p><strong>'.'Fitur Tambahan : </strong>'.$data['fitur_lain'].'</p>';
echo '</td></tr>';
echo '<tr><td> BATERAI </td><td>';
    echo '<p><strong>'.'Tipe : </strong>'.$data['tipe_baterai'].'</p>';
    echo '<p><strong>'.'Kapasitas : </strong>'.$data['kapasitas_baterai'].'</p>';
    echo '<p><strong>'.'Stand-by : </strong>'.$data['standby'].'</p>';
    echo '<p><strong>'.'Waktu Bicara : </strong>'.$data['waktu_bicara'].'</p>';
echo '</td></tr>';
echo '</table>';

//list opini

$sql2 = "SELECT * FROM opini WHERE `id_hp`='".$data['ID']."' AND approved = '1' ORDER BY `tanggal`DESC LIMIT 0,5";
$result_opini = mysql_query($sql2);
if (isset($_POST['banding'])){
    
if (!empty($result_opini)){
    echo '<h4>'.$data['versi_hp'].' User Opini dan Review </h4><br>';
    
    echo '<table class="table">';
    
    while ($data_opini=  mysql_fetch_object($result_opini)){
        echo '<tr><td><p><strong>';
        echo $data_opini->username;
        echo '</strong><span class="pull-right">';
        echo $data_opini->tanggal;
        echo '</span><p class="echtul2">';
        echo $data_opini->opini;
        echo '</p></td></tr>';
    }
    echo '</table>';
} 
else {
    echo'Belum Ada Opini';
}}

else {
if (!empty($result_opini)){
    echo '<h4>'.$data['versi_hp'].' User Opini dan Review </h4><br>';
    
    echo '<table class="table">';
    
    while ($data_opini=  mysql_fetch_object($result_opini)){
        echo '<tr><td><p><strong>';
        echo $data_opini->username;
        echo '</strong><span class="pull-right">';
        echo $data_opini->tanggal;
        echo '</span><p class="echtul">';
        echo $data_opini->opini;
        echo '</p></td></tr>';
    }
    echo '</table>';
} 
else {
    echo'Belum Ada Opini';
}
}
?>
 
<?php
$id_hp = $_GET['spesifikasi'];
//if(isset($_SESSION['login'])){
//
    echo '<a class="btn" href="opini.php?opini='.$id_hp.'"> Post Opini </a>';
//}
//else {
//    echo '<a class="btn" onclick="please_login()"> Post Opini </a>';
//}
echo '<a class="btn" href="opini.php?opini='.$id_hp.'&readall"> Lihat Semua Opini </a>'
?>

</div>
<!--tampilah hp yang di compare-->
<?php
if (isset ($_POST['banding'])){
    $versi_compare = $_POST['compare'];
    $sql = "SELECT * FROM `spesifikasi` WHERE `versi_hp` = '$versi_compare'";
    $result = mysql_query($sql);
    $data2 = mysql_fetch_assoc($result);
?>
<!--   tampilan hp yang di compare-->
<div class="span5">
    
        <?php 
        echo '<table class="table table-bordered">';
        echo '<tr><td colspan="2"><h3>'.$data2['nama_merek'].' '.$data2['versi_hp'].'</h3></td></tr>';
        echo '<tr><td colspan="2"><img src="img/upload/'.$data2['gambar'].'" style="width:70px; height:110px;"></td></tr>';
        echo '<tr><td><strong>'.'Harga Baru : </strong></td><td>Rp.'.number_format($data2['harga_baru'],0,'','.').'</td></tr>';
        echo '<tr><td><strong>'.'Harga Bekas : </strong></td><td>Rp. '.number_format($data2['harga_bekas'],0,'','.').'</td></tr>';
        echo '<tr><td> GENERAL </td><td>';
    echo '<p><strong>'.'Jaringan 2G : </strong>'.$data2['dua_g'].'</p>';
    echo '<p><strong>'.'Jaringan 3G : </strong>'.$data2['tiga_g'].'</p>';
    echo '<p><strong>'.'Jaringan 4G : </strong>'.$data2['empat_g'].'</p>';
    echo '<p><strong>'.'SIM : </strong>'.$data2['sim'].'</p>';
    echo '<p><strong>'.'Rilis : </strong>'.$data2['rilis'].'</p>';
echo '</td></tr>'; 
echo '<tr><td> DIMENSI </td><td>';
    echo '<p><strong>'.'Ukuran : </strong>'.$data2['ukuran_hp'].'</p>';
    echo '<p><strong>'.'Berat : </strong>'.$data2['berat_hp'].'</p>';
    echo '<p><strong>'.'Keyboard : </strong>'.$data2['keyboard'].'</p>';
echo '</td></tr>';
echo '<tr><td> LAYAR </td><td>';
    echo '<p><strong>'.'Tipe : </strong>'.$data2['tipe_layar'].'</p>';
    echo '<p><strong>'.'Kedalaman Warna : </strong>'.$data2['dalam_warna'].'</p>';
    echo '<p><strong>'.'Resolusi : </strong>'.$data2['reso_layar'].'</p>';
    echo '<p><strong>'.'Ukuran : </strong>'.$data2['ukuran_layar'].'</p>';
    echo '<p><strong>'.'Fitur : </strong>'.$data2['fitur_layar'].'</p>';
echo '</td></tr>';
echo '<tr><td> AUDIO </td><td>';
    echo '<p><strong>'.'Fitur : </strong>'.$data2['alert_tipe'].'</p>';
    echo '<p><strong>'.'Loudspeaker : </strong>'.$data2['speaker'].'</p>';
    echo '<p><strong>'.'3.5mm jack : </strong>'.$data2['jack'].'</p>';
echo '</td></tr>';
echo '<tr><td> MEMORY </td><td>';
    echo '<p><strong>'.'Eksternal : </strong>'.$data2['eksternal'].'</p>';
    echo '<p><strong>'.'Internal : </strong>'.$data2['internal'].'</p>';
    echo '<p><strong>'.'RAM : </strong>'.$data2['ram'].'</p>';
    echo '<p><strong>'.'ROM : </strong>'.$data2['rom'].'</p>';
echo '</td></tr>'; 
echo '<tr><td> DATA </td><td>';
    echo '<p><strong>'.'GPRS : </strong>'.$data2['gprs'].'</p>';
    echo '<p><strong>'.'EDGE : </strong>'.$data2['edge'].'</p>';
    echo '<p><strong>'.'3G : </strong>'.$data2['speed'].'</p>';
    echo '<p><strong>'.'WLAN : </strong>'.$data2['wlan'].'</p>';
    echo '<p><strong>'.'Bluetooth : </strong>'.$data2['bluetooth'].'</p>';
    echo '<p><strong>'.'Infrared : </strong>'.$data2['infrared'].'</p>';
    echo '<p><strong>'.'USB : </strong>'.$data2['usb'].'</p>';
echo '</td></tr>';
echo '<tr><td> KAMERA </td><td>';
    echo '<p><strong>'.'Primer : </strong>'.$data2['primer'].'</p>';
    echo '<p><strong>'.'Fitur : </strong>'.$data2['fitur_kamera'].'</p>';
    echo '<p><strong>'.'Video : </strong>'.$data2['video'].'</p>';
    echo '<p><strong>'.'Sekunder : </strong>'.$data2['sekunder'].'</p>';
echo '</td></tr>'; 
echo '<tr><td> FITUR </td><td>';
    echo '<p><strong>'.'Sistem Operasi (versi) : </strong>'.$data2['os_versi'].'</p>';
    echo '<p><strong>'.'Sistem Operasi (nama) : </strong>'.$data2['os_nama'].'</p>';
    echo '<p><strong>'.'Chipset : </strong>'.$data2['chipset'].'</p>';
    echo '<p><strong>'.'CPU Core : </strong>'.$data2['cpu_core'].'</p>';
    echo '<p><strong>'.'Kapasitas CPU : </strong>'.$data2['kapasitas_cpu'].'</p>';
    echo '<p><strong>'.'GPU : </strong>'.$data2['gpu'].'</p>';
    echo '<p><strong>'.'Sensors : </strong>'.$data2['sensors'].'</p>';
    echo '<p><strong>'.'Messaging : </strong>'.$data2['messaging'].'</p>';
    echo '<p><strong>'.'Browser : </strong>'.$data2['browser'].'</p>';
    echo '<p><strong>'.'Radio : </strong>'.$data2['radio'].'</p>';
    echo '<p><strong>'.'GPS : </strong>'.$data2['gps'].'</p>';
    echo '<p><strong>'.'Java : </strong>'.$data2['java'].'</p>';
    echo '<p><strong>'.'Fitur Tambahan : </strong>'.$data2['fitur_lain'].'</p>';
echo '</td></tr>';
echo '<tr><td> BATERAI </td><td>';
    echo '<p><strong>'.'Tipe : </strong>'.$data2['tipe_baterai'].'</p>';
    echo '<p><strong>'.'Kapasitas : </strong>'.$data2['kapasitas_baterai'].'</p>';
    echo '<p><strong>'.'Stand-by : </strong>'.$data2['standby'].'</p>';
    echo '<p><strong>'.'Waktu Bicara : </strong>'.$data2['waktu_bicara'].'</p>';
echo '</td></tr>';
        echo '</table>';
    //list opini

$sql3 = "SELECT * FROM opini WHERE `id_hp`='".$data2['ID']."' AND approved = '1' ORDER BY `tanggal`DESC LIMIT 0,5";
$result_opini2 = mysql_query($sql3);
if (!empty($result_opini2)){
    echo '<h4>'.$data2['versi_hp'].' User Opini dan Review </h4><br>';
    
    echo '<table class="table">';
    
    while ($data_opini2=  mysql_fetch_object($result_opini2)){
        echo '<tr><td><p><strong>';
        echo $data_opini2->username;
        echo '</strong><span class="pull-right">';
        echo $data_opini2->tanggal;
        echo '</span><p class="echtul2">';
        echo $data_opini2->opini;
        echo '</p></td></tr>';
    }
    echo '</table>';
} 
else {
    echo'Belum Ada Opini';
}
echo '<a href="opini.php?opini='.$data2['ID'].'" class="btn" > Post Opini </a>';
echo '<a  href="opini.php?opini='.$data2['ID'].'&readall" class="btn"> Lihat Semua Opini </a>'
?>

</div>
<?php
}
?>
</div>
<?php
include_once 'footer.php';
?>
<script>
    var hp = <?php echo $hp;?>;
    $('#compare').typeahead({source:hp});
    $("#opini_form").hide ();
    function show_form(){
        $("#opini_form").show();
    }
    function please_login(){
        var login=<?php echo isset($_SESSION['login'])?1:0;?>;
        if (login != 1){
            //alert('Silahkan Login Terlebih Dahulu');
            var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi Login</h3></div>'+
            '<div class="modal-body"><p>Silahkan Login Terlebih Dahulu</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">OK</a>'+
           '</div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            
        });
        confirmModal.modal('show');  
        }
    }
</script>   

