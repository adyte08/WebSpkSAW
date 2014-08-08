<div class="span8">
<?php 
//ambil db merek
if(isset($_GET['merek'])){
    if(!empty($_GET['merek'])){
        
//kalo tombol tambah di klik, tampilan file add_hp
    if(isset ($_GET['delete_hp'])){
        $sql= "DELETE FROM `spesifikasi` WHERE `ID`='".$_GET['delete_hp']."'";
        if (mysql_query($sql)) 
        $_SESSION ['delete']='<div class="alert alert-success"> Data berhasil dihapus </div>';
    else 
        $_SESSION ['delete']='<div class="alert alert-error"> Data gagal dihapus </div>';
        echo '<script> window.location.href="mobile.php?merek='.$_GET['merek'].'"</script>';
    }
    else {
// --------------------Judul &  tombol tambah data hp baru-----------------------------------------------------------
        if (isset ($_SESSION ['update'])){
            echo $_SESSION ['update'];
            unset ($_SESSION ['update']);
        }
        if (isset ($_SESSION ['add'])){
            echo $_SESSION ['add'];
            unset ($_SESSION ['add']);
        }
        if (isset ($_SESSION ['delete'])){
            echo $_SESSION ['delete'];
            unset ($_SESSION ['delete']);
        }

    echo '<h3>'.$_GET['merek'].'</h3>';
    echo '<a class="btn" href="tambah_hp.php?merek='.$_GET['merek'].'">Tambah Handphone</a><br/><br/>';
//-------------------------------------------------------------------------------
    
    
    $sql = "SELECT * FROM merek_hp";
    $result = mysql_query($sql);
    $limit = 10;
//buat link paging sesuai dengan total data hp berdasarkan merek - ke tampilan A
    $sql_page = "SELECT * FROM spesifikasi WHERE `nama_merek`='".$_GET['merek']."'";
    $result_page = mysql_query($sql_page);
    $total_data = mysql_num_rows($result_page);
    $total_page = ceil($total_data / $limit);
    
        if(!empty($total_page)){
        $page = '<div class="pagination pull-right" style="float:none; margin:0 auto"><ul>';
        for($i=1;$i<=$total_page;$i++){
            $page .= '<li '.((isset($_GET['page']) && $_GET['page']==$i)?'class="active"':'').'><a href="mobile.php?merek='.$_GET['merek'].'&page='.$i.'">'.$i.'</a></li>';
        }
        $page.= '</ul></div>';
        }
        
//ambil data spefikasi berdasarkan merek dan sesuai page link
        if(isset($_GET['page'])){
            $offset = ($_GET['page'] - 1) * $limit;
        }
        else{
            $offset = 0;
        }
        
        $sql = "SELECT * FROM spesifikasi WHERE `nama_merek` = '".$_GET['merek']."' ORDER BY `ID` DESC LIMIT $offset,$limit";
        $result = mysql_query($sql)or die (mysql_error());
        echo '<table class="table table-bordered">';
        echo '<thead>
            <th>Gambar</th>
            <th>Nama Handphone</th>
            <th>Harga Baru</th>
            <th>Harga Bekas</th>
            <th>Kelola</th>
            </thead>';
        echo '<tbody>';
        while($data=mysql_fetch_object($result)){
            echo '<tr><td><img src="../img/upload/'.$data->gambar.'" style="width:40px; height:60px;"></td>
                <td>'.$data->versi_hp.'</td>
                <td>'.$data->harga_baru.'</td>
                <td>'.$data->harga_bekas.'</td>
                <td><a href="ubah_hp.php?merek='.$_GET['merek'].'&id='.$data->ID.'">Ubah</a>
                <td><a href="#" onclick="delete_confirm2(\''.$data->ID.'\')">Hapus</a></tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    }
    }
    else {
        
/*-------------- Penejelasan Informasi ketika merek hp belum dipilih -----------------------------------------*/
        echo '<h4>Pilih Merek HP di samping, untuk : </h4>
              <ul>
              <li>Menambah Data</li>
              <li>Melihat Data</li>
              <li>Mengedit Data</li>
              <li>Menghapus Data</li>
              </ul>';
    }

?>
     <?php
 echo '<div style="width:100%; text-align:center;float:left">'.$page.'</div>';
?>
</div><!-- span10 -->

<script>
    function delete_confirm2(id){
        var id_hp = id;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'mobile.php?merek=<?php echo $_GET['merek'];?>&delete_hp='+id_hp;
        });
        confirmModal.modal('show');      
    }
</script>