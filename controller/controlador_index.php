<?php

session_start();

include './model/model_articles.php';
include './model/model_usuaris.php';

if(isset($_SESSION['mantindre_sessio'] )){
    header('location: index_session.php');
}

$articleModel = new Article();

// Inicialització de variables
$order = isset($_POST['order']) && in_array($_POST['order'], ['ascID', 'descID', 'ascNom', 'descNom', 'normal']) 
         ? $_POST['order'] 
         : 'normal';

// Ordenar articles segons el valor seleccionat
switch ($order) {
    case 'ascID':
        $articles = $articleModel->mostrarArticlesOrdenats('id','ASC') ?: [];
        break;
    case 'descID':
        $articles = $articleModel->mostrarArticlesOrdenats('id','DESC') ?: [];
        break;
    case 'ascNom':
        $articles = $articleModel->mostrarArticlesOrdenats('titol','ASC') ?: [];
        break;
    case 'descNom':
        $articles = $articleModel->mostrarArticlesOrdenats('titol','DESC') ?: [];
        break;
    default:
        $articles = $articleModel->mostrarTotsArticles() ?: [];
}

// Funció per obtenir el nom de l'usuari
function mostrarUsuariArticle($user_id) {

    $usuariModel  = new Usuari();
    
    $usuari = $usuariModel->filtrarUsuarisPerID($user_id); 
    if ($usuari) {
        return htmlspecialchars($usuari['nickname']);
    } else {
        return 'No lo ha creat cap usuari registrat'; 
    }
}

// Funció per ajustar el format de la data
function ajustarData($data) {
    if ($data) {
        // Convertir del format Y-m-d a d/m/Y
        $fecha_convertida = DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y');
        return $fecha_convertida;
    } else {
        return 'Data no disponible';
    }
}

// Paginació
$paginaActual = isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) 
                ? (int)$_GET['page'] 
                : 1;

$totalArticulos = count($articles);
$articulosPorPagina = 10;
$totalPagines = ($totalArticulos > 0) ? ceil($totalArticulos / $articulosPorPagina) : 0;

$offset = ($paginaActual - 1) * $articulosPorPagina;
$articles = array_slice($articles, $offset, $articulosPorPagina);

?>

<div class="contenidor">
    <h1>Articles</h1>

    <!-- Formulari per ordenar articles -->
    <form method="POST" action="index_session.php">
        <label for="order">Filtre:</label>
        <select name="order">
            <option value="normal" <?= $order === 'normal' ? 'selected' : '' ?>>Normal</option>
            <option value="ascID" <?= $order === 'ascID' ? 'selected' : '' ?>>Asc(ID)</option>
            <option value="descID" <?= $order === 'descID' ? 'selected' : '' ?>>Desc(ID)</option>
            <option value="ascNom" <?= $order === 'ascNom' ? 'selected' : '' ?>>Asc(Nom)</option>
            <option value="descNom" <?= $order === 'descNom' ? 'selected' : '' ?>>Desc(Nom)</option>
        </select>
        <button type="submit">Ordenar</button>
    </form>
    <link rel="stylesheet" href="../estil/estil_sesion.css">
    
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
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>No hi ha articles disponibles en aquesta pàgina.</p>
    <?php } ?>
</section>

    <!-- Secció per a la paginació -->
    <section class="paginacio">
        <ul>
            <?php if ($paginaActual > 1) { ?>
                <li><a href="?page=<?= $paginaActual - 1 ?>">&laquo; Anterior</a></li>
            <?php } else { ?>
                <li class="disabled"><a href="#">&laquo; Anterior</a></li>
            <?php } ?>

            <?php for ($i = 1; $i <= $totalPagines; $i++) { ?>
                <?php if ($paginaActual == $i) { ?>
                    <li class="active"><a href="#"><?= $i ?></a></li>
                <?php } else { ?>
                    <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>
            <?php } ?>

            <?php if ($paginaActual < $totalPagines) { ?>
                <li><a href="?page=<?= $paginaActual + 1 ?>">Següent &raquo;</a></li>
            <?php } else { ?>
                <li class="disabled"><a href="#">Següent &raquo;</a></li>
            <?php } ?>
        </ul>
    </section>
</div>