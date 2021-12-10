<?php

require_once __DIR__ . '/library/vendor/autoload.php';

require 'function.php';

session_start();

$kelasID = $_GET["kelas"];
$id = $_SESSION["userID"];

$kelas = show("SELECT * FROM kelas WHERE id =$kelasID")[0];
$siswa = show("SELECT * FROM siswa WHERE kelas_id = $kelasID ORDER BY nama_siswa ASC");
$jumlahSiswa = count($siswa);

$namaGuru = mysqli_query($connection, "SELECT * FROM guru WHERE user_id = $id");
$data = mysqli_fetch_assoc($namaGuru);
$navbarID = $data["id"];
$tugas = show("SELECT * FROM tugas WHERE guru = $navbarID AND kelas = $kelasID");



$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewSiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/viewsiswa.css">
</head>
<body>


      <div class="container table-siswa my-3 px-4">

        <!-- HEAD -->
        <div class="header">

            <h3 class="my-3">Report Nilai Kelas '.$kelas["nama_kelas"].'</h3>

        </div>
        
        <div class="body">

            <table class="table table-bordered my-2 border">
                <thead>
                    <tr>
                        <th>No </th>
                        <th>Nama Siswa</th>';

$i = 1;

foreach($tugas as $tgs) {
    $html .= '<th>Tugas '.$i.'</th>';
    $i ++;
}

$html .= '</tr>
</thead>
<tbody>';

$j = 1;
foreach($siswa as $ssw) {

    $html .= '<tr>
    <td>'.$j.'
    <td>'.$ssw["nama_siswa"].'</td>';

    $nilai = 0;
    $mapel = $data["mapel_id"];
    $siswaID = $ssw["id"];

    $nilai = show("SELECT nilai FROM jawaban WHERE siswa = $siswaID AND mapel = $mapel ") ;

    foreach($nilai as $nli) {
        $html .= '<td>'.$nli["nilai"].'</td>';
    }

    $html.='</tr>';
    $j ++ ;

}

$html .= '</tbody>

<!-- <tfoot>
    <tr>
        <td>Average</td>
        <td>85,5</td>
    </tr>
</tfoot> -->
</table>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>';


$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();