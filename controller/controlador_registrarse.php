<?php
$emailValidad = null;
    include './model/model_usuaris.php';

    $usuariModel = new Usuari();

//Comprova que se han introduit tot les credencials per registrarse
if(isset($_POST['nom']) && isset($_POST["cognom"]) && isset($_POST['dni']) && isset($_POST["email"]) && isset($_POST['contrasenya'])){

        $nom = $_POST["nom"];

        $cognom = $_POST['cognom'];

        $dni = $_POST['dni'];
        
        $email_POST = $_POST["email"];

        $contrasenya = $_POST['contrasenya'];

        $contrasenya_hash = hash('sha256', $contrasenya);

        $emailValidad = comprobarEmail($email_POST);

        //si el email es validad el redireix
        if($emailValidad){
    
           $usuariModel->crearUsuari($dni,$nom,$cognom,$email_POST,$contrasenya_hash);

            header('Location: index.php');

        }else if (!$emailValidad){
        
            echo '<p style="text-align: center;">' . 'El usuari ja existeix' . '</p>';

        }
        
    }
    else{
        $nom = "";
        $cognom = "";
        $dni = "";
        $email_POST = '';
        $email_comprovat = '';
        $contrasenya = '';
        $contrasenya_hash = '';
    }       

//Comprova que el email introduit no esta registrat    
function comprobarEmail($email_POST){
    $usuariModel = new Usuari();

$usuaris = $usuariModel->mostrarUsuaris();

        foreach($usuaris as $usuari){
        
            if($usuari['email'] == $email_POST){

                return false;    

            }else{

                return true;
                
            }
        
        } 
    } 
?>