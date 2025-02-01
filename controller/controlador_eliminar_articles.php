<?php

include './model/model_articles.php';

$articleModel = new Article();

    if(isset($_POST['id'])){

        $id = $_POST['id'];


     $articleModel->borrarArticles($id);

        

    }

?>