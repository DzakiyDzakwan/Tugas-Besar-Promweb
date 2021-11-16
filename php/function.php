<?php

$connection = mysqli_connect("localhost","root","","tubes");

function daftar($data) {

global $connection;

$username = strtolower(stripslashes($data["uname"]));
$email = stripslashes($data["email"]);
$password = mysqli_real_escape_string($connection, $data["password1"]);
$password2 = mysqli_real_escape_string($connection, $data["password2"]);
$status = strtoupper($data["status"]);


//check data kosong
if (empty($username) || empty($password) || empty($email) || empty($password2) ) {
    return false;
}

//Check Ketersediaan email
$emailCheck = mysqli_query($connection, "SELECT email FROM user WHERE email = '$email'");

if(mysqli_fetch_assoc($emailCheck)) {
    return false;
}

//check ketersedian username
$usernameCheck = mysqli_query($connection, "SELECT username FROM user WHERE username = '$username'");

if (mysqli_fetch_assoc($usernameCheck)) {
    return false;
}

 //passwordconfirmation
 if ($password !== $password2) {
    return false;
}

//passwordhash

$password = password_hash($password, PASSWORD_DEFAULT);



$insert = mysqli_query($connection, "INSERT INTO user(username,password,email,status) VALUES ('$username','$password','$email','$status')");

return mysqli_affected_rows($connection) ;

}

function login($data) {

global $connection ;

$username = $data["uname"];
$password = $password;

//check username

$dataCheck = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");

if (mysqli_num_rows($dataCheck) > 0) {

    $row = mysqli_fetch_assoc($dataCheck);


}

}


function addGuru($data) {

    global $connection;

    $nama = $data["nama"];
    $nig = $data["nig"];
    $userid = $data["userid"];
    $mapel = $data["mapel"];

    if(empty($nama) || empty($nig)) {
        return false ;
    }

    $query = mysqli_query($connection, "INSERT INTO guru(nama_guru,NIG,user_id,mapel_id) VALUES('$nama','$nig',$userid,$mapel)");

    return mysqli_affected_rows($connection);

    /* var_dump($nama);
    var_dump($userid);
    var_dump($mapel);
    var_dump($nig);

    return 0; */
}

function addSiswa($data){

    global $connection;

    $nama = $data["nama"];
    $nis = $data["nis"];
    $userid = $data["userid"];
    $kelas = $data["kelas"];

    if(empty($nama) || empty($nis)) {
        return false ;
    }

    $query = mysqli_query($connection, "INSERT INTO siswa(nama_siswa,NIS,user_id,kelas_id) VALUES('$nama','$nis',$userid,$kelas)");

    return mysqli_affected_rows($connection);

}

function show($query) {

    global $connection;

    $box = [];

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)) {

        $box[] = $row;

    }

    return $box;
}

?>