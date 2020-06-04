<?php
    session_start(); 
    if( !isset($_SESSION['login'])){
        header("location:login.php");
        exit;
    }

    require("connect.php");

    //pagination
    //KONFIGURASI
    $jumlahdataperhalaman = 2;
   $jumlahdata = count(query("SELECT *FROM mahasiswa"));
   $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
    $halamanaktif=(isset($_GET["halaman"])) ? $_GET["halaman"] : 1; 
     $awaldata = ($jumlahdataperhalaman * $halamanaktif)-$jumlahdataperhalaman;
    


    //menampilkan data
    $mahasiswa = query("SELECT *FROM MAHASISWA LIMIT $awaldata,$jumlahdataperhalaman");


    //tombol cari 

    if (isset($_POST["cari"])){
        $mahasiswa = cari($_POST["keyword"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halaman admin</title>
</head> 
<body>
    <a href="logout.php">logout</a>
    <h1>daftar mahasiswa</h1>
    <a href="tambah.php">tambah data mahasiwa</a>
    <br>

    <form action="" method="post">
        <input type="text" name="keyword" size="30" autofocus placeholder="masukkan nama" autocomplete="off">
        <button type="submit" name="cari" > Cari </button>
    </form>
    <br>

        <!--navigasi --> 
        <?php if($halamanaktif > 1 ):?>
             <a href="?halaman=<?php echo $halamanaktif -1 ?> ">&laquo</a>
         <?php endif;?>
        
        <?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
            <?php if($i == $halamanaktif) :?>
            <a href="?halaman=<?php echo $i; ?>" style="font-weight:bold; color:red;"><?php echo $i; ?></a>
            <?php else : ?>
                <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
       
        <?php endfor; ?>

        <?php if($halamanaktif < $jumlahhalaman ):?>
             <a href="?halaman=<?php echo $halamanaktif +1 ?> ">&raquo</a>
         <?php endif;?> 

        <br>
    <table border="1" cellpadding="10">
    <tr>
        <td>No</td>
        <td>aksi</td>
        <td>foto</td>
        <td>nrp</td> 
        <td>Nama</td>
        <td>email</td>
        <td>jurusan</td>
    </tr>
    <?php $i=1; ?>
    <?php foreach($mahasiswa as $row) : ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><a href="ubah.php?id=<?php echo $row["id"]; ?>">ubah</a> | <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('yakin ?');">hapus</a></td>
        <td><img src="gambar/<?php echo $row["gambar"]; ?>" alt="" width=50 height=50></td>
        <td><?php echo $row["nrp"];?></td>
        <td><?php echo $row["nama"];?></td>
        <td><?php echo $row["email"];?></td>
        <td><?php echo $row["jurusan"];?></td>
    </tr>
    <?php $i++ ?>
<?php endforeach; ?> 
    </table>
</body> 
</html> 