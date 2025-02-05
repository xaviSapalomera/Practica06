<?php 
error_reporting(E_ALL); // Informar de todos los errores
ini_set('display_errors', 1); // Mostrar los errores en pantalla

session_start();
include './model/model_articles.php';
include './model/model_usuaris.php';

echo '<script src="./ts/js/articles_control.js"></script>';
echo '<link rel="stylesheet" href="./estil/pop_up.css">';

// Verifica el titol i el cos introduit
if (isset($_POST["titol"]) && isset($_POST['cos'])) {

    $articleModel = new Article();
    $usuariModel = new Usuari();

    $post_Titol = $_POST['titol'];
    $post_Cos = $_POST['cos'];
    $data = date("Y-m-d");
    $correu = $_SESSION['correu'];      

    // Funcio per tindre el id deñ usuari
    $IDusuaris = $usuariModel->perfilDades($correu); 

    if ($IDusuaris && isset($IDusuaris['id'])) {
        $id_usuari = $IDusuaris['id']; 


        // Inserta el article
        $comprovacio = $articleModel->introduirArticles($post_Titol, $post_Cos, $data, $id_usuari);

        echo $comprovacio;

        if ($comprovacio) {
            echo '<div class="alert-popup success show-alert">¡Artículo agregado con éxito!</div>';        
        } else {
            echo '<div class="alert-popup error show-alert">Error al introducir los datos</div>';        
        }
    } else {
        echo '<div class="alert-popup error show-alert">Error al obtener el usuario</div>';
    }

    
}
?>
