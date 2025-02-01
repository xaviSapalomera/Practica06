<?php
error_reporting(E_ALL); // Informar de todos los errores
ini_set('display_errors', 1); // Mostrar los errores en pantalla
include './model/model_articles.php';

if(isset($_POST['titol']) && isset($_POST['cos']) && isset($_POST['id'])){


    $articleModel = new Article;
   
    $titol = $_POST['titol'];
    $cos = $_POST['cos'];
    $id = $_POST['id'];

    $articleModel->actualitzarArticle($titol,$cos,$id);

}else{

}


?>