<?php
// Asegúrate de que session_start() esté al principio


include './model/model_usuaris.php';

// Posa els els intents a 0
if (!isset($_SESSION['intents_fallits'])) {
    $_SESSION['intents_fallits'] = 0;
}

// Verifica si la sesió esta activa
if (isset($_SESSION['mantindre_sessio']) && $_SESSION['mantindre_sessio'] === true) {
    header('Location: index_session.php');
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['LOGIN'])) {
    $correu = filter_var($_POST['correu'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $contrasenya_hash = hash('sha256', $password);

    // Verifica els intents fallits
    if ($_SESSION['intents_fallits'] >= 3) {
        if (empty($_POST['g-recaptcha-response']) || !validateRecaptcha($secretKey, $_POST['g-recaptcha-response'])) {
            echo "<p style='color: red; text-align: center;'>ReCAPTCHA incorrecto. Intenta de nuevo.</p>";
            exit();
        }
    }

    // Verifica login
    $loginVerificat = verificarLogin($correu, $contrasenya_hash);
    if ($loginVerificat) {
        $_SESSION['intents_fallits'] = 0;
        $rememberME = isset($_POST['remember_me']);

        functionVerificarConta($loginVerificat, $correu, $rememberME);
    } else {
        $_SESSION['intents_fallits']++;
        echo "<p style='color: red; text-align: center;'>Credenciales incorrectas. Intenta de nuevo.</p>";
    }
}

// Funció per validar el reCAPTCHA
function validateRecaptcha($secretKey, $recaptchaResponse) {
    if (empty($recaptchaResponse)) {
        return false;
    }

    $verificationUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    ];

    
    $ch = curl_init($verificationUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($response, true);
    return $responseKeys['success'] ?? false;
}

// Funció per verificar el login
function verificarLogin($correu, $password) {

    $UsuariModel = new Usuari();

    $usuaris = $UsuariModel->mostrarUsuaris();

    foreach ($usuaris as $usuari) {
        if ($usuari['email'] === $correu && $usuari['contrasenya'] === $password) {
            $_SESSION['idUsuari'] = $usuari['id']; 
            return true;
        }
    }
    return false;
}

// Funció per gestionar l'usuari verificat
function functionVerificarConta($loginVerificat, $correu, $rememberME) {
    $usuariModel = new Usuari();
    if ($loginVerificat) {
        if ($rememberME) {
            $_SESSION['mantindre_sessio'] = true;
        }

        $_SESSION['correu'] = $correu;
        $_SESSION['inici_sessio'] = time();
        $_SESSION['verificat'] = true;

        $resultat = $usuariModel->perfilDades($correu);

        
        if ($resultat && is_array($resultat)) {
            $_SESSION['nickname'] = $resultat['nickname'];
        }

        if ($rememberME) {
            setcookie("remember_me", $correu, time() + (86400 * 30), "/", "", true, true); 
        }

        header('Location: index_session.php');
        exit();
    } else {
        echo "<p style='text-align: center;'>Credenciales incorrectas</p>";
    }
}
?>
