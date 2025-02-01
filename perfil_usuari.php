<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="./estil/profile.css">
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
</head>
<body>
<?php
    session_start();
    error_reporting(E_ALL); // Informar de todos los errores
ini_set('display_errors', 1); // Mostrar los errores en pantalla
?>    
<div class="header">

<form action="index_session.php" method="post">
    <input class="boto_header" type="submit" value="HOME">
</form>
</div>
    <div class="photo_profile"></div>

    <!-- Formulario para cambiar contraseñas -->
    <form class="form" action="perfil_usuari.php" method="post">
        <input name="oldpassword" class="input" type="text" placeholder="Antiga Contrasenya">
        <br>
        <input name="newpassword" class="input" type="text" placeholder="Nova Contrasenya">
        <br>
        <input name="re-newpassword" class="input" type="text" placeholder="Repeteix Nova Contrasenya">
        <br>
        <br>
        <input type="submit" value="Cambiar">
    </form>

<?php


include "./model/model_usuaris.php";

$usuariModel = new Usuari();

// Verifica si la sesión está activa y si el correo está disponible
if (!isset($_SESSION['correu'])) {
    echo "<h1>No has iniciat sesió</h1>";
    exit();
}

$correu = $_SESSION['correu'];

$resultat = $usuariModel->perfilDades($correu);

// Verificar si se obtuvo un resultado válido
if ($resultat && is_array($resultat)) {
?>    

<!-- Formulario para cambiar nickname -->
<form action="perfil_usuari.php" method="post">
    <input class="input" type="text" name="newNickname" value="<?= htmlspecialchars($resultat['nickname'] ?? '') ?>">
    <input type="submit" value="CAMBIAR NICKNAME">
</form>

<!-- Formulario para cambiar correo -->
<form action="perfil_usuari.php" method="post">
    <input class="input" type="text" name="newEmail" value="<?= htmlspecialchars($resultat['email'] ?? '') ?>">
    <input type="submit" value="CAMBIAR CORREU">
</form>
    
<?php

if (isset($resultat['nickname'])) {
    $_SESSION['nickname'] = $resultat['nickname'];  // Asigna el valor a la sesión
} else {
    echo "<h1>Nickname no encontrado en la base de datos</h1>";
}


} else {
    echo "<h1>No se encontró el usuario</h1>";
    exit();
}

// Actualización del nickname
if (isset($_POST['newNickname']) && !empty($_POST['newNickname'])) {
    $newNickname = htmlspecialchars($_POST['newNickname'], ENT_QUOTES, 'UTF-8');
    if ($newNickname != $resultat['nickname'] && $usuariModel->actualitzarNickname($resultat['id'], $newNickname)) {
        echo "<h1>Nickname actualizado correctamente</h1>";
    } else {
        echo "<h1>No se pudo actualizar el nickname</h1>";
    }
}

// Actualización del correo
if (isset($_POST['newEmail']) && !empty($_POST['newEmail'])) {
    $newEmail = htmlspecialchars($_POST['newEmail'], ENT_QUOTES, 'UTF-8');
    if ($newEmail != $resultat['email'] && $usuariModel->actualitzarEmail($resultat['id'], $newEmail)) {
        echo "<h1>Correo actualizado correctamente</h1>";
    } else {
        echo "<h1>No se pudo actualizar el correo</h1>";
    }
}

// Cambiar la contraseña
if (!empty($_POST["oldpassword"]) && !empty($_POST["newpassword"]) && !empty($_POST["re-newpassword"])) {
    $antiga_password = $_POST["oldpassword"];
    $nova_password = $_POST["newpassword"];
    $re_nova_password = $_POST["re-newpassword"];

    if ($nova_password === $re_nova_password) {
        if (password_verify($antiga_password, $resultat["contrasenya"])) {
            if ($usuariModel->actualitzarPassword($resultat['id'], $nova_password)) {
                echo "<h1>Contraseña actualizada correctamente</h1>";
            } else {
                echo "<h1>Error al actualizar la contraseña</h1>";
            }
        } else {
            echo "<h1>La contraseña antigua no es correcta</h1>";
        }
    } else {
        echo "<h1>Las contraseñas no coinciden</h1>";
    }
}

exit();

include './controller/controlador_perfil.php';
?>

</body>
</html>
