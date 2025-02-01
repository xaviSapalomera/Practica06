
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link rel="stylesheet" href="./estil/article.css">
</head>
<body>

    <?php
    

        include './model/model_articles.php';

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $modelArticle = new Article();

        $article = $modelArticle->trobarArticlePerID($id);

        if($article){

            
            echo '<h1 class="article-title">'.$article['titol'].'</h1>';
            echo '<p class="article-body">'.$article['cos'].'</p>';
            echo '<div class="article-menu">';
            echo '<ul>';
                echo '<li><a href="#">Inicio</a></li>';
                echo '<li><a href="#">Categorías</a></li>';
                echo '<li><form method="POST" action="./editar_article.php" style="display: inline;"><input type="hidden" name="id" value="<'. $id
                 .'"><button class="boto_editar" type="submit" aria-label="Editar article">Editar article</button></form></li>';
                echo '<li><form method="POST" action="eliminar_article.php" style="display: inline;" class="form-delete"> <input type="hidden" name="id" value="'. $id .' "> <button type="submit" class="boto_borrar" aria-label="Eliminar article"></button> </form></li>';
                echo '<li><a href="#">Contacto</a></li>';
           echo '</ul>';
        echo '</div>';

        }
    }
    
    ?>
</body>
</html>
