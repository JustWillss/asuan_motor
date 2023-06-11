<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="website icon" type="png" href="../foto/icon.png">
    <title>Register</title>
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <span>Create an account?</span>
                <header>Sign Up</header>
        </div>
        <form action="../config/sv_register.php" method="post">
            <div class="input-field">
                <input class="input" type="text" name="username" id="username" placeholder="Username" autocomplete="off">
            </div>
            <div class="input-field">
                <input class="input" type="text" name="fullname" id="fullname" placeholder="Fullname" autocomplete="off">
            </div>
            <div class="input-field">
                <input class="input" type="password" name="password" id="password" onkeyup="cek_password()" placeholder="Password">
            </div>
            <div class="input-field">
                <input class="input" type="password" name="confirmed_password" id="confirmed_password" onkeyup="cek_password()" placeholder="Confirm Password">
            </div>
            <div>
                <input class="submit" type="submit" value="Daftar" id="button_submit" disabled="disabled">
            </div>
        </form>
        <div>
            <p>Sudah memiliki akun? <a href="index.php">Masuk di sini</a></p>
        </div>
    </div>
    </div>
</body>
<script>
    function cek_password() {
        var password = document.getElementById("password").value;
        var confirmed_password = document.getElementById("confirmed_password").value;

        if (password == confirmed_password && password !== "") {
            document.getElementById("button_submit").disabled = false;
        } else {
            document.getElementById("button_submit").disabled = true;
        }
    }
</script>
</html>
