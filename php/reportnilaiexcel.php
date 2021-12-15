<?php 

//Convert File Ke Bentuk Excel
header("Content-type:application/xls");
header("Content-Disposition: attachment; filename=nilai.xls");

//Session
session_start();

require 'function.php';

$kelasID = $_GET["kelas"];
$id = $_SESSION["userID"];

$kelas = show("SELECT * FROM kelas WHERE id =$kelasID")[0];
$siswa = show("SELECT * FROM siswa WHERE kelas_id = $kelasID ORDER BY nama_siswa ASC");
$jumlahSiswa = count($siswa);

$namaGuru = mysqli_query($connection, "SELECT * FROM guru WHERE user_id = $id");
$data = mysqli_fetch_assoc($namaGuru);
$navbarID = $data["id"];
$tugas = show("SELECT * FROM tugas WHERE guru = $navbarID AND kelas = $kelasID");

?>

<table class="table table-bordered my-2 border">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <?php $i = 1; ?>
                        <?php foreach($tugas as $tgs) : ?>
                            <th>Tugas <?=$i?></th>
                            <?php $i++ ; ?>
                        <?php endforeach ; ?>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($siswa as $ssw) : ?>
                    <tr>
                        <td><?=$ssw["nama_siswa"]?></td>
                        
                        <?php
                            $nilai = 0;
                            $mapel = $data["mapel_id"];
                            $siswaID = $ssw["id"];

                            $nilai = show("SELECT nilai FROM jawaban WHERE siswa = $siswaID AND mapel = $mapel ") ;
                            //var_dump($nilai);
                            
                         ?>

                        <?php foreach($nilai as $nli) : ?>
                            <td><?=($nli["nilai"])?></td>
                        <?php endforeach ; ?>
                    </tr>
                <?php endforeach ; ?>


                </tbody>

                <!-- <tfoot>
                    <tr>
                        <td>Average</td>
                        <td>85,5</td>
                    </tr>
                </tfoot> -->
            </table>
