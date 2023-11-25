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


?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesa de Medios</title>
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/reset.css">    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    
    <link rel="stylesheet" href="../assets/fonts/poppins/poppins.css">
</head>

<body>
<?php
include 'menu.php';
?>

    <section class="layout__dashboard">
        <h1 class="dashboard__title">Información General</h1>
        <div class="dashboard__wrapper">

            <!-- Número de Usuarios -->
            <article class="card">
                <header class="header__card">
                    <h2 class="card__title">Número de usuarios</h2>
                    <div class="card__info">
                        <?php
                        include '../config/conexiones.php';

                        // Realizar la consulta para contar los registros en la tabla "usuarios"
                        $sql = "SELECT COUNT(*) as total_usuarios FROM usuarios";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_usuarios = $fila['total_usuarios'];

                        mysqli_close($conexion);
                        ?>
                        <span class="card__indicador"><?php echo $total_usuarios; ?></span>
                        <i class="fas fa-user sidebar__icon card__icon"></i>
                    </div>
                </header>
                <a class="card__detail" href="usuarios.php">Ver listado</a>
            </article> <!-- FIN Número de Usuarios -->

            <!-- Reservas Pendientes -->
            <article class="card">
                <header class="header__card">
                    <h2 class="card__title">Reservas Pendientes</h2>
                    <div class="card__info">
                        <?php
                        include '../config/conexiones.php';

                        // Realizar la consulta para contar los registros en la tabla "registros" donde el estado sea "activo"
                        $sql = "SELECT COUNT(*) as total_reservas FROM registros WHERE estado = 'activo'";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_reservas = $fila['total_reservas'];

                        mysqli_close($conexion);
                        ?>
                        <span class="card__indicador"><?php echo $total_reservas; ?></span>
                        <i class="fas fa-square-check card__icon"></i>
                    </div>
                </header>
                <a class="card__detail" href="reserva.php">Ver listado</a>
            </article>
            <!-- FIN Reservas Pendientes -->
        </div>
    </section>
</body>
</html>
