<?php 

if(isset($_SESSION["login"])) {
    header('Location: login.php');
}

session_start();

require 'function.php';


//pagination
$totalData = count(show("SELECT guru.id as id, guru.nama_guru as nama, guru.NIG as nig, mapel.nama_mapel as mapel FROM guru JOIN mapel ON guru.mapel_id = mapel.id ")) ;

$dataPerhalaman = 5;

$jumlahHalaman = ceil($totalData/$dataPerhalaman);

if (isset($_GET["page"])) {
    $halamanAktif = $_GET["page"];
} else {
    $halamanAktif = 1;
}

$dataAwal = ($halamanAktif * $dataPerhalaman) - $dataPerhalaman;

$guru = show("SELECT guru.id as id, guru.nama_guru as nama, guru.NIG as nig, mapel.nama_mapel as mapel FROM guru JOIN mapel ON guru.mapel_id = mapel.id LIMIT $dataAwal, $dataPerhalaman ");
$id = $dataAwal + 1;

//searching/filter

if(isset($_POST["find"])) {
    /* $keyword = $_POST["keyword"];
    $filter = $_POST["filter"];

    var_dump($filter);
    var_dump($keyword); */

    $guru = cariGuru($_POST);
}

//var_dump($guru);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/template.css">
</head>
<body>

    <?php include 'navbar.php' ?>

    <!-- Isi Konten -->
<div class="container my-4 px-4 py-3 table-data">

    <!--Data Table-->
    <div class="table-title">
        <h4>List Guru</h4>
    </div>

        <!--  Searchbar -->
    <form class="d-flex search my-3 mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search Guru" aria-label="Search" name="search" autocomplete="off">
            <button class="btn btn-outline-success" type="submit">Search</button>
        <select class="btn ms-3 btn-outline-dark" name="" id="">
            <option value="">Mata Pelajaran</option>
            <option value="">Matematika</option>
            <option value="">Fisika</option>
        </select>
    </form>

    <div class="container-fluid mt-3">
        <table class="mx-auto">

        <tr class="thead">
            <td class="table-header">No. </td>
            <td class="table-header">Nama</td>
            <td class="table-header">NIG</td>
            <td class="table-header">Mata Pelajaran</td>
            <?php if(isset($_SESSION["admin"])) : ?>
                    <td class="table-header">Action</td>
                <?php endif ; ?>
        </tr>

        <?php foreach($guru as $gru) : ?>
        <tr class="tbody">
            <td class="table-body"><?=$id?></td>
            <td class="table-body"><?php echo $gru["nama"] ?></td>
            <td class="table-body"><?= $gru["nig"]?></td>
            <td class="table-body"><?=$gru["mapel"]?></td>
                <?php if(isset($_SESSION["admin"])) : ?>
            <td>
                <a href="" class="btn btn-success">Edit</a>
                <a href="" class="btn btn-danger">Delete</a>
            </td>
            <?php endif; ?>
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