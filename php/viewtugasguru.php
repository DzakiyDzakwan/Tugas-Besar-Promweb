<?php 
//function
require 'function.php';

//Session
session_start();

if(!isset($_SESSION["login"])) {
    header('Location: login.php');
}

if (isset($_SESSION["member"])) {

    if ($_SESSION["member"] !== "guru" ) {
        header('Location: dashboard.php');
    }

}

//Id kelas & tugas Kelas
$kelasID = $_GET["kelasID"];
$tugasID = $_GET["tugasID"];

//Siswa
$siswa = show("SELECT * FROM siswa WHERE kelas_id = $kelasID");
$jumlahSiswa = count($siswa);

//Pagination
$totalData = count(show("SELECT * FROM jawaban WHERE tugas = $tugasID"));
$dataPerHalaman = 4;
$jumlahHalaman = ceil($totalData/$dataPerHalaman);

if(isset($_GET["page"])) {
    $halamanAktif = $_GET["page"];
} else {
    $halamanAktif = 1;
}

$dataAwal = ($halamanAktif * $dataPerHalaman) - $dataPerHalaman;


//Jawaban
$jawaban = show("SELECT jawaban.id as id, jawaban.jawaban as jawaban, jawaban.nilai as nilai, siswa.id as siswa_id, siswa.nama_siswa as nama_siswa FROM jawaban JOIN siswa on jawaban.siswa = siswa.id WHERE tugas = $tugasID LIMIT $dataAwal, $dataPerHalaman");

//nilaiTugas
if(isset($_POST["nilaiTugas"])) {
    if(editNilai($_POST) > 0) {
        header("Location: viewtugasguru.php?tugasID=$tugasID&kelasID=$kelasID");    
    }
}

//namaTUgas
$tugas = show("SELECT nama_tugas FROM tugas WHERE id = $tugasID")[0];

//var_dump($tugas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageViewTugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/viewtugasguru.css">
</head>
<body>

    <?php include "navbar.php" ?>

      <!-- Isi Konten -->
     
        <div class="container main-container my-3 py-2 px-4 border">

             <!-- BREADCRUMB -->
             <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="kelaspage.php?kelas=2">Kelas</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tugas</li>
                </ol>
            </nav>

            <div class="row">

                <div class="col-lg-5 container-left">

                    <h4>Siswa</h4>

                        <div class="my-4 list-student">

                            <h5>Yang Sudah mengumpulkan</h5>

                            <ol class="list-group list-group-numbered shadow">
                                
                                <div class="overflow-auto" style="height: 210px;">

                                <?php foreach($jawaban as $jwbn) : ?>
                                    <li class="list-group-item"><?=$jwbn["nama_siswa"]?></li>
                                <?php endforeach ; ?>

                                </div>

                            </ol>


                        </div>

                        <div class="my-4 list-student">

                            <h5>Yang Belum mengumpulkan</h5>

                            <ol class="list-group list-group-numbered">
                                
                                <div class="overflow-auto shadow" style="height: 210px;">

                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>

                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>

                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>

                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>

                                </div>

                            </ol>


                        </div>

                </div>

                <div class="col-lg-7 container-right">
                    
                    <!-- DESCRIPTION BOX -->
                    <div class="task-desc shadow">
                        <h4 class="text-center my-3"><?=$tugas["nama_tugas"]?></h4>

                        <!-- Description TUGAS -->
                        <div class="description my-2">
                            <table class="table table-borderless mx-auto" style="text-align: center; width: 80%;">
                                <tr>
                                    <th>Jumlah Siswa</th>
                                    <th>Finish</th>
                                    <th>Unfinished</th>
                                </tr>
                                <tr>
                                    <td><?=$jumlahSiswa?></td>
                                    <td><?=$totalData?></td>
                                    <td>51</td>
                                </tr>
                            </table>
                        </div>
        

                    </div>

                    <!-- ASSIGNMENT BOX -->
                    <div class="assignment-box shadow border my-3">

                        <h4 class="text-center my-1">List Jawaban</h4>

                        <div class="assignment-card px-3 py-1">

                            <div class="row">

                                <?php foreach($jawaban as $jwbn) : ?>
                                    <div class="col-lg-3 my-2">

                                        <div class="card w-100 text-center">
                                            <div class="card-body">
                                            <h6 class="card-title"><?=$jwbn["nama_siswa"]?></h6>
                                            <a class="" href="" download=""><?=$jwbn["jawaban"]?></a>
                                            <form class="mt-2" method="POST">
                                                <input type="hidden" name="id" value="<?=$jwbn["id"]?>">
                                                <input type="number" name="nilai" class="form-control" value="<?=$jwbn["nilai"]?>" style="text-align: center;">
                                                <button class="mt-3 btn btn-success" name="nilaiTugas">Nilai</button>
                                            </form>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach ; ?>
                                

                            </div>
                            
                            <!-- PAGINATION -->
                            <?php include 'pagination.php' ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>