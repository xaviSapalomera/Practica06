<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Articles</title>
    <link rel="stylesheet" href="./estil/estil_sesion.css">
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
</head>
<body>

<?php
session_start();
?>

<div class="header">
<form method="post">
    <button type="submit" class="icon_logout" name="Logout"></button>
</form>

<form method="post" action="perfil_usuari.php">
    <button type="submit" class="icon_perfil" name="profile"></button>
</form>

<form  action="insert.php" method="post">
    <input class="boto_header" type="submit" value="INSERTAR">
</form>

<form action="update.php" method="post">
    <input class="boto_header" type="submit" value="ACTUALIZAR">
</form>

<form action="delete.php" method="post">
    <input class="boto_header" type="submit" value="ELIMINAR">
</form>

<form action="index_session.php" method="post">
    <input class="boto_header" type="submit" value="HOME">
</form>
</div>

<div style="margin-top: 30px">
        <?php

       
        include './controller/controlador_index.php';
        
        include './controller/controlador_login.php';

        ?>
   
</div>

</body>
</html>