<?php

$connection = mysqli_connect("localhost","root","","tubes");

$id = $_SESSION["userID"];

if(isset($_SESSION["admin"])) {
   
    $admin = mysqli_query($connection, "SELECT username FROM user WHERE id = $id");

    $data = mysqli_fetch_assoc($admin);
} elseif (isset($_SESSION["member"])) {
    if ($_SESSION["member"] === "siswa") {
            $namaSiswa = mysqli_query($connection, "SELECT nama_siswa FROM siswa WHERE user_id = $id");

            $data = mysqli_fetch_assoc($namaSiswa);
    } else {

            $namaGuru = mysqli_query($connection, "SELECT nama_guru FROM guru WHERE user_id = $id");

            $data = mysqli_fetch_assoc($namaGuru);

    }
}

?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid border sticky-top">
        <div class="container navbar-head">
    
         <div class="logo">
    
            <!--  Menu Button -->
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-bars"></i></button>
    
            <!-- Logo -->
            <?php if(isset($_SESSION["admin"])) : ?>
                <a class="navbar-brand" href="admin.php">School.Id</a>
            <?php else : ?>
                <a class="navbar-brand" href="siswa.php">School.Id</a>
            <?php endif ; ?>
    
         </div>
    
          <!-- Login-Register -->
          <div class="login-register collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active me-5" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if(isset($_SESSION["admin"])) : ?>

                         <?=$data["username"] ; ?>
                    
                    <?php elseif($_SESSION["member"] === "siswa") :?>

                        <?=$data["nama_siswa"] ; ?>
                    
                    <?php else :?>

                        <?=$data["nama_guru"] ; ?>

                    <?php endif ; ?>
                </a>
                <ul class="dropdown-menu border" aria-labelledby="navbarDropdown">
                    <?php if(isset($_SESSION["member"])) : ?>
                    <li><a class="dropdown-item text-primary" href="#">Profile <i class="ms-2 fas fa-user"></i></a></li>
                    <?php endif ; ?>
                    <li><a class="dropdown-item text-success" href="editprofil.php">Edit Profile <i class="ms-2 fas fa-user-cog"></i></a></li> 
                    <li><a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" href="">Logout<i class="ms-2 fas fa-power-off"></i> </a></li>
                </ul>
              </li>
            </ul>
          </div>
    
        </div>
      </nav>

      <!--Logout-Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Log Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> Yakin Ingin Keluar ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                <a type="button" href="logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
            </div>
        </div>
     </div>
    
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
        
                <!-- ADMIN ONLY -->

                <?php if(isset($_SESSION["admin"])) : ?>
                
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="me-2 fas fa-user-shield"></i>Admin 
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="admin.php" class="list-group-item list-group-item-action">Dashboard <i class="ms-2 fas fa-tachometer-alt"></i></a>
                                <a href="createmapel.php" class="list-group-item list-group-item-action">Add Mata Pelajaran <i class="ms-2 fas fa-plus"></i></a>
                                <a href="createclass.php" class="list-group-item list-group-item-action">Add Kelas <i class="ms-2 fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endif ; ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class=" me-2 fas fa-table"></i>Table 
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="list-group">
                                
                                <?php if(isset($_SESSION["admin"])) : ?>
                                    <a href="user.php" class="list-group-item list-group-item-action">User</a>
                                    <a href="mapel.php" class="list-group-item list-group-item-action">Mapel</a>
                                <?php endif ; ?> 

                                <a href="siswa.php" class="list-group-item list-group-item-action">Siswa</a>
                                <a href="guru.php" class="list-group-item list-group-item-action">Guru</a>
                                <a href="class.php" class="list-group-item list-group-item-action">Kelas</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(isset($_SESSION["member"])) : ?>
                    <?php if($_SESSION["member"] === "siswa") : ?>

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

                    <?php else : ?>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseOne">
                                <i class="me-2 fas fa-chalkboard"></i>Kelas
                                </button>
                            </h2>
                            <div id="flush-collapseTree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                <div class="list-group">
                                    <ul>
                                    <li><a href="#" class="list-group-item list-group-item-action">12 A IPA</a></li>
                                    <li><a href="#" class="list-group-item list-group-item-action">11 A IPA</a></li>
                                    <li><a href="#" class="list-group-item list-group-item-action">12 B IPS</a></li>
                                    </ul>           
                                </div>
                                </div>
                            </div>
                        </div>

                    <?php endif ; ?>
                <?php endif ; ?>

                
                <?php if(isset($_SESSION["member"])) : ?>

                    

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
    

                <?php endif ; ?>  
            </div>
        </div>
      </div>


   