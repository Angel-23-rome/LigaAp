<?php

$contraseña = "";
$usuario = "root";
$nombreBaseDeDatos = "ligas";
$rutaServidor = "localhost";

try {
    $pdo = new PDO("mysql:host=$rutaServidor;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}

?>