<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


require_once ('../../koneksi.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email']) && isset($data['password']) ){

    $email = $data['email'];
    $pass = $data['password'];

    if ($email == '' || $pass == ''){
        $hasil = '';
        $pesan = 'Email dan password harus diisi';
        $eror = true;

    } else {
        $sql = "select * from users where email =:email";
        $stmt = $db->prepare($sql);
        $param = array(
            ":email" => $email
        );
        $stmt->execute($param);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //jika user terdaftar
        if ($user){
            if ( password_verify($pass,$user['password']) ){
                $hasil = $user;
                $pesan = 'Login OK';
                $eror = false;
            } else{
                $hasil = '';
                $pesan = 'Password salah';
                $eror = true;
            }
        } else{
            $hasil = '';
            $pesan = 'User tidak ditemukan';
            $eror = true;
        }
    }
} else {
    $hasil = '';
    $pesan = 'Data tidak lengkap';
    $eror = true;

}
$arr=array("error"=>$eror,"pesan"=>$pesan,"hasil"=>$hasil);
echo json_encode($arr);

?>

