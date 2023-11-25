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
$medio = mysqli_real_escape_string($conexion, $_POST['medio']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
$tipo = mysqli_real_escape_string($conexion, $_POST['tipo']);
$documento = mysqli_real_escape_string($conexion, $_POST['documento']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);

$sql = "INSERT INTO usuarios (medio, nombre, apellido, tipo, documento, correo, direccion) VALUES ('$medio', '$nombre', '$apellido', '$tipo', '$documento', '$correo', '$direccion')";

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    echo "Error al insertar datos: " . mysqli_error($conexion);
} else {
    ?>
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script>
        Swal.fire({
            title: "<?php echo $nombre . ' ' . $apellido; ?> se agregado con éxito",
            icon: "success"
        }).then(function() {
            Swal.fire({
                title: 'Desea agregar un nuevo usuario',
                icon: 'question',
                iconHtml: '؟',
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
                showCancelButton: true,
                showCloseButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'http://localhost/proyecto_mesa/views/nuevo.php';
                } else {
                    window.location.href = '../views/dashboard.php';
                }
            });
        });
    </script>
    <?php
}
?>

</body>
</html>
