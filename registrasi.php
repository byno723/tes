<?php

require("connect.php");
    if(isset($_POST["register"])){


        if(registrasi($_POST)>0){

            echo "
            <script>alert('user baru berhasil ditambahkan');</script> ";
            
        }else{
            echo mysqli_error($konek);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>regitrasi</title>
    <style>
        label{
            display:block;
        }
    </style>
</head>
<body>
    <h1>registrasi</h1>
    <form action="" method="POST">
        <ul>
            <li>
                    <label for="username">Username</label>   
                    <input type="text" name="username" id="username" autocomplete="off"> 
            </li>
            <li>
                    <label for="password">Password</label>   
                    <input type="password" name="password" id="password" autocomplete="off"> 
            </li>
            <li>
                    <label for="Password2">konfirmasi password</label>   
                    <input type="password" name="password2" id="password2" autocomplete="off"> 
            </li>
            <li>
                <button type="submit" name="register">Registrasi</button>
            </li>
        </ul>
    </form>
</body>
</html>