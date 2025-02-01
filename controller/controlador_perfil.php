<?php
error_reporting(E_ALL); // Informar de todos los errores
ini_set('display_errors', 1); // Mostrar los errores en pantalla

include "./model/model_usuaris.php";

echo '<script src="./ts/js/articles_control.js"></script>';
echo '<link rel="stylesheet" href="./estil/pop_up.css">';

$usuariModel = new Usuari();

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correu'])) {
    echo "<h1>No has iniciat sessió</h1>";
    exit();
}

$correu = $_SESSION['correu'];

// Obtener datos del perfil
$resultat = $usuariModel->perfilDades($correu);

if ($resultat) {
    echo "<div style='color:white;font-size:30px;'>";
    echo "NICKNAME: " . htmlspecialchars($resultat["nickname"] ?? 'Sense Nickname', ENT_QUOTES, 'UTF-8') . "<br><br>";
    echo "CORREU: " . htmlspecialchars($resultat["email"] ?? 'Sense Email', ENT_QUOTES, 'UTF-8') . "<br><br>";
    echo "NOM: " . htmlspecialchars($resultat["nom"] ?? 'Sense Nom', ENT_QUOTES, 'UTF-8') . "<br><br>";
    echo "COGNOM: " . htmlspecialchars($resultat["cognom"] ?? 'Sense Cognom', ENT_QUOTES, 'UTF-8') . "<br><br>";
    echo "</div>";
} else {
    echo "<h1>Usuari no trobat</h1>";
    exit();
}

// Formulario para cambiar nickname
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nomUsuari'])) {
    $nickname = htmlspecialchars($_POST['nomUsuari'], ENT_QUOTES, 'UTF-8');
    if ($nickname != $resultat['nickname'] && $usuariModel->actualitzarNickname($resultat['id'], $nickname)) {
        echo "<h1 class='alert-popup success show-alert'>Nickname actualitzat correctament</h1>";
    } else {
        echo "<h1 class='alert-popup error show-alert'>No se pudo actualizar el nickname</h1>";
    }
}

// Formulario para cambiar contraseña
if (!empty($_POST["oldpassword"]) && !empty($_POST["newpassword"]) && !empty($_POST["re-newpassword"])) {
    $antiga_password = $_POST["oldpassword"];
    $nova_password = $_POST["newpassword"];
    $re_nova_password = $_POST["re-newpassword"];

    // Verificar que las contraseñas coincidan
    if ($nova_password === $re_nova_password) {
        // Verificar la contraseña antigua
        if (password_verify($antiga_password, $resultat["contrasenya"])) {
            // Actualizar la nueva contraseña
            $nova_password_hash = password_hash($nova_password, PASSWORD_DEFAULT);
            if ($usuariModel->actualitzarPassword($resultat['id'], $nova_password_hash)) {
                echo "<h1>Contrasenya actualitzada correctament</h1>";
            } else {
                echo "<h1>Error al actualitzar la contrasenya</h1>";
            }
        } else {
            echo "<h1>La contrasenya antiga no és correcta</h1>";
        }
    } else {
        echo "<h1>Les contrasenyes no coincideixen</h1>";
    }
}

// Formulario HTML para actualizar el nombre de usuario
?>
<form method="post">
    <input type="text" name="nomUsuari" value="<?= htmlspecialchars($resultat['nickname'] ?? '') ?>" placeholder="Nuevo Nickname">
    <input type="submit" value="Cambiar Nickname">
</form>

<!-- Formulario HTML para actualizar la contraseña -->
<form method="post">
    <input type="password" name="oldpassword" placeholder="Antigua Contraseña">
    <input type="password" name="newpassword" placeholder="Nueva Contraseña">
    <input type="password" name="re-newpassword" placeholder="Repita Nueva Contraseña">
    <input type="submit" value="Cambiar Contraseña">
</form>

<?php
exit();
?>
