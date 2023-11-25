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

// Rest of your code...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesa de Medios</title>
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fonts/poppins/poppins.css">
    <!-- ESTILOS SWEET ALERT -->
    <link rel="stylesheet" href="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
<body>

<?php
include 'menu.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$medio = isset($_GET['medio']) ? $_GET['medio'] : '';
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$documento = isset($_GET['documento']) ? $_GET['documento'] : '';
$correo = isset($_GET['correo']) ? $_GET['correo'] : '';
$direccion = isset($_GET['direccion']) ? htmlspecialchars($_GET['direccion']) : '';
?>


    <!-- ESTILOS SWEET ALERT -->
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- MAIN NUEVO -->
    <div class="update__info">
        <h1 class="titel__update">Ingresar Datos</h1>
                                                   
            
            
        <form action="../php/update_usuario.php" method="POST" onsubmit="return validarFormulario();">
            <table class="update__contet">

                <tbody class="content__grid">
                    
                    
                    <tr class="id__positiongrid"> 
                        <td class="">id</td>                       
                        <td class=""><input type="text" name="id" id="medio" class="nuevo__id" placeholder="id" value="<?=$id?>"></td>
                    </tr>
                    <tr class="medio__positiongrid"> 
                        <td class="title-update__medio">Medio</td>                       
                        <td><input type="text" name="medio" id="medio" class="update__iput" placeholder="Medio" value="<?=$medio?>"></td>
                    </tr>
                    <tr class="nombre__positiongrid">
                         <td class="title-update__nombre">Nombre</td>                       
                        <td><input type="text" name="nombre" id="nombre" class="update__iput" placeholder="Nombre" value="<?=$nombre?>"></td>
                    </tr>
                    <tr class="apellido__positiongrid">
                        <td class="title-update__apellido">Apellido</td>
                        <td><input type="text" name="apellido" id="apellido" class="update__iput" placeholder="Apellido" value="<?=$apellido?>"></td>
                    </tr>
                    <tr class="tipo__positiongrid">
                        <td class="title-update__tipo">Tipo de Documento</td>
                        <td><input type="text" name="tipo" id="tipo" class="update__iput" placeholder="Tipo de Documento" value="<?=$tipo?>"></td>
                    </tr>
                    <tr class="documento__positiongrid">
                        <td class="title-update__documento">Documento</td>
                        <td><input type="number" name="documento" id="documento" class="update__iput" placeholder="Documento" value="<?=$documento?>"></td>
                    </tr>
                    <tr class="correo__positiongrid">
                        <td class="title-update__correo">Correo</td>
                        <td><input type="email" name="correo" id="correo" class="update__iput" placeholder="Correo" value="<?=$correo?>"></td>
                    </tr>
                    <tr class="direccion__positiongrid">
                        <td class="title-update__direccion">Dirección</td>
                        <td><input type="text" name="direccion" id="direccion" class="update__iput" placeholder="Dirección" value="<?=$direccion?>"></td>
                    </tr>

                    <tr class="btn__positiongrid">
                        <td><input type="submit" value="Actualizar" class="actualizar__update"></td>
                    </tr>
                    <tr class="cancelar__positiongrid">
                        <td><a class="cancelar__update" href="usuarios.php">Cancelar</a></td>
                    </tr>
                 

                    
                    <tr class="reserva__positiongrid">
                        <td>
                            <a class="reserva__update" href="nueva_reserva.php?
                                id=<?php echo $id; ?>
                               ">
                                Crear reserva
                            </a>
                        </td>
                    </tr>





                </tbody>
                </table>
            </form>
        </div>
       
    </body>
    </html>
