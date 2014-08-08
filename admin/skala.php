<?php
function hitung_skala($nilaiatrhp, $idkriteria, $tipe){
    $sql = "SELECT * FROM kriteria_atribut WHERE id_kriteria = '$idkriteria'";
    $res = mysql_query($sql);
    $tipe;
    if($tipe == 'varchar'){
       $nilaiatrhp = "'".$nilaiatrhp."'";
    }
    elseif ($tipe == 'int'){
        $nilaiatrhp=(preg_replace("/[^0-9.]/","",$nilaiatrhp));	
    }
    $flag = false;
    while($data = mysql_fetch_assoc($res)){
       $rumus = str_replace('x', $nilaiatrhp, $data['rumus']);
       if(eval("return ".$rumus.";")){

          return $data['bobot'];
          $flag = true;
        }
    }
    if ($flag== false){
        return 0;
    }
}
?>
