<?php 

//function
require 'function.php';

//Session
session_start();

if(!isset($_SESSION["login"])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewKelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/viewkelas.css">
</head>
<body>

<?php include 'navbar.php' ?>

      <!-- Isi Konten -->

      <div class="container main-container my-3 px-4 py-2 border">

            <!-- BREADCRUMB -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                </ol>
            </nav>
            
            <div class="header border my-3 py-3 px-3 shadow-sm">

                <div>
                    <div>
                        <h4 class="my-0">Kelas 12 A IPA</h4>
                        <span>Wali Kelas</span>
                    </div>
                    <div class="create-tugas">

                    </div>
                </div>

                <div class="description my-3">
                    <table class="table table-borderless" style="text-align: center;">
                        <tr>
                            <th>Jumlah Siswa</th>
                            <th>Jumlah Tugas</th>
                        </tr>
                        <tr>
                            <td>54</td>
                            <td>3</td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="body my-3 px-3 my-3">

                <h4>List Tugas</h4>

                <div class="list-tugas">

                </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Tugas #1
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <p>

                                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </p>
                                    <div class="d-flex">
                                        <a class="link-tugas mx-2" href="">See <i class="far fa-eye"></i></a> 
                                        <a class="link-delete mx-2" href="">Delete <i class="fas fa-trash"></i></a>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
        
        
                    </div>

            </div>

            <div class="footer my-3 px-3 py-3 d-flex ">

            <!---CREATE TUGAS-->
                <div class="create-tugas">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#tugasModal">
                        Create Tugas
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tugasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 700px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="" method="POST">
                                    <div class="modal-body">

                                        <!---FORM TUGAS--->
                                        <table class="table table-borderless">
                                         
                                            <tr>
                                                <td>
                                                    <label for="nama">Nama tugas</label>
                                                    <input class="form-control" placeholder="Masukkan nama tugas" type="text" name="namatugas" id="nama">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="description">Deskripsi Tugas</label>
                                                    <textarea class="form-control" placeholder="Masukkan Deskripsi Tugas"  name="deskripsi" id="description"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="date">Tanggal Deadline</label>
                                                    <input class="form-control" type="date" id="date" name="deadline">
                                                </td>
                                            </tr>

                                        </table>
                                    
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary form-control" name="create" > Create </button>
                                    </div>
                            
                                    <tr>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        })
    </script>
</body>
</html>