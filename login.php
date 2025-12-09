<?php 
include 'config/database.php';
error_reporting(0);
session_start();
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM login WHERE username='$username' AND pw='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_login'] = $row['id_login'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['pw'] = $row['pw'];
        $_SESSION['id_profil'] = $row['id_profil'];
        $_SESSION['id_bidang'] = $row['id_bidang'];
        
        if($row["username"]== "superadmin"){
            header("Location: admin/dashboard.php");
        }else{
            header("Location: bidang/dashboard.php");
        }
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style_login.css">
</head>
<style>
body {
    background-image: url(assets/imgs/bg.jpeg);
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;

}

.formContent {
    background-color: #03401d;
}
</style>

<body>
    <div>
        <marquee>
            SELAMAT DATANG DI WEBSITE PELAYANAN DINAS PENDIDIKAN DAN KEBUDAYAAN KABUPATEN PAMEKASAN
        </marquee>
    </div>
    <div class="formContent"> <img src="assets/imgs/logo.png" class="avatarImg">
        <h2>Login</h2>
        <form action="" method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>

</html>