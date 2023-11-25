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


/* FIN SESSION */
/* INICIO CODIGO*/
   

include '../config/conexiones.php';

$id = $_GET['id'];

// ELIMINAR REGISTRO
$delete_query = "DELETE FROM registros WHERE id = '$id'";
$delete_result = mysqli_query($conexion, $delete_query);

if ($delete_result) {
    header("Location: ../views/reserva.php");
} else {
    echo "Error al eliminar registro.";
}
?>
