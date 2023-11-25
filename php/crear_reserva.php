<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <link rel="stylesheet" href="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
<body>

<?php
session_start();

// Set the inactivity timeout to 5 minutes
$inactive_timeout = 300; // 5 minutes in seconds

// Check if the session is not set or has expired
if (!isset($_SESSION['rol']) || (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_timeout))) {
    // Destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Update the last activity timestamp
$_SESSION['last_activity'] = time();

// Check if the user has the role of administrator
if ($_SESSION['rol'] == 2) {
    // Redirect to supervisor.php if the user has the role 2 (administrator)
    header("Location: supervisor.php");
    exit(); // Make sure to exit the script after the redirection
}


// INCLUIR CONEXIÓN
include '../config/conexiones.php';

// Validar y sanitizar los datos del formulario para evitar inyecciones SQL

// Archivo: crear_reserva.php

// Verifica si se han enviado datos mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recoge los datos del formulario utilizando $_POST
    $id = $_POST["id"];
    $fecha = $_POST["fecha"];
    $hora_inicio = $_POST["hora_inicio"]; // Ten en cuenta que aquí usé el nombre del campo del formulario
    $hora_fin = $_POST["hora_fin"];
    $observaciones = $_POST["observaciones"];
    $estado = $_POST["estado"];


}


$sql = "INSERT INTO registros (fecha, hora_inicio, hora_fin, observaciones, estado, id_usuario) VALUES ('$fecha', '$hora_inicio', '$hora_fin', '$observaciones', '$estado', '$id')";

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    echo "Error al insertar datos: " . mysqli_error($conexion);
} else {
    ?>
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script>
        Swal.fire({
            title: "Reserva ingresada",
            icon: "success"
        }).then(function() {
            window.location.href = '../views/reserva.php';
        });
    </script>
    <?php
}
?>
