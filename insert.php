<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include './model/model_articles.php';
include './model/model_usuaris.php';

$articleModel = new Article();

// Obtener todos los artículos
$articles = $articleModel->mostrarTotsArticles() ?: [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Articles</title>
    <link rel="shortcut icon" href="./photos/icon_dtm.webp" />
    <link rel="stylesheet" href="./estil/pop_up.css">
    <link rel="stylesheet" href="./estil/estil_sesion.css">
    <link rel="stylesheet" href="./estil/insert.css">
    <script defer src="./ts/js/articles_control.js"></script>
    <script type="module" defer src="./ts/js/articles.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->

</head>
<body>
    <form class="boto" action="index_session.php" method="post">
        <input type="submit" value="Home">
    </form>
    <hr style="width: 100%; margin: 0;">

    <!-- Formulario para crear artículo -->
    <form id="articleForm" class="form" action="insert.php" method="post">
        <input id="titol" class="input" type="text" name="titol" placeholder="Titol" required>
        <div id="titolDIV" class="error"></div>
        <br><br>
        <textarea id="cos" class="input" name="cos" placeholder="Cos" style="height: 250px; width: 400px; text-align: left; padding: 10px;" required></textarea>
        <div id="cosDIV" class="error"></div>
        <br><br>
        <input id="BotoArticle" style="margin-left: 150px; font-size: 40px;" type="submit" value="Insertar">
    </form>
</body>

    <div id="prova"></div>

    <section class="articles">
    <?php if (!empty($articles)) { ?>
        <div class="articles-blocks">
            <?php foreach ($articles as $article) { ?>
                <div class="article-block">
                    <div class="article-header">
                        <h3><?= isset($article['titol']) ? htmlspecialchars($article['titol']) : 'Sense Titol' ?></h3>
                        <small>Usuari: <?= isset($article['user_id']) ? htmlspecialchars(mostrarUsuariArticle($article['user_id'])) : 'Sense Usuari' ?></small><br>
                        <small>Data: <?= isset($article['data']) ? htmlspecialchars(ajustarData($article['data'])) : 'Sense Data' ?></small>
                    </div>
                    <div class="article-content">
                        <p><?= isset($article['cos']) ? htmlspecialchars($article['cos']) : 'Sense Cos' ?></p>
                    </div>

                    <div class="article-actions">
                        <!-- Botón Editar -->
                        <form method="POST" action="editar_article.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                            <button class="boto_editar" type="submit" aria-label="Editar article"></button>
                        </form>

                        <!-- Botón Eliminar -->
                        <form method="POST" action="eliminar_article.php" style="display: inline;" class="form-delete">
                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                            <button type="submit" class="boto_borrar" aria-label="Eliminar article"></button>
                        </form>

                        <!-- Botón Generar QR -->
                        <form method="GET" action="./controller/controlador_generador_qr.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                            <button type="button" class="boto_qr" onclick="abrirPopup(<?= $article['id'] ?>)">Generar QR</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>No hi ha articles disponibles en aquesta pàgina.</p>
    <?php } ?>
</section>
</table>
</html>
