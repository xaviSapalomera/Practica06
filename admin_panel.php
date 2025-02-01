<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./estil/login.css">
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
</head>
<body>
<form action="index_session.php" method="post">
    <input class="boto_header" type="submit" value="HOME">
</form>
    
    <h1>ADMIN PANEL</h1>


    <?php
    
    include './controller/controlador_admin.php';

    ?>
</body>
</html>