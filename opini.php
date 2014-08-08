<?php
include_once 'header.php';
if (isset($_SESSION['message'])){
    echo'<p class="alert alert-success span10">'.$_SESSION['message'].'</p>';
unset ($_SESSION['message']);}
/*----------Proses input opini---------------*/
if(isset($_POST['opini']))
    {
        $id_hp = $_GET['opini'];
        $date = date('Y-m-d H:i:s');
        $opini = $_POST['review'];
        $username = $_POST['username'];
        $sql = "INSERT INTO opini VALUES('','$id_hp','$opini','$username','$date','0')";
        mysql_query($sql)or die(mysql_error());
        $_SESSION['message']='Terima kasih telah memberikan opini Anda';
        echo '<script>window.location.href="opini.php?opini='.$id_hp.'"</script>';
    }
    
$id_hp = $_GET['opini'];
$versi_result = mysql_query("SELECT versi_hp FROM `spesifikasi` WHERE `ID`='$id_hp'");
$rawdata = mysql_fetch_assoc($versi_result);
$versi = $rawdata['versi_hp'];
    
/*-------------------Form opini--------------------------------*/
if(!isset($_GET['readall']))
    {
    
?>
    <div class="span10">
    <h4> Post opini kamu tentang <?php echo $versi;?> </h4>
    <!-- --------------------Form opini user----------------------------------------------------------- -->
    <form class="form-horizontal well" action="opini.php?opini=<?php echo $_GET['opini'];?>" method="POST" id="opini_form">
        <div class="control-group">
            <label class="control-label"> Nama </label>
            <div class="controls" style="padding-top: 5px">
                <input type="text" name="username" value="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"> Opini </label>
            <div class="controls"><textarea name="review"></textarea>
                <br><br> 
                <input type="submit" name="opini" class="btn btn-primary" value="Kirim">
                <input type="reset" name="reset" class="btn">
            </div>
        </div>
    </form>
        <?php
    }
        echo '<div class="span10">';
        echo '<h4>'.$versi.' user opini dan review</h4>';
        echo '<a href="spesifikasi.php?spesifikasi='.$_GET['opini'].'" class="btn"> Kembali </a>';
        $id_hp = $_GET['opini'];
        $limit = 20;

        if(isset($_GET['page']))
            {
            $page = $_GET['page'];
    $offset = ($page -1)*$limit;
}else{
    $offset = 0;
}

$sql = "SELECT * FROM `opini` WHERE `id_hp`='".$id_hp."' AND approved = '1'";
$row = mysql_query($sql);
$total = mysql_num_rows($row);
$total_link = ceil($total/$limit);
$page = '<div class="pagination pull-right" style="float:none; margin:0 auto"><ul>';
for($i=1;$i<=$total_link;$i++){
    if(isset($_GET['readall'])){
        $page .= '<li><a href="opini.php?opini='.$id_hp.'&readall&page='.$i.'">'.$i.'</a></li>';
    }else{
        $page .= '<li><a href="opini.php?opini='.$id_hp.'&page='.$i.'">'.$i.'</a></li>';
    }
}
$page .= '</ul></div>';
$sql2 = "SELECT * FROM `opini` WHERE `id_hp`='".$id_hp."' AND approved ='1'  ORDER BY `tanggal` DESC LIMIT $offset,$limit";
$result_opini = mysql_query($sql2) or die(mysql_error());
    echo '<table class="table" style="margin-top:20px;">';
    while ($data_opini = mysql_fetch_object($result_opini)){
        echo '<tr><td><p><strong>'.$data_opini->username.'</strong><span class="pull-right">'.$data_opini->tanggal.'</span></p>';
        echo  '<p class="echtul">'.$data_opini->opini.'</p></td></tr>';
    }
    echo '</table>';
    
echo '<div style="width:100%; text-align:center;float:left">'.$page.'</div>';

    echo '</div>';
    echo '</div>';
    include_once 'footer.php';
?>