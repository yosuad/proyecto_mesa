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
     <link rel="stylesheet" href="..a/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
</head>

<body>
<?php
include 'menu.php';
?>

 <!-- ESTILOS SWEET ALERT -->
 <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>  
    <!-- MAIN LISTADO  -->
    <div class="content__info">
        <table action="" class="info__layout">
            <tr class="table__titulos">
                <!-- Agregar un estilo CSS para ocultar la celda ID -->
                <td class="ocultar header__titulo" style="display: none;">ID</td>
                <td class="title__board">Medio</td>
                <td class="title__board">Nombre</td>
                <td class ="title__board">Apellido</td>
                <td class="title__board">Fecha</td>
                <td class="title__board">Hora Inicio</td>
                <td class="title__board">Hora Fin</td>
                <td class="title__board">Observación</td>
                <td class="title__board">Opciones</td>
                
            </tr>

            <?php
            // INCLUIR CONEXION
            include '../config/conexiones.php';

            // Consulta SQL para obtener información de la tabla "usuarios" y relacionarla con la tabla "registros" con estado activo
            $sql = "SELECT usuarios.id AS id_usuario, usuarios.medio, usuarios.nombre, usuarios.apellido, registros.id, registros.fecha, registros.hora_inicio, registros.hora_fin, registros.observaciones, registros.estado
            FROM usuarios
            INNER JOIN registros ON usuarios.id = registros.id_usuario
            WHERE registros.estado = 'activo'";

            // traer la base  de datos
            $resultado = mysqli_query($conexion, $sql);
            while ($mostrar = mysqli_fetch_row($resultado)) {
            ?>
                <tr>
                    <td style="display: none;"><?php echo $mostrar['0'] ?></td>
                    <td><?php echo $mostrar['1'] ?></td>
                    <td><?php echo $mostrar['2'] ?></td>
                    <td><?php echo $mostrar['3'] ?></td>
                    <td><?php echo $mostrar['5'] ?></td>
                    <td><?php echo date("h:i A", strtotime($mostrar['6'])); ?></td>
                    <td><?php echo date("h:i A", strtotime($mostrar['7'])); ?></td>                   
                    <td><?php echo $mostrar['8'] ?></td>   
                    
                    <!-- Agregamos el nuevo <td> con la hora formateada -->
                    
                   
                    <td class="layout__opcion">
                        <a class="option" href="edit_reserva.php?
                            id_usuario=<?php echo $mostrar['0']; ?>
                            medio=<?php echo $mostrar['1']; ?>&
                            nombre=<?php echo $mostrar['2']; ?>&
                            apellido=<?php echo $mostrar['3']; ?>&
                            id_registro=<?php echo $mostrar['4']; ?>&
                            fecha=<?php echo $mostrar['5']; ?>&
                            hora_inicio=<?php echo $mostrar['6']; ?>&
                            hora_fin=<?php echo $mostrar['7']; ?>&                            
                            observaciones=<?php echo $mostrar['8']; ?>& 
                            estado=<?php echo $mostrar['9']; ?>&    
                            
                            
                        ">
                        <i class="fas fa-pen-to-square reserva__optionedit menu__option"></i>
                        <span class="menu__overlay optionedit_reserva">Editar</span>
                    </a>    


                    <a class="option" href="#" onclick="confirmDelete(<?php echo $mostrar['4']; ?>, '<?php echo $mostrar['2']; ?>', '<?php echo $mostrar['3']; ?>');">
                        <i class="fas fa-trash menu__option"></i>
                        <span class="menu__overlay optioneli_reserva">Eliminar</span>
                     </a>

                        
                    </td>



                    
                </tr>
            <?php
            }
            mysqli_close($conexion);
            ?>
        </table>
    </div>

    <script>
    function confirmDelete(userId, userName, userLastName) {
        Swal.fire({
            title: "¿Está seguro?",
            text: "Se eliminará la reserva de " + userName + ' ' + userLastName,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Utiliza window.location.href para redirigir al usuario
                window.location.href = `../php/eliminar_reserva.php?id=${userId}`;
            }
        });
    }
</script>



</body>

</html>
