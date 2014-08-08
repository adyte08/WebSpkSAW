
<div class="span3">
    
<?php
if(isset($_GET['delete_merek'])){
    $sql = "DELETE FROM merek_hp WHERE `id`='".$_GET['delete_merek']."'";   
    $result = mysql_query($sql) or die(mysql_error());
    echo '<script>window.location.href="mobile.php"</script>';
}
else{
    $sql = 'SELECT * FROM merek_hp';
    $result = mysql_query($sql);
?>

<table class="table table-bordered">
    <thead>
        <th colspan="3"><center>Merek</center></th>
    </thead>
    <tbody>
        <tr>
            <td colspan="3">
                <center>
                    <a class="btn" href="addnew_merek.php">Tambah Merek</a>
                </center>
            </td>
        </tr>

<?php
while($data = mysql_fetch_object($result)){
    echo '<tr> 
        <td> <a href="mobile.php?merek='.$data->nama_merek.'">'.$data->nama_merek.' </a> </td>
        <td> <a href="edit_merek.php?id='.$data->id.'"> <i class="icon-pencil"> </i> </a> </td>
        <td> <a href="#" onclick="delete_confirm(\''.$data->id.'\')"> <i class="icon-trash"> </i> </a> </td>
        </tr>';
}
?>
    </tbody>
</table>
</div>

<script>
    function delete_confirm(id){
        var id_merek = id;
        var confirmModal = $('<div class="modal hide fade">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Konfirmasi</h3></div>'+
            '<div class="modal-body"><p>Anda yakin ingin menghapus?</p></div>'+
            '<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Batal</a>'+
            '<a href="#" class="btn btn-primary" id="okButton">Hapus</a></div></div>');
        confirmModal.find("#okButton").click(function(event){
            confirmModal.modal('hide');
            window.location.href = 'mobile.php?delete_merek='+id_merek;
        });
        confirmModal.modal('show');      
            
    }
</script>
<?php } ?>