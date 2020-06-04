<?php
    session_start();
    require 'connect.php'; 

   // set cookie
    if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        //ambil usrname berdasarkan id
        $result = mysqli_query($konek,"SELECT username FROM user where id=$id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username

        if($key === hash('sha256',$row['username'])){
            $_SESSION['login'] = true;
            exit;
        }
    }

    if( isset($_SESSION["login"]) ){
        header("location : index.php");
        exit; 
    }

    
    if(isset($_POST["login"])){

        $username = $_POST["username"];
        $password = $_POST["password"];
          
        $result = mysqli_query($konek,"SELECT *FROM user WHERE username='$username'"); 

        if (mysqli_num_rows($result) === 1){

            // chek password
            $row = mysqli_fetch_assoc($result); 
           if(password_verify($password, $row["password"])){

            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if(isset($_POST['remember'])){ 
                //buat cookie

                setcookie('id',$row['id'],time()+60);
                setcookie('key',hash('sha256',$row['username']),time()+60);
            }

                header("location: index.php");
                exit; 
            }
        }
            $error = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>halaman login</h1>

    <?php if(isset($error)) :?>
    <p style="color:red; font-style:italic;">usrname atau password salah</p>
    <?php endif; ?>
    <form action="" method="post">

        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">remember me</label>
            </li>
            <li>
                <button type="submit" name="login">submit</button>
            </li>
        </ul>

    </form>
</body>
</html>