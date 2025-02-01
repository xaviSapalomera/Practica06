<?php
require_once '../vendor/autoload.php';

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

try {
    // Obtindra el ID del artícle   desde la URL
    $article_id = isset($_GET['id']) ? $_GET['id'] : '1';
    $url = "http://localhost/Practica06-main/article.php?id=" . $article_id;

    // Crear el renderer con los namespaces correctos
    $renderer = new ImageRenderer(
        new RendererStyle\RendererStyle(400), // Intentaste llamar a RendererStyle incorrectamente
        new SvgImageBackEnd()
    );

    $writer = new Writer($renderer);
    $qrCode = $writer->writeString($url);

    // Mostrar el código QR en formato SVG
    header('Content-Type: image/svg+xml');
    echo $qrCode;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
