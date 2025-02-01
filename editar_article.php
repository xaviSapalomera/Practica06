<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Article</title>
    <link rel="stylesheet" href="./estil/insert.css">
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" type="image/webp">
</head>
<body>
    <!-- Button to return to Home -->
    <form class="boto" action="index_session.php" method="post">
        <input type="submit" value="Home">
    </form>

    <hr style="width: 100%; margin: 0;">

    <?php
    error_reporting(E_ALL); // Informar de todos los errores
    ini_set('display_errors', 1); // Mostrar los errores en pantalla
    
include './model/model_articles.php';

    $articleModel = new Article();    

        if (isset($_POST['id'])) {


            $id = $_POST['id'];

            
            $resultat =  $articleModel->trobarArticlePerID($id);

            if ($resultat) {
                ?>
                <form class="form" action="editar_article.php" method="post">

                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                    
                    <input class="input" type="text" id="titol" name="titol" value="<?= htmlspecialchars($resultat['titol']) ?>" placeholder="Títol" required>
                    <br><br>

                    
                    <br>
                    <textarea class="input" id="cos" name="cos" placeholder="Cos" style="height: 250px; width: 400px; text-align: left; padding: 10px;" required><?= htmlspecialchars($resultat['cos']) ?></textarea>
                    <br><br>

                    <input style="margin-left: 150px; font-size: 40px;" type="submit" value="Guardar Canvis">
                </form>
                <?php
            }
        }
        include './controller/controlador_editar_article.php';
    ?>
</body>
</html>
