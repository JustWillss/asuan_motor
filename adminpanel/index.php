<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Asuan Motor | Login</title>
    </head>
<body>
<?php

include '../config/connection.php';
session_start();
if(isset($_SESSION['login'])){
    header("location:home.php");
    exit;
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE username = '$username' && password = '$password'";
    $query = mysqli_query($conn,$sql);

    if (mysqli_num_rows($query) === 1) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        header('location:home.php');
            exit();
    }
    else {
            echo "<script>
            alert('Username atau Password salah');
            window.location = 'index.php';
            </script>";
    }
}
?> 
    <div class="box">
        <div class="container">
            <div class="top-header">
                <!-- <span>Have an account?</span> -->
                <header>Login</header>
</div>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="input-field">
                    <input type="text" class="input" name="username" id="username" placeholder="Username" required autocomplete="off">
                </div>
                <div class="input-field">
                    <input type="password" class="input" name="password" id="password" placeholder="Password" required>
                </div>
                <div>
                    <input class="submit" type="submit" name="login" value="Login">
                </div>
            </form>
            <!-- <div class="register-link">
                <p>Belum memiliki akun? <a href="register.php">Daftar di sini</a></p>
            </div> -->
        </div>
    </div>
</body>
</html>