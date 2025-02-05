<?php
header('Content-Type: application/json');
include 'model_articles.php';

$articleModel = new Article();
$articles = $articleModel->mostrarTotsArticles();

if ($articles === false || empty($articles)) {
    echo json_encode(["error" => "No se a pugut obtindre el article"]);
} else {
    echo json_encode($articles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>
