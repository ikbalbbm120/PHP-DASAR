<?php
require 'function.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $result = mysqli_query($conn, "select * from users where username = '$username'");
    //cek username

    if (!$result) {
        $error = true;
    }

    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
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
                <label for="email">email:</label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <button type="submit" name="login">login</button>
            </li>
        </ul>
    </form>
</body>

</html>