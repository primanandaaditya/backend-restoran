<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


require_once ('../../koneksi.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['nama']) && isset($data['email']) && isset($data['password']) && isset($data['cpassword']) ){

    $nama       = $data['nama'];
    $email      = $data['email'];
    $password   = $data['password'];
    $cpassword  = $data['cpassword'];

    if ($email == '' || $nama == '' || $password == '' || $cpassword == ''){
        $message="Semua input harus diisi";
        $status=0;
    } else {
        //jika password dan ulang password tidak sama
        //error
        if ( strcmp($password,$cpassword) !== 0 ){
            $err = 0;
            //jika password dan ulang password sama
            $message="Password tidak sama dengan konfirmasi password";
            $status=0;
        }else{
            //cek dulu
            $sql = "select * from users where email = :email";
            $stmt = $db->prepare($sql);
            $param = array(
                ":email" => $email
            );
            $stmt->execute($param);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //jika sudah ada
            if ($user){
                $message="Email ini sudah ada. Silakan diganti";
                $status=0;
            }else{
                //simpan
                $sql = "insert into users (email, password, nama) VALUES (:email, :password, :nama)";
                $stmt = $db->prepare($sql);

                //hash password
                $password=password_hash($data['password'], PASSWORD_DEFAULT);

                $param = array(
                    ":email" => $email,
                    ":password" => $password,
                    ":nama" => $nama
                );
                $saved = $stmt->execute($param);

                $message="Register OK";
                $status=1;
            }
        }
        $arr=array("status"=>$status,"message"=>$message);
        echo json_encode($arr);
    }
}
?>
