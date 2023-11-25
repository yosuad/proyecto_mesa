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


    // CODIGO

    
include '../config/conexiones.php';

$id = $_GET['id'];

// Primero, selecciona el usuario que se va a eliminar
$select_query = "SELECT * FROM usuarios WHERE id = '$id'";
$select_result = mysqli_query($conexion, $select_query);

if ($select_result && mysqli_num_rows($select_result) > 0) {
    $usuario = mysqli_fetch_assoc($select_result);

    // Luego, inserta el usuario en la tabla "usuarios_eliminados" con la fecha actual
    $fecha_eliminado = date("Y-m-d H:i:s");    
    $insert_query = "INSERT INTO usuarios_eliminados (id, medio, nombre, apellido, tipo, documento, correo, direccion, fecha_eliminado) VALUES (
        '" . $usuario['id'] . "',
        '" . $usuario['medio'] . "',
        '" . $usuario['nombre'] . "',
        '" . $usuario['apellido'] . "',
        '" . $usuario['tipo'] . "',
        '" . $usuario['documento'] . "',
        '" . $usuario['correo'] . "',
        '" . $usuario['direccion'] . "',
        '$fecha_eliminado'
    )";

    $insert_result = mysqli_query($conexion, $insert_query);

    // Finalmente, elimina el usuario de la tabla original
    $delete_query = "DELETE FROM usuarios WHERE id = '$id'";
    $delete_result = mysqli_query($conexion, $delete_query);

    if ($delete_result) {
        header("Location: ../views/usuarios.php");
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    echo "Usuario no encontrado.";
}

?>
