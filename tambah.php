<?php
 session_start(); 
 if( !isset($_SESSION['login'])){
     header("location:login.php");
     exit;
 }
require 'connect.php';

    if(isset($_POST["submit"])){
        
       
       

        //cek data berhasil atau tidak

        if( tambah($_POST) > 0 ){

            echo"
            <script>
            alert('data berhasil masuk');
            document.location.href = 'index.php';
            </script>";

        }else{
            echo" <script>
            alert('data gagal');
            document.location.href = 'index.php';
            </script>";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tambah data mahasiswa</title>
</head>
<body>
    <h1>tambah data mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">nama</label>
                <input type="text" name="nama" id="nama" required autocomplete="off" autofocus>
            </li>
            <li>
            <label for="nrp">nrp</label>
                <input type="text" name="nrp" id="nrp" required autocomplete="off" autofocus>
            </li>
            <li>
            <label for="email">email</label>
                <input type="mail" name="email" id="email" required autocomplete="off" autofocus>
            </li>
            <li>
            <label for="jurusan">jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required autocomplete="off" autofocus>
            </li>
            <li>
            <label for="gambar">gambar</label>
                <input type="file" name="gambar" id="gambar">
            </li><br>
            <li>
                <button type="submit" name="submit">tambah data</button>
            </li>
        </ul>
    </form>
</body>
</html>