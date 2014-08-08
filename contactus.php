<?php
//pemanggilan koneksi.php
include_once 'header.php';
include_once 'koneksi.php';
session_start();
?><!DOCTYPE html>


<?php
if(isset($_POST['kirim'])){
    $tanggal=date('Y-m-d H:i:s');
    $nama=$_POST['nama'];
    $email=$_POST['email'];
    $subjek=$_POST['subjek'];
    $pesan=$_POST['pesan'];
    $query=mysql_query("INSERT INTO `pesan_masuk` values('','$tanggal','$nama','$email','$subjek','$pesan','0')")or die (mysql_error());
  if ($query){
   echo '<p class="alert alert-success span10">Terima kasih atas pesan yang Anda kirimkan</p>';
}
else {
    echo '<p class="alert alert-error span10">Ada kesalahan</p>';
}

}

?>

<style>
    label{float:left;width:100px;}
</style>

<div class="span10">
    

    <h3> Kontak Kami </h3><hr>
    Jika ada pertanyaan, saran atau kritik dan infromasi lain silahkan menghubungi kami melalui form dibawah ini, Terima kasih.
<form action="contactus.php?contactus" method="POST" class="form-inline" style="margin-top:30px;">
    <label> Nama : </label> <input type="text" name="nama">
    <br><br>
    <label> Email : </label> <input type="text" name="email">
    <br><br>
    <label> Subjek : </label> <input type="text" name="subjek">
    <br><br>
    <label> Pesan : </label> <textarea name="pesan"></textarea>
    <br><br>
    <button type="submit" class="btn btn-primary" name="kirim">kirim</button>
</form>
</div>
    

     
<?php
include_once 'footer.php';
?>