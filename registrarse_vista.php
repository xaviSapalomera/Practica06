<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="./estil/register.css">
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
</head>
<body>
<div>
<form class="boto" action="login_vista.php" method="post">
    <input type="submit" class="boto_header" value="LOGIN">
</form>
<form class="boto" action="index.php" method="post">
    <input type="submit" class="boto_header" value="HOME">
</form>
</div>    
<div class="form-container">
<form class="logincuadre" action="registrarse_vista.php" method="post">
    <input class="input" type="text" name="nom" placeholder="Nom" value="<?php echo isset($_POST['nom'])?>">
    <br><br>
    <input class="input" type="text" name="cognom" placeholder="Cognom" value="<?php echo isset($_POST['cognom']); ?>">
    <br><br>
    <input class="input" type="text" name="dni" placeholder="Dni" value="<?php echo isset($_POST['dni']); ?>">
    <br><br>
    <input class="input" type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ?>">
    <br><br>
    <input class="input" type="password"  name="contrasenya" placeholder="Contrasenya" value="">
    <br><br>
    <input class="input" type="password" name="re-contrasenya" placeholder="Repeteix la contrasenya" value="">
    <br><br>
    <input class="boto_enviar" type="submit" name="Registrarse" value="Registrarse">
    <br>
</form>
</div>


    <?php 


        
        include './controller/controlador_registrarse.php';
    ?>

</body>
</html>