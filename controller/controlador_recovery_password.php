<?php
// Cargar el autoload de Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

if (isset($_POST['correu']) && filter_var($_POST['correu'], FILTER_VALIDATE_EMAIL)) {
    $destinatari = $_POST['correu'];  // Asegúrate de sanitizar la entrada

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();                                            // Establecer el uso de SMTP
        $mail->Host       = 'smtp.sapalomera.cat';                    // Especificar el servidor SMTP
        $mail->SMTPAuth   = true;                                     // Habilitar la autenticación SMTP
        $mail->Username   = 'x.gallego@sapalomera.cat';               // Tu correo electrónico
        $mail->Password   = 'tu_contraseña';                          // Contraseña de tu correo electrónico (considera usar un archivo de configuración)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           // Habilitar cifrado TLS
        $mail->Port       = 587;                                      // Puerto SMTP (generalmente 587 para TLS)

        // Remitente y destinatario
        $mail->setFrom('x.gallego@sapalomera.cat', 'Tu Nombre');
        $mail->addAddress($destinatari, 'Nombre Destinatario');       // Usar la variable destinatario

        // Contenido del correo
        $mail->isHTML(true);                                          // Establecer el formato de correo como HTML
        $mail->Subject = 'Asunto del Correo';
        $mail->Body    = 'Este es un <b>correo de prueba</b> enviado con PHPMailer';
        $mail->AltBody = 'Este es un correo de prueba enviado con PHPMailer en formato texto sin formato';

        // Enviar el correo
        $mail->send();
        echo 'El mensaje ha sido enviado correctamente';
    } catch (Exception $e) {
        echo "No se pudo enviar el mensaje. Error de PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Por favor, ingresa un correo válido.";
}
?>

