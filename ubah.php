<?php
 session_start(); 
 if( !isset($_SESSION['login'])){
     header("location:login.php");
     exit;
 }

require 'connect.php';

//ambil data
    $id = $_GET['id'];


    $mhs = query("SELECT *FROM mahasiswa where id=$id")[0];

    if(isset($_POST["submit"])){
        
       
       

        //cek data berhasil atau tidak

        if( ubah($_POST) > 0 ){
            echo"
            <script>
            alert('data berhasil diubah');
            document.location.href = 'index.php';
            </script>";

        }else{
            echo" <script>
            alert('data gagal diubah');
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
    <title>ubah data mahasiswa</title>
</head>
<body>
    <h1>ubah data mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $mhs["id"];?>">
    <input type="hidden" name="gambarlama" value="<?php echo $mhs["gambar"];?>">
        <ul>
            <li>
                <label for="nama">nama</label>
                <input type="text" name="nama" id="nama" required value="<?php echo $mhs["nama"]; ?>">
            </li>
            <li>
            <label for="nrp">nrp</label>
                <input type="text" name="nrp" id="nrp" required value="<?php echo $mhs["nrp"]; ?>">
            </li>
            <li>
            <label for="email">email</label>
                <input type="mail" name="email" id="email" required value="<?php echo $mhs["email"]; ?>">
            </li>
            <li>
            <label for="jurusan">jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"]; ?>">
            </li>
            <li>
            <label for="gambar">gambar</label>
            <img src="gambar/<?php echo $mhs['gambar'];?>" alt="" width="100" height="100"><br>
                <input type="file" name="gambar" id="gambar">
            </li><br>
            <li>
                <button type="submit" name="submit">ubah data</button>
            </li>
        </ul>
    </form>
</body>
</html>