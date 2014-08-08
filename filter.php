<?php
//pemanggilan koneksi.php
include_once 'header.php';
include_once 'koneksi.php';
session_start();
?><!DOCTYPE html>

<div class="container">
    <div class="row-fluid">
        <div class="span10">
            <div style="margin-left: 120px">
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
                
<h3>Pemilihan Ponsel Android</h3>
<h6>Pilihlah kriteria ponsel yang kamu inginkan pada form dibawah ini.</h6><br>
<form action="hasil_filter.php" method="POST" class="form-inline">
    <label><strong>Kebutuhan</strong></label>
    <select name="kebutuhan" style="margin-left: 280px" onchange="window.location = 'filter.php?kebutuhan='+this.options[this.selectedIndex].value">
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
        <tr> <td> Harga Baru </td>
            <td> <select name="harga_baru"><option value="NULL">Pilih</option>
                    <option value="5" <?php echo (isset($skala['harga_baru'])?($skala['harga_baru']=='5'? 'selected':''):'')?> > < Rp.1000.000</option>
                    <option value="4" <?php echo (isset($skala['harga_baru'])?($skala['harga_baru']=='4'? 'selected':''):'')?>> Rp.1000.000 - Rp.2000.000 </option>
                    <option value="3" <?php echo (isset($skala['harga_baru'])?($skala['harga_baru']=='3'? 'selected':''):'')?>> Rp.2000.000 - Rp.3000.000 </option>
                    <option value="2" <?php echo (isset($skala['harga_baru'])?($skala['harga_baru']=='2'? 'selected':''):'')?>> Rp.3000.000 - Rp.4000.000 </option>
                    <option value="1" <?php echo (isset($skala['harga_baru'])?($skala['harga_baru']=='1'? 'selected':''):'')?>> > Rp.4000.000 </option>
                </select></td>
        </tr>
        <tr> <td> Harga Bekas </td>
            <td> <select name="harga_bekas"><option value="NULL">Pilih</option>
                    <option value="5" <?php echo (isset($skala['harga_bekas'])?($skala['harga_bekas']=='5'? 'selected':''):'')?>> < Rp.1000.000</option>
                    <option value="4" <?php echo (isset($skala['harga_bekas'])?($skala['harga_bekas']=='4'? 'selected':''):'')?>> Rp.1000.000 - Rp.2000.000 </option>
                    <option value="3" <?php echo (isset($skala['harga_bekas'])?($skala['harga_bekas']=='3'? 'selected':''):'')?>> Rp.2000.000 - Rp.3000.000 </option>
                    <option value="2" <?php echo (isset($skala['harga_bekas'])?($skala['harga_bekas']=='2'? 'selected':''):'')?>>  Rp.3000.000 - Rp.4000.000 </option>
                    <option value="1" <?php echo (isset($skala['harga_bekas'])?($skala['harga_bekas']=='1'? 'selected':''):'')?>> > Rp.4000.000 </option>
                </select></td>
        </tr>
        <tr> <td> SIM </td>
            <td> <select name="sim"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['sim'])?($skala['sim']=='1'? 'selected':''):'')?> > CDMA </option>
                    <option value="2" <?php echo (isset($skala['sim'])?($skala['sim']=='2'? 'selected':''):'')?>> GSM HSDPA </option>
                    <option value="3" <?php echo (isset($skala['sim'])?($skala['sim']=='3'? 'selected':''):'')?>> LTE </option>
                    <option value="4" <?php echo (isset($skala['sim'])?($skala['sim']=='4'? 'selected':''):'')?>> DUAL GSM </option>
                    <option value="5" <?php echo (isset($skala['sim'])?($skala['sim']=='5'? 'selected':''):'')?>> DUAL CDMA </option>
                    <option value="6" <?php echo (isset($skala['sim'])?($skala['sim']=='6'? 'selected':''):'')?>> DUAL GSM-CDMA </option>
                </select></td>
        </tr>
        <tr> <td> Internal Storage</td>
            <td> <select name="internal"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['internal'])?($skala['internal']=='1'? 'selected':''):'')?>> < 512 MB </option>
                    <option value="2" <?php echo (isset($skala['internal'])?($skala['internal']=='2'? 'selected':''):'')?>> 512 - 1 GB </option>
                    <option value="3" <?php echo (isset($skala['internal'])?($skala['internal']=='3'? 'selected':''):'')?>> 1 GB - 2 GB </option>
                    <option value="4" <?php echo (isset($skala['internal'])?($skala['internal']=='4'? 'selected':''):'')?>> 2 GB - 4 GB </option>
                    <option value="5" <?php echo (isset($skala['internal'])?($skala['internal']=='5'? 'selected':''):'')?>> > 4 GB </option>
                </select></td>
        </tr>
        <tr> <td> RAM </td>
            <td> <select name="ram"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['ram'])?($skala['ram']=='1'? 'selected':''):'')?>> < 256 MB </option>
                    <option value="2" <?php echo (isset($skala['ram'])?($skala['ram']=='2'? 'selected':''):'')?>> 256 MB - 512 MB </option>
                    <option value="3" <?php echo (isset($skala['ram'])?($skala['ram']=='3'? 'selected':''):'')?>> 512 MB - 1 GB </option>
                    <option value="4" <?php echo (isset($skala['ram'])?($skala['ram']=='4'? 'selected':''):'')?>> 1 GB - 2 GB </option>
                    <option value="5" <?php echo (isset($skala['ram'])?($skala['ram']=='5'? 'selected':''):'')?>> > 2 GB </option>

                </select></td>
        </tr>
        
        <tr> <td> Kamera (Primer) </td>
            <td> <select name="primer"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['primer'])?($skala['primer']=='1'? 'selected':''):'')?>> < 2 MP </option>
                    <option value="2" <?php echo (isset($skala['primer'])?($skala['primer']=='2'? 'selected':''):'')?>> 2 MP - 4 MP </option>
                    <option value="3" <?php echo (isset($skala['primer'])?($skala['primer']=='3'? 'selected':''):'')?>> 4 MP - 6 MP </option>
                    <option value="4" <?php echo (isset($skala['primer'])?($skala['primer']=='4'? 'selected':''):'')?>> 6 MP - 8 MP </option>
                    <option value="5" <?php echo (isset($skala['primer'])?($skala['primer']=='5'? 'selected':''):'')?>> > 8 MP </option>

                </select></td>


        </tr>
         <tr> <td> Kamera (Sekunder) </td>
            <td> <select name="sekunder"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['sekunder'])?($skala['sekunder']=='1'? 'selected':''):'')?>> < 1MP </option>
                    <option value="2" <?php echo (isset($skala['sekunder'])?($skala['sekunder']=='2'? 'selected':''):'')?>> 1MP - 2MP </option>
                    <option value="3" <?php echo (isset($skala['sekunder'])?($skala['sekunder']=='3'? 'selected':''):'')?>> > 2MP </option>
                 </select></td>


        </tr>
        <tr> <td> Sistem Operasi </td>
            <td> <select name="os_nama"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['os_nama'])?($skala['os_nama']=='1'? 'selected':''):'')?>> < Froyo </option>
                    <option value="2" <?php echo (isset($skala['os_nama'])?($skala['os_nama']=='2'? 'selected':''):'')?>> Froyo </option>
                    <option value="3" <?php echo (isset($skala['os_nama'])?($skala['os_nama']=='3'? 'selected':''):'')?>> Gingerbread (2.3)</option>
                    <option value="4" <?php echo (isset($skala['os_nama'])?($skala['os_nama']=='4'? 'selected':''):'')?>> Honeycomb </option>
                    <option value="5" <?php echo (isset($skala['os_nama'])?($skala['os_nama']=='5'? 'selected':''):'')?>> Ice Cream Sandwich (4.0)</option>
                    <option value="6" <?php echo (isset($skala['os_nama'])?($skala['os_nama']=='6'? 'selected':''):'')?>> Jelly Bean (4.1)</option>
                </select></td>
        </tr>
        <tr> <td> CPU Core </td>
            <td> <select name="cpu_core"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['cpu_core'])?($skala['cpu_core']=='1'? 'selected':''):'')?>> Single-core </option>
                    <option value="2" <?php echo (isset($skala['cpu_core'])?($skala['cpu_core']=='2'? 'selected':''):'')?>> Dual-core </option>
                    <option value="3" <?php echo (isset($skala['cpu_core'])?($skala['cpu_core']=='3'? 'selected':''):'')?>> Quad-core </option>

                </select></td>
        </tr>
        <tr> <td> Kapasitas CPU </td>
            <td> <select name="kapasitas_cpu"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['kapasitas_cpu'])?($skala['kapasitas_cpu']=='1'? 'selected':''):'')?>> < 600 MHz</option>
                    <option value="2" <?php echo (isset($skala['kapasitas_cpu'])?($skala['kapasitas_cpu']=='2'? 'selected':''):'')?>> 600 MHz - 800 MHz </option>
                    <option value="3" <?php echo (isset($skala['kapasitas_cpu'])?($skala['kapasitas_cpu']=='3'? 'selected':''):'')?>> 800 MHz - 1 GHz </option>
                    <option value="4" <?php echo (isset($skala['kapasitas_cpu'])?($skala['kapasitas_cpu']=='4'? 'selected':''):'')?>> 1GHz - 1.2 GHz</option>
                    <option value="5" <?php echo (isset($skala['kapasitas_cpu'])?($skala['kapasitas_cpu']=='5'? 'selected':''):'')?>> > 1.2 GHz</option>

                </select></td>
        </tr>
        <tr> <td> GPU </td>
            <td> <select name="gpu"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['gpu'])?($skala['gpu']=='1'? 'selected':''):'')?>> Broadcom </option>
                    <option value="2" <?php echo (isset($skala['gpu'])?($skala['gpu']=='2'? 'selected':''):'')?>> Mali </option>
                    <option value="3" <?php echo (isset($skala['gpu'])?($skala['gpu']=='3'? 'selected':''):'')?>> Adreno </option>
                    <option value="4" <?php echo (isset($skala['gpu'])?($skala['gpu']=='4'? 'selected':''):'')?>> PowerVR </option>

                </select></td>
        </tr>
        <tr> <td> Kapasitas Baterai </td>
            <td> <select name="kapasitas_baterai"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['kapasitas_baterai'])?($skala['kapasitas_baterai']=='1'? 'selected':''):'')?>> < 1000mAh </option>
                    <option value="2" <?php echo (isset($skala['kapasitas_baterai'])?($skala['kapasitas_baterai']=='2'? 'selected':''):'')?>> 1000mAh - 1500mAh </option>
                    <option value="3" <?php echo (isset($skala['kapasitas_baterai'])?($skala['kapasitas_baterai']=='3'? 'selected':''):'')?>> 1500mAh - 2000mAh </option>
                    <option value="4" <?php echo (isset($skala['kapasitas_baterai'])?($skala['kapasitas_baterai']=='4'? 'selected':''):'')?>> > 2000mAh </option>

                </select></td>
        </tr>
        <tr> <td> Ukuran Layar </td>
            <td> <select name="ukuran_layar"><option value="NULL">Pilih</option>
                    <option value="1" <?php echo (isset($skala['ukuran_layar'])?($skala['ukuran_layar']=='1'? 'selected':''):'')?>> < 3 inch </option>
                    <option value="2" <?php echo (isset($skala['ukuran_layar'])?($skala['ukuran_layar']=='2'? 'selected':''):'')?>> 3 inch - 4 inch </option>
                    <option value="3" <?php echo (isset($skala['ukuran_layar'])?($skala['ukuran_layar']=='3'? 'selected':''):'')?>> 4 inch - 5 inch </option>
                    <option value="4" <?php echo (isset($skala['ukuran_layar'])?($skala['ukuran_layar']=='4'? 'selected':''):'')?>> > 5 inch </option>

                </select></td>
        </tr>
        
        
    </tbody>
    </table>
    <button type="submit" name="hitung" class="btn btn-primary"> Cari </button>
</form>
</div>
</div>
<?php
include_once 'footer.php';
?>