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

$mapelID = $_GET["mapel"];

$mapel = show("SELECT * FROM mapel WHERE id = $mapelID")[0];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewMapel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/viewmapel.css">
</head>
<body>

<?php include 'navbar.php' ?>

      <!-- Isi Konten -->
      <div class="container py-4 my-4 px-4 border">

        <!-- BREADCRUMB -->
        <nav aria-label="breadcrumb" class="mx-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mapel</li>
            </ol>
        </nav>

        <?php

          $kelas = $data["kelas_id"];
          $namaGuru = show("SELECT guru.nama_guru, guru.id FROM mapel_kelas JOIN guru ON mapel_kelas.guru = guru.id WHERE mapel_kelas.kelas = $kelas AND guru.mapel_id = $mapelID")[0];
          $guruID = $namaGuru["id"];
          $tugas = show("SELECT * FROM tugas WHERE guru = $guruID AND kelas = $navbarID");
        
        ?>
        
          <h3 class="mx-auto"><?=$mapel["nama_mapel"]?></h3>
          <p class="mx-auto"><?=$namaGuru["nama_guru"]?></p>

          <div class="list-tugas">

              <h4>List Tugas</h4>

              <!-- ACCORDION TUGAS -->
              <div class="accordion" id="accordionPanelsStayOpenExample">
                  <?php foreach($tugas as $tgs) :?>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?=$tgs["id"]?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <?=$tgs["nama_tugas"]?>
                      </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne<?=$tgs["id"]?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                      <div class="accordion-body">
                        <?php $date = date('d M Y',strtotime($tgs["deadline"]));?>
                          <p><?=$tgs["deskripsi"]?></p>
                          <h6>Deadline = <?=$date?></h6>
                          <a class="link-tugas" href="viewtugas.php?tugas=<?=$tgs["id"]?>&mapel=<?=$mapelID?>">lihat tugas</a>
                      </div>
                    </div>
                  </div>
                  <?php endforeach ; ?>
              </div>

          </div>
        
      </div>

      
      
      



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>