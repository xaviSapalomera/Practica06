<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles del Usuari</title>
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
    <link rel="stylesheet" href="./estil/estil_sesion.css">
</head>
<body>
        <?php
        session_start();
        
        include './controller/controlador_articles_usuari.php';
        
        ?>
</body>
</html>