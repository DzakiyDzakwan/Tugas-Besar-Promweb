<?php

session_start();

// if(isset($_SESSION["login"])) {
//     header('Location: login.php');
// }

require 'function.php';

//pagination
$totalData = count(show("SELECT * from user")) ;

$dataPerhalaman = 5;

$jumlahHalaman = ceil($totalData/$dataPerhalaman);

if (isset($_GET["page"])) {
    $halamanAktif = $_GET["page"];
} else {
    $halamanAktif = 1;
}

$dataAwal = ($halamanAktif * $dataPerhalaman) - $dataPerhalaman;

$user = show("SELECT * from user LIMIT $dataAwal, $dataPerhalaman");
$id = $dataAwal + 1;


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/template.css">
</head>
<body>

   <?php include 'navbar.php' ?>
    
      <!-- offcanvas -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 350px;">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" style="text-align: center; flex-grow: 1;">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- offcanvas-Body -->
        <div class="offcanvas-body">
            <!-- Accordion -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
        
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="me-2 fas fa-user-shield"></i>Admin 
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <div class="list-group">
                            <a href="admin.html" class="list-group-item list-group-item-action">Dashboard <i class="ms-2 fas fa-tachometer-alt"></i></a>
                            <a href="createmapel.html" class="list-group-item list-group-item-action">Add Mata Pelajaran <i class="ms-2 fas fa-plus"></i></a>
                            <a href="createclass.html" class="list-group-item list-group-item-action">Add Kelas <i class="ms-2 fas fa-plus"></i></a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class=" me-2 fas fa-table"></i>Table 
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <div class="list-group">
                            <a href="siswa.html" class="list-group-item list-group-item-action">Siswa</a>
                            <a href="guru.html" class="list-group-item list-group-item-action">Guru</a>
                            <a href="kelas.html" class="list-group-item list-group-item-action">Kelas</a>
                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="me-2 fas fa-chalkboard"></i>Mapel
                        </button>
                    </h2>
                    <div id="flush-collapseTree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <div class="list-group">
                            <ul>
                            <li><a href="#" class="list-group-item list-group-item-action">Matematika</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action">B.Indonesia</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action">Pancasila</a></li>
                            </ul>           
                        </div>
                        </div>
                    </div>
                    </div>
    
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="me-2 fas fa-tasks"></i>Tugas
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="list-group">
                                <ul>
                                <li><a href="#" class="list-group-item list-group-item-action">Membuat Diagram Sesuai dengan kaidah nya masing masing</a></li>
                                <li><a href="#" class="list-group-item list-group-item-action">Website Sederhana</a></li>
                                <li><a href="#" class="list-group-item list-group-item-action">blablabla</a></li>
                                </ul>           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    
    <div class="container my-4 px-4 py-3 table-data">

        <!--Data Table-->

        <div class="table-title">
          <h4>List User</h4>
        </div>
        
       <!--  Searchbar -->
        <form class="d-flex search my-3 mx-auto">
          <input class="form-control me-2" type="search" placeholder="Search Siswa" aria-label="Search" name="search" autocomplete="off">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <select class="btn ms-3 btn-outline-dark" name="" id="">
            <option value="">Status</option>
            <option value="">Siswa</option>
            <option value="">Guru</option>
            <option value="">Admin</option>
          </select>
        </form>

        <div class="container-fluid mt-3">
          <table class="mx-auto" style="width : 80%;">

            <tr class="thead">
              <td class="table-header">No. </td>
              <td class="table-header">Username</td>
              <td class="table-header">Email</td>
              <td class="table-header">Status</td>
              <td class="table-header">Created At</td>
                <?php if(isset($_SESSION["admin"])) : ?>
                  <td class="table-header">Action</td>
                <?php endif ; ?>
            </tr>
  
            <?php foreach($user as $usr) : ?>
              <tr class="tbody">
                <td class="table-body"><?= $id ?></td>
                <td class="table-body"><?php echo $usr["username"] ?></td>
                <td class="table-body"><?= $usr["email"] ?></td>
                <td class="table-body"><?= $usr["status"] ?></td>
                <td class="table-body"><?= $usr["Created_at"] ?></td>
                  <?php if(isset($_SESSION["admin"])) : ?> 
                    <td>
                      <a href="" class="btn btn-success">Edit</a>
                      <a href="" class="btn btn-danger">Delete</a>
                    </td>
                  <?php endif ; ?>
              </tr>
          <?php $id ++ ?>   
          <?php endforeach ; ?>
          </table>
        </div>
        
        
        <!-- pagination -->
        <div class="my-3">
          <nav aria-label="Page navigation example" class="mx-auto new_pagination">
              <ul class="pagination justify-content-start">
                <?php for($j = 1; $j <= $jumlahHalaman ; $j ++) : ?>
                <li class="page-item"><a class="page-link" href="?page=<?=$j?>"><?=$j?></a></li>
                <?php endfor; ?>
              </ul>
          </nav>
        </div>


    </div>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>