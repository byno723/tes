<?php
    //koneksi database

    $konek = mysqli_connect("localhost","root","","phpdasar");

    function query($query){
        global $konek; 
        $result = mysqli_query($konek, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
            return $rows;
    }

    function tambah($data){

        global $konek;

         $nrp = htmlspecialchars($data["nrp"]);
         $nama = htmlspecialchars($data["nama"]);
         $email = htmlspecialchars($data["email"]);
         $jurusan = htmlspecialchars($data["jurusan"]);

        //upload gambar
        $gambar = upload();
        if(!$gambar){
            return false;
        }


        $query = "INSERT INTO MAHASISWA
        VALUES('','$nrp','$nama','$email','$jurusan','$gambar')";
        mysqli_query($konek, $query);

        return mysqli_affected_rows($konek);
    }

    function upload(){
        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        //cek apakah ada gamabar yang di upload
        if($error === 4){
            echo "
            <script>alert('pilih gambar terlebih dahulu');</script>";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        
        $ekstensigambarvalid = ['jpg','jpeg','png'];
        $ekstensigambar = explode('.', $namafile);
        $ekstensigambar = strtolower(end($ekstensigambar));
            if( !in_array($ekstensigambar, $ekstensigambarvalid)){
            echo "
            <script>alert('yang anda upload bukan gambar !');</script>";
            return false;
            }
        //cek jika ukurannya terlalu besar
        if ($ukuranfile > 1000000){
            echo "
            <script>alert('ukuran gambar terlalu besar  !');</script>";
            return false;
        }

        //gambar diupload
        //generete nama gambar
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensigambar;
        
        move_uploaded_file($tmpName, 'gambar/' .$namafilebaru);

        return $namafilebaru;

    }

    function hapus($id){
        global $konek;
        mysqli_query($konek,"DELETE FROM mahasiswa where id=$id");
        
        return mysqli_affected_rows($konek); 
    }

    function ubah($data){
        
        global $konek;

        $id = $data["id"];

         $nrp = htmlspecialchars($data["nrp"]);
         $nama = htmlspecialchars($data["nama"]);
         $email = htmlspecialchars($data["email"]);
         $jurusan = htmlspecialchars($data["jurusan"]);
         
         $gambarlama = htmlspecialchars($data["gambarlama"]);
         
         //cek apakah user milih gambar baru atau tidak
        if ($_FILES['gambar']['error'] === 4){
            $gambar = $gambarlama;
        }else{
            $gambar = upload(); 
        }
         


        $query = "UPDATE MAHASISWA SET 
         nrp='$nrp',
         nama='$nama',
         email='$email',
         jurusan='$jurusan',
         gambar='$gambar'
         where id = $id
        ";

        mysqli_query($konek, $query);
       

        return mysqli_affected_rows($konek);
    }

    function cari($keyword){
        $query = "SELECT *FROM mahasiswa where nama LIKE  '%$keyword%'OR
         nrp LIKE  '%$keyword%' OR
         jurusan LIKE  '%$keyword%'
         ";
         
        return query($query);
    }

    function registrasi($data){
        global $konek;

       
	   
        $password = mysqli_real_escape_string($konek,$data["password"]);
        $password2 = mysqli_real_escape_string($konek,$data["password2"]);

        //chek konfirmasi password
        if( $password !== $password2 ){
             echo" <script>alert('konfimasi password tidak sesuai ')</script>";
             return false;
        }

        //enkripsi password
            $password = password_hash($password, PASSWORD_DEFAULT);

            //cek username sudah ada atau belum
             $result = mysqli_query($konek,"SELECT username from user where username='$username'");
                if(mysqli_fetch_assoc($result)){
                    echo " <script>
                    alert('username sudah terdaftar');
                    </script>" ;
                    return false; 
                }
           //tambahkan user baru kedatabase
           mysqli_query($konek,"INSERT INTO user VALUES('','$username','$password')");

           return mysqli_affected_rows($konek);
    }
?>  