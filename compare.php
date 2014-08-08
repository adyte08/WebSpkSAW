<?php
include_once 'header.php';
$result = mysql_query("SELECT `ID`,`versi_hp` FROM `spesifikasi`");
$hp='[';
while ($rawdata = mysql_fetch_assoc($result)){
    $hp.="'".$rawdata['versi_hp']."',";
}
$hp .=']';
?>


 <!--input banding-->
 <div class="span10">
     <h3> Membandingkan Handphone </h3><hr>
 <form action="compare.php?compare" method="POST" class="form-inline pull-right">
    <input type="text" name="compare1" data-provider="typeahead" data-items="4" id="compare1" autocomplete="off" placeholder="Handphone 1...">
    <input type="text" name="compare2" data-provider="typeahead" data-items="4" id="compare2" autocomplete="off" placeholder="Handphone 2...">
    <button class="btn btn-primary" name="banding"> Bandingkan </button>
</form>
 <div class="clearfix"></div>

 
<!--tampilah hp yang di compare-->
<?php
if (isset ($_POST['banding'])){
    $versi_compare1 = $_POST['compare1'];
    $versi_compare2 = $_POST['compare2'];
    $sql1 = "SELECT * FROM `spesifikasi` WHERE `versi_hp` = '$versi_compare1'";
    $sql2 = "SELECT * FROM `spesifikasi` WHERE `versi_hp` = '$versi_compare2'";
    $result1 = mysql_query($sql1);
    $result2 = mysql_query($sql2);
    $data1 = mysql_fetch_assoc($result1);
    $data2 = mysql_fetch_assoc($result2);
?>
<!--   tampilan hp yang di compare-->

<div class="span12">
    
        <?php
        echo '<table class="table table-bordered">';
        echo '<tr><td width="10%"></td><td width="50%"><h5>'.$data1['nama_merek'].' '.$data1['versi_hp'].'</h5></td>
            <td width="50%"><h5>'.$data2['nama_merek'].' '.$data2['versi_hp'].'</h5></td></tr>';
        echo '<tr><td></td><td><img src="img/upload/'.$data1['gambar'].'" style="width:70px; height:110px;"></td>
                  <td><img src="img/upload/'.$data2['gambar'].'" style="width:70px; height:110px;"></td>';
        echo '</tr>';
        echo '<tr>
            <td>HARGA BARU</td><td>Rp. '.number_format($data1['harga_baru'], 0, '','.').'</td>
            <td>Rp. '.number_format($data2['harga_baru'], 0, '','.').'</td></tr>';
        echo '<tr>
            <td>HARGA BEKAS</td><td>Rp.'.number_format($data1['harga_bekas'],0,'','.').'</td>
            </td><td>Rp.'.number_format($data2['harga_bekas'],0,'','.').'</td></tr>';
        echo '<tr><td> GENERAL </td><td>';
    echo '<p><strong>'.'Jaringan 2G : </strong>'.$data1['dua_g'].'</p>';
    echo '<p><strong>'.'Jaringan 3G : </strong>'.$data1['tiga_g'].'</p>';
    echo '<p><strong>'.'Jaringan 4G : </strong>'.$data1['empat_g'].'</p>';
    echo '<p><strong>'.'SIM : </strong>'.$data1['sim'].'</p>';
    echo '<p><strong>'.'Rilis : </strong>'.$data1['rilis'].'</p>';
echo '</td><td>
    <p><strong>'.'Jaringan 2G : </strong>'.$data2['dua_g'].'</p>
    <p><strong>'.'Jaringan 3G : </strong>'.$data2['tiga_g'].'</p>
    <p><strong>'.'Jaringan 4G : </strong>'.$data2['empat_g'].'</p>
    <p><strong>'.'SIM : </strong>'.$data2['sim'].'</p>
    <p><strong>'.'Rilis : </strong>'.$data2['rilis'].'</p>
    </td></tr>'; 
echo '<tr><td> DIMENSI </td><td>';
    echo '<p><strong>'.'Ukuran : </strong>'.$data1['ukuran_hp'].'</p>';
    echo '<p><strong>'.'Berat : </strong>'.$data1['berat_hp'].'</p>';
    echo '<p><strong>'.'Keyboard : </strong>'.$data1['keyboard'].'</p>';
echo '</td><td>
    <p><strong>'.'Ukuran : </strong>'.$data2['ukuran_hp'].'</p>
    <p><strong>'.'Berat : </strong>'.$data2['berat_hp'].'</p>
    <p><strong>'.'Keyboard : </strong>'.$data2['keyboard'].'</p>
    </td></tr>';
echo '<tr><td> LAYAR </td><td>';
    echo '<p><strong>'.'Tipe : </strong>'.$data1['tipe_layar'].'</p>';
    echo '<p><strong>'.'Kedalaman Warna : </strong>'.$data1['dalam_warna'].'</p>';
    echo '<p><strong>'.'Kerapatan Piksel : </strong>'.$data1['reso_layar'].'</p>';
    echo '<p><strong>'.'Ukuran : </strong>'.$data1['ukuran_layar'].'</p>';
    echo '<p><strong>'.'Fitur : </strong>'.$data1['fitur_layar'].'</p>';
echo '</td><td>
    <p><strong>'.'Tipe : </strong>'.$data2['tipe_layar'].'</p>
    <p><strong>'.'Kedalaman Warna : </strong>'.$data2['dalam_warna'].'</p>
    <p><strong>'.'Kerapatan Piksel : </strong>'.$data2['reso_layar'].'</p>
    <p><strong>'.'Ukuran : </strong>'.$data2['ukuran_layar'].'</p>
    <p><strong>'.'Fitur : </strong>'.$data2['fitur_layar'].'</p>
    </td></tr>';
echo '<tr><td> AUDIO </td><td>';
    echo '<p><strong>'.'Fitur : </strong>'.$data1['alert_tipe'].'</p>';
    echo '<p><strong>'.'Loudspeaker : </strong>'.$data1['speaker'].'</p>';
    echo '<p><strong>'.'3.5mm jack : </strong>'.$data1['jack'].'</p>';
echo '</td><td>
    <p><strong>'.'Fitur : </strong>'.$data2['alert_tipe'].'</p>
    <p><strong>'.'Loudspeaker : </strong>'.$data2['speaker'].'</p>
    <p><strong>'.'3.5mm jack : </strong>'.$data2['jack'].'</p>
    </td></tr>';
echo '<tr><td> MEMORY </td><td>';
    echo '<p><strong>'.'Eksternal : </strong>'.$data1['eksternal'].'</p>';
    echo '<p><strong>'.'Internal : </strong>'.$data1['internal'].'</p>';
    echo '<p><strong>'.'RAM : </strong>'.$data1['ram'].'</p>';
    echo '<p><strong>'.'ROM : </strong>'.$data1['rom'].'</p>';
echo '</td><td>
    <p><strong>'.'Eksternal : </strong>'.$data2['eksternal'].'</p>
    <p><strong>'.'Internal : </strong>'.$data2['internal'].'</p>
    <p><strong>'.'RAM : </strong>'.$data2['ram'].'</p>
    <p><strong>'.'ROM : </strong>'.$data2['rom'].'</p>
    </td></tr>'; 
echo '<tr><td> DATA </td><td>';
    echo '<p><strong>'.'GPRS : </strong>'.$data1['gprs'].'</p>';
    echo '<p><strong>'.'EDGE : </strong>'.$data1['edge'].'</p>';
    echo '<p><strong>'.'3G : </strong>'.$data1['speed'].'</p>';
    echo '<p><strong>'.'WLAN : </strong>'.$data1['wlan'].'</p>';
    echo '<p><strong>'.'Bluetooth : </strong>'.$data1['bluetooth'].'</p>';
    echo '<p><strong>'.'Infrared : </strong>'.$data1['infrared'].'</p>';
    echo '<p><strong>'.'USB : </strong>'.$data1['usb'].'</p>';
echo '</td><td>
    <p><strong>'.'GPRS : </strong>'.$data2['gprs'].'</p>
    <p><strong>'.'EDGE : </strong>'.$data2['edge'].'</p>
    <p><strong>'.'3G : </strong>'.$data2['speed'].'</p>
    <p><strong>'.'WLAN : </strong>'.$data2['wlan'].'</p>
    <p><strong>'.'Bluetooth : </strong>'.$data2['bluetooth'].'</p>
    <p><strong>'.'Infrared : </strong>'.$data2['infrared'].'</p>
    <p><strong>'.'USB : </strong>'.$data2['usb'].'</p>
    </td></tr>';
echo '<tr><td> KAMERA </td><td>';
    echo '<p><strong>'.'Primer : </strong>'.$data1['primer'].'</p>';
    echo '<p><strong>'.'Fitur : </strong>'.$data1['fitur_kamera'].'</p>';
    echo '<p><strong>'.'Video : </strong>'.$data1['video'].'</p>';
    echo '<p><strong>'.'Sekunder : </strong>'.$data1['sekunder'].'</p>';
echo '</td><td>
    <p><strong>'.'Primer : </strong>'.$data2['primer'].'</p>
    <p><strong>'.'Fitur : </strong>'.$data2['fitur_kamera'].'</p>
    <p><strong>'.'Video : </strong>'.$data2['video'].'</p>
    <p><strong>'.'Sekunder : </strong>'.$data2['sekunder'].'</p>
    </td></tr>'; 
echo '<tr><td> FITUR </td><td>';
    echo '<p><strong>'.'Sistem Operasi (versi) : </strong>'.$data1['os_versi'].'</p>';
    echo '<p><strong>'.'Sistem Operasi (nama) : </strong>'.$data1['os_nama'].'</p>';
    echo '<p><strong>'.'Chipset : </strong>'.$data1['chipset'].'</p>';
    echo '<p><strong>'.'CPU Core : </strong>'.$data1['cpu_core'].'</p>';
    echo '<p><strong>'.'Kapasitas CPU : </strong>'.$data1['kapasitas_cpu'].'</p>';
    echo '<p><strong>'.'GPU : </strong>'.$data1['gpu'].'</p>';
    echo '<p><strong>'.'Sensors : </strong>'.$data1['sensors'].'</p>';
    echo '<p><strong>'.'Messaging : </strong>'.$data1['messaging'].'</p>';
    echo '<p><strong>'.'Browser : </strong>'.$data1['browser'].'</p>';
    echo '<p><strong>'.'Radio : </strong>'.$data1['radio'].'</p>';
    echo '<p><strong>'.'GPS : </strong>'.$data1['gps'].'</p>';
    echo '<p><strong>'.'Java : </strong>'.$data1['java'].'</p>';
    echo '<p><strong>'.'Fitur Tambahan : </strong>'.$data1['fitur_lain'].'</p>';
echo '</td><td>';
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
    echo '<p><strong>'.'Fitur Tambahan : </strong>'.$data2['fitur_lain'].'</p></td></tr>';
    
echo '<tr><td> BATERAI </td><td>';
    echo '<p><strong>'.'Tipe : </strong>'.$data1['tipe_baterai'].'</p>';
    echo '<p><strong>'.'Kapasitas : </strong>'.$data1['kapasitas_baterai'].'</p>';
    echo '<p><strong>'.'Stand-by : </strong>'.$data1['standby'].'</p>';
    echo '<p><strong>'.'Waktu Bicara : </strong>'.$data1['waktu_bicara'].'</p>';
    echo '</td><td>
         <p><strong>'.'Tipe : </strong>'.$data2['tipe_baterai'].'</p>
         <p><strong>'.'Kapasitas : </strong>'.$data2['kapasitas_baterai'].'</p>
         <p><strong>'.'Stand-by : </strong>'.$data2['standby'].'</p>
         <p><strong>'.'Waktu Bicara : </strong>'.$data2['waktu_bicara'].'</p>
        </td></tr>';
    echo '</table>';
        ?>
</div>

<?php
}
?>
 </div>

<script>
    var hp = <?php echo $hp;?>;
    $('#compare1').typeahead({source:hp});
    $('#compare2').typeahead({source:hp});
       
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
<?php
include_once 'footer.php';
?>

