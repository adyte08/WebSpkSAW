<?php
$field = array('username','password');
$error = array();
$msg = array();

if(isset($_POST['login'])){
    foreach($field as $f){
        if(!isset($_POST[$f]) or !$_POST[$f]){
            $error[] = $f; //$error = array('username','password');
            $msg[$f] = $f.' harus diisi';
        }  else {
            if(!preg_match('%[a-zA-Z0-9_]%', $_POST[$f]))
            $error[] = $f;
            $msg[$f] = $f.' hanya alfabet dan angka yang diperbolehkan';
        }    
    }
}
function isValid($fieldName,$msg,$error){
    if(isset($_POST['login'])){
        if($fieldName == 'username'){
            if (in_array('username',$error))
            return $msg[$fieldName];
        }
        if($fieldName == 'password'){
            if (in_array('password',$error))
            return $msg[$fieldName];
        }
    }
}
function isError($error){
    if($error){
        echo "<script>
            $(document).ready(function(){
                $('.dropdown-toggle').dropdown('toggle');
               
            });
            
        </script>";
    }else{
        //cek ke database
        if(isset($_POST['login'])){
            
          $username = $_POST['username'];
                        $password = md5($_POST['password']);
                        //select username dan password dr db 
                        $sql = "SELECT * FROM users WHERE `Username`='$username' AND `Password`='$password' AND (`Hak_Akses`='Editor' OR `Hak_Akses`='Admin')";
                        $result = mysql_query($sql);
                        $num = mysql_num_rows($result);
                        //bila ada yg cocok, berarti user terdaftar
                        if($num > 0){
                            $data = mysql_fetch_assoc($result);
                        //set $_SESSION['isAdmin'] = TRUE
                            $_SESSION['isAdmin'] = TRUE;
                            $_SESSION ['adminname'] = $data['Username'];
                            $_SESSION['hak_akses'] = $data ['Hak_Akses'];
                            echo '<script> window.location.href="index.php" </script>';
                        }  

            else{
                 echo "<script>
                        $(document).ready(function(){
                            $('.dropdown-toggle').dropdown('toggle');       
                        });
                        </script>
                        <p class='text-warning'>Username tidak terdaftar</p>";
            
            }
        }
    }
}

 