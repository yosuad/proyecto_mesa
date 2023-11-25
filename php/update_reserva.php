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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario utilizando $_POST
    $id_reserva = mysqli_real_escape_string($conexion, $_POST["id"]);
    $fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);
    $hora_inicio = mysqli_real_escape_string($conexion, $_POST["hora_inicio"]);
    $hora_fin = mysqli_real_escape_string($conexion, $_POST["hora_fin"]);
    $observaciones = mysqli_real_escape_string($conexion, $_POST["observaciones"]);
    $estado = mysqli_real_escape_string($conexion, $_POST["estado"]);
    

    print $id_reserva;

    // Validar datos según tus necesidades
    // ...

    // Consulta SQL con condición WHERE
    $sql = "UPDATE registros SET fecha = '$fecha', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin', observaciones = '$observaciones', estado = '$estado' WHERE id = '$id_reserva'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) {
        // Registrar el error en un archivo de registro y mostrar un mensaje genérico al usuario
        error_log("Error al insertar datos: " . mysqli_error($conexion));
        echo "Hubo un error al procesar la solicitud. Por favor, inténtalo nuevamente más tarde.";
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
}
?>
