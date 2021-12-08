<?php 

//function
require 'function.php';

//Session
session_start();

if(!isset($_SESSION["login"])) {
    header('Location: login.php');
}

if (isset($_SESSION["member"])) {

  if ($_SESSION["member"] !== "siswa" ) {
      header('Location: dashboard.php');

  }

}

$tugasID = $_GET["tugas"];
$mapelID = $_GET["mapel"];
$viewtugas = show("SELECT * FROM tugas JOIN guru ON tugas.guru = guru.id WHERE tugas.id = $tugasID")[0];

//Upload tugas
if(isset($_POST["upload"])) {
    
    //var_dump($_FILES);
    if(addJawaban($_POST) > 0) {
        header("Location: viewtugas.php?tugas=$tugasID&mapel=$mapelID");
    }

}

//Update tugas
if(isset($_POST["update"])) {

    if(updateJawaban($_POST) > 0) {
        header("Location: viewtugas.php?tugas=$tugasID&mapel=$mapelID");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewTugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/viewtugas.css">
</head>
<body>

    <?php include'navbar.php' ?>
      <!-- Isi Konten -->
        <div class="container py-4 my-4 px-2 border">

            <!-- BREADCRUMB -->
            <nav aria-label="breadcrumb" class="mx-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Mapel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tugas</li>
                </ol>
            </nav>

                <div class="header d-flex">
                    
                    <div class="header-description">
                        <div class="px-4">
                            <h3 class="task-title"><?=$viewtugas["nama_tugas"]?></h3>
                        </div>

                        <div class="guru px-4">
                            <p><?=$viewtugas["nama_guru"]?>, <?=$viewtugas["deadline"]?></p>
                        </div>
                    </div>

                    <div class="sbmt-task px-4">
                        <div class="box-sbmt border shadow px-3 py-3">

                            <?php
                             $siswaID = $data["id"];
                             $check = mysqli_query($connection, "SELECT * FROM jawaban WHERE siswa = $siswaID AND tugas = $tugasID");
                             $jawaban = show("SELECT * FROM jawaban WHERE siswa = $siswaID AND tugas = $tugasID")[0];
                             $jawabanID = $jawaban["id"];
                             $checkJawaban = mysqli_num_rows($check);
                            ?>


                            <?php if($checkJawaban == 0) : ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <p class="my-0 mx-auto">Document file : <span>pdf</span></p>
                                    <input  type="file" id="formFile" class="form-control-sm form-control" name="file">
                                    <input type="hidden" name="tugas" value="<?=$tugasID?>">
                                    <input type="hidden" name="siswa" value="<?=$siswaID?>">
                                    <input type="hidden" name="mapel" value="<?=$mapelID?>">
                                    <button class="btn mx-auto btn-outline-success my-2" name="upload">Upload<i class="mx-2 fas fa-file-upload"></i></button>
                                </form>
                            <?php else : ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <p class="my-0 mx-auto">Document file : <span>pdf</span></p>
                                    <input  type="file" id="formFile" class="form-control-sm form-control" name="file">
                                    <input type="hidden" name="jawaban" value="<?=$jawabanID?>">
                                    <button class="btn mx-auto btn-success my-2" name="update">Update<i class="mx-2 fas fa-file-upload"></i></button>
                                </form>
                            <?php endif ; ?>

                        </div>
                    </div>

                </div>

                <div class="px-4 my-3">
                    <hr style="width:100%;text-align:left;margin-left:0">
                </div>

                <div class="konten-tugas my-2 px-4">
                        <p><?=$viewtugas["deskripsi"]?></p>
                </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>

      