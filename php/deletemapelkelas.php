<?php 

require 'function.php';

$kelas = $_GET["kelas"];
$guru = $_GET["guru"];

$hapus = mysqli_query($connection, "DELETE FROM mapel_kelas WHERE kelas = $kelas AND guru = $guru");

if (mysqli_affected_rows($connection) > 0) {
    echo "<script>
            alert(`Kelas berhasil ditarik`)
            document.location.href = 'dashboard.php'
            </script>";
} else {
    echo "<script>
            alert('Kelas gagal ditarik')
            document.location.href = 'dashboard.php'
            </script>";
}

?>