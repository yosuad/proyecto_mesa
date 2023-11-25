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


$id = $_GET['id'];




?>



    <!-- ESTILOS SWEET ALERT -->
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- MAIN NUEVO -->
    <div class="update__info">
        <h1 class="titel__update">Ingresar Datos</h1>
                                                   
            
            
        <form action="../php/crear_reserva.php" method="POST" onsubmit="return validarFormulario();">
            <table class="update__contet">

                <tbody class="content__grid">
                    
                    
                <tr class="id__positiongrid"> 
                    <td class="">id</td>                       
                    <td class=""><input type="text" name="id" id="medio" class="nuevo__id" placeholder="id" value="<?php echo $id; ?>"></td>
                </tr>

                    <tr class="medio__positiongrid"> 
                        <td class="title-nueva__reserva">Fecha</td>                       
                        <td><input type="date" name="fecha" id="fecha" idplaceholder="Fecha" class="input__nuevareserva" placeholder="Fecha" value=""></td>
                    </tr>
                    <tr class="nombre__positiongrid">
                         <td class="title-nueva__reserva">Hora de inicio</td>                       
                        <td><input type="time" name="hora_inicio" class="input__nuevareserva" value=""></td>
                    </tr>
                    <tr class="apellido__positiongrid">
                        <td class="title-update__apellido">Hora de finalizar</td>
                        <td><input type="time" name="hora_fin" class="input__nuevareserva" placeholder="Hora de finalizar" value=""></td>
                    </tr>
                    <tr class="tipo__positiongrid">
                        <td class="title-update__tipo">observacion</td>
                        <td><input type="text" name="observaciones" id="tipo" class="update__iput" placeholder="Tipo de Documento" value=""></td>
                    </tr>


                    
                <tr class="documento__positiongrid">    
                    <td class="estado__nuevareserva">Estado</td>
                        <td>
                            <select name="estado" id="documento" class="estado__nuevareserva">
                                <option value="activo" class="value__nuevareserva">Activo</option>
                                <option value="cerrado" class="value__nuevareserva">Cerrado</option>
                            </select>
                        </td>
                </tr>


                    <tr class="btncrear__reserva">
                        <td><input type="submit" value="Guardar" class="actualizar__update"></td>
                    </tr>
                    <tr class="btncalcelar__reserva">
                        <td><a class="cancelar__update" href="usuarios.php">Cancelar</a></td>
                    </tr>
                   

                </tbody>
                </table>
            </form>
        </div>

       
       
    </body>
    </html>
