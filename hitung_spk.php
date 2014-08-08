<?php
$merek = $_POST['merek'];

//--------Ambil matriks skala
$matriks = array();
$m_expand= array();
$bobot = 0;
$i =0;
$j=0;
$sql="SELECT * FROM skala WHERE nama_merek ='".$merek."'";
$result=  mysql_query($sql);
while($data=  mysql_fetch_assoc($result)){
    //matrix
    $matriks[$data['id_skala']][0]=$data['versi_hp'];
    $matriks[$data['id_skala']][1]=$data['id_hp'];
    
    //matrix expand
    $m_expand[$data['id_skala']][0]=$data['versi_hp'];
    $m_expand[$data['id_skala']][1]=$data['id_hp'];
    
    //-------ambil kriteria field - isi kriteria matriks sesuai database, jd dinamis
    $i=2;
    $j=2;
    
    $res = mysql_query("SELECT * FROM kriteria");
    while($dat = mysql_fetch_assoc($res)){
        $matriks[$data['id_skala']][$i]=$data[$dat['field']];
        $i++;
        $x=1;
        //--- buat matriks 0 0 0 5 0
        //-------------ambil atribut kriteria untuk membuat ekspand matriks
         $res2 = mysql_query("SELECT * FROM kriteria_atribut WHERE id_kriteria = '".$dat['id_kriteria']."'");
         while($dat2 = mysql_fetch_assoc($res2)){
             if($x==$data[$dat['field']]){
                 $m_expand[$data['id_skala']][$j]=5;
             }else{
                 $m_expand[$data['id_skala']][$j]=0;
             }
            $x++;
            $j++;
         } 
    }     
}

//-----normalisasi 
$normalisasi = array();
foreach ($m_expand as $key=>$m){
    $normalisasi[$key][0]=$m[0];
    $normalisasi[$key][1]=$m[1];
    for($i=2;$i<count($m);$i++){
    $normalisasi[$key][$i]= $m[$i]/5;
    }
}
//echo 'normalisasi<br>';
//print_r($normalisasi);

//------Ambil jawaban dari userinput
$postdata = array();
$k = 0;
$res_kriteria = mysql_query("SELECT * FROM kriteria");
while($dat = mysql_fetch_assoc($res_kriteria)){
    $postdata[$dat['id_kriteria']]=$_POST[$dat['field']];
    $k++;
}

$p_expand = array();
//------Expand matriks jadi 0 0 0 5 jawaban userinput
 $j=0;
foreach($postdata as $index=>$p){    //matrix
    //-------ambil kriteria field - isi kriteria matriks sesuai database, jd dinamis
        $x=1;
        //-------------ambil atribut kriteria untuk membuat ekspand matriks
         $res2 = mysql_query("SELECT * FROM kriteria_atribut WHERE id_kriteria ='$index'");
         while($dat2 = mysql_fetch_assoc($res2)){
             
             if($x == $p){
                 $p_expand[$j]=5;
             }else{
                 $p_expand[$j]=0;
             }
            
            $x++;
            $j++;
         } 
    }   
//    echo 'hasil expand user input<br>';
//print_r($p_expand);



$hasil= array();
foreach ($normalisasi as $key=>$m){
    $total = 0;
    $l =2;
    foreach($p_expand as $val){
       // echo $m[$l].'*'.$val.'='.($m[$l]*$val).'<br>';
        $total += ($m[$l]*$val);
        $l++;
    }
    $hasil[$key]['total']=$total;
    $hasil[$key]['versi_hp']=$m[0];
    $hasil[$key]['id_hp']=$m[1];
}
//echo 'hasil perhitungan <br>';
print_r($hasil);
arsort($hasil);
//print_r($hasil);
?>
