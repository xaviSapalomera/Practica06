<?php
include './model/model_usuaris.php';

$usuariModel = new Usuari();

$usuaris = $usuariModel->mostrarUsuaris();

echo '<table border="1px white">';

echo '<tr>';
echo '<th>DNI</th>';
echo '<th>NICKNAME</th>';
echo '<th>NOM</th>';
echo '<th>COGNOM</th>';
echo '<th>EMAIL</th>';
echo '<th>ADMIN</th>';
echo '</tr>';

//Motrar els usuaris de la base de dades
foreach ($usuaris as $usuari) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($usuari['dni']) . '</td>';
    echo '<td>' . htmlspecialchars($usuari['nickname']) . '</td>';
    echo '<td>' . htmlspecialchars($usuari['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($usuari['cognom']) . '</td>';
    echo '<td>' . htmlspecialchars($usuari['email']) . '</td>';
    echo '<td>' . htmlspecialchars($usuari['admin']) . '</td>';
    echo '</tr>';
}

echo '</table>';
?>