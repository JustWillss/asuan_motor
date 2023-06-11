<?php
    $user = "root";
    $server = "localhost";
    $password = "";
    $db = "asuan_motor";

    $conn = mysqli_connect($server, $user, $password, $db);
    if(!$conn) {
        die("gagal koneksi ke database");

        // echo "koneksi kedatabase berhasil";

        //mysqli_close($conn);
    }

?>