<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estil/login.css">
    <title>Login</title>
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
    <script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
</head>
<body>
<div style="margin-top: 0px;">
    <form class="boto" action="registrarse_vista.php" method="post">
        <input class="boto_header" type="submit" value="REGISTRARSE">
    </form>
    <form class="boto" action="index.php" method="post">
        <input class="boto_header" type="submit" value="HOME">
    </form>
</div>

<div class="form-container">
    <form class="logincuadre" action="login_vista.php" method="post">
        <input class="input" type="text" name="correu" placeholder="Correu" value="<?php echo htmlspecialchars(isset($_POST['correu']) ? $_POST['correu'] : ''); ?>">
        <br><br>
        <input class="input" type="password" name="password" placeholder="Contrasenya" value="">
        <br><br>
        <input type="checkbox" name="remember_me"> recordarme
        <br><br>
        
        <?php
        if ($_SESSION['intents_fallits'] >= 3) {
            echo '<div class="g-recaptcha" data-sitekey="6LeW4o0qAAAAAB7YdLf9u1OL9alJcwkLmME0W7Gr"></div><br>';
        }
        ?>
        
        <input type="submit" class="boto_enviar" name="LOGIN"></input>
        <br>
        <a style="color: white;" href="recuperar_contrasenya.php">He oblidat la meva contrasenya</a>
        <br>
    </form>

    <!-- Botones de Google y GitHub fuera del formulario -->
    <div class="social-buttons">
        <a class="githubicon" href="./controller/controlador_github_login.php"></a>
        <a class="googleicon" href="./controller/controlador_google_conta.php"></a>
    </div>
</div>



<?php
    include './controller/controlador_login.php';
?>

</body>
</html>

