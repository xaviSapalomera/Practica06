<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estil/login.css">
    <title>Recuperar Contrasenya</title>
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
</head>
<body>
<div style="margin-top: 0px;">
    <!-- Botones de navegación -->
    <form class="boto" action="registrarse_vista.php" method="post">
        <input class="boto_header" type="submit" value="REGISTRARSE">
    </form>
    <form class="boto" action="index.php" method="post">
        <input class="boto_header" type="submit" value="HOME">
    </form>
</div>

<!-- Formulario para recuperar la contraseña -->
<div class="form-container">
    <form class="logincuadre" action="recuperar_contrasenya.php" method="post">
        <input class="input" type="email" name="correu" placeholder="Correo electrónico" 
               value="<?php echo isset($_POST['correu']) ? htmlspecialchars($_POST['correu']) : ''; ?>" required>
        <br><br>
        <input class="boto_enviar" type="submit" name="LOGIN" value="RECUPERAR CONTRASEÑA">
        <br>
    </form>
</div>

<!-- Incluir el controlador -->
<?php

    include '../controller/controlador_recovery_password.php';
    
?>
</body>
</html>
