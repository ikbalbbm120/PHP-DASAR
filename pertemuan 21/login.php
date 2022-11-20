<?php
session_start();
require_once 'function.php'; //nih
//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($con, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    //cek cookie dan username
    if ($key === hash('sha512', $row['username'])) {
        $_SESSION['login'] = true;
    }
}
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
// require_once 'function.php'; //sama kan ya?
if (isset($_POST["login"])) {
    // Menangkap inputan user
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $user = query("SELECT * FROM users WHERE username = '$username'");

    // Cek user ditemukan atau tidak
    if (count($user) > 0) {
        // Check password
        if (password_verify($password, $user[0]['password'])) {
            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                setcookie('id', $user[0]['id'], time() + 20);
                setcookie('key', hash('sha512', $user[0]['username']), time() + 20);
                $_SESSION['login'] = true;
                header("Location: index.php");
            } else
                // Jika password benar
                $_SESSION['login'] = true;
            header("Location: index.php");
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman login</title>
</head>

<body>
    <h1>halaman login</h1>
    <?php if (isset($error)) : ?>
        <p style="color:aqua; font-style:italic;">username/pasword salah</p>
    <?php endif; ?>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">username:</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password:</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="remember">remember me</label>
                <input type="checkbox" name="remember" id="remember">
            </li>
            <li>
                <button type="submit" name="login">login</button>
            </li>
        </ul>
    </form>
</body>

</html>