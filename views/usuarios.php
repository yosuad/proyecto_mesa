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
    <!-- ESTILOS SWEET ALERT -->
    <link rel="stylesheet" href="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
<body >
<?php
include 'menu.php';
?>
    <!-- ESTILOS SWEET ALERT -->
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>  
    
    <!-- MAIN LISTADO  -->
    <div class="content__info">
    <table action="" class="info__layout" id="registros">
      
        <tr class="table__titulos">  
          <!-- Agregar un estilo CSS para ocultar la celda ID -->
            <td class="ocultar header__titulo" style="display: none;">ID</td>
            <td class="title__board">Medio</td>
            <td class="title__board">Nombre</td>
            <td class="title__board">Apellido</td>
            <td class="title__board">Tipo</td>
            <td class="title__board">Documento</td> 
            <td class="title__board">Correo</td>
            <td class="title__board">Dirección</td>           
            <td class="title__board">Opciones</td>
        </tr>

        <?php
        include '../config/conexiones.php';

        // Organizar los campos
        $sql = "SELECT id, medio, nombre, apellido, tipo, documento, correo, direccion FROM usuarios order by id desc";
        // Traer la base de datos
        $resultado = mysqli_query($conexion, $sql);

        while ($mostrar = mysqli_fetch_row($resultado)) {            
        ?>
        <tr>                                    
            <td style="display: none;"><?php echo $mostrar['0']?></td> 
            <td><?php echo $mostrar['1']?></td>
            <td><?php echo $mostrar['2']?></td>
            <td><?php echo $mostrar['3']?></td>
            <td><?php echo $mostrar['4']?></td>
            <td><?php echo $mostrar['5']?></td> 
            <td><?php echo $mostrar['6']?></td>
            <td><?php echo $mostrar['7']?></td>    
            
            
            <td class="layout__opcion">
                <a class="option" href="update.php?
                    id=<?php echo $mostrar['0']; ?>&
                    medio=<?php echo $mostrar['1']; ?>&
                    nombre=<?php echo $mostrar['2']; ?>&
                    apellido=<?php echo $mostrar['3']; ?>&
                    tipo=<?php echo $mostrar['4']; ?>&
                    documento=<?php echo $mostrar['5']; ?>&
                    correo=<?php echo $mostrar['6']; ?>&
                    direccion=<?php echo urlencode(htmlspecialchars($mostrar['7'])); ?>&                   
                ">
                    <i class="fas fa-pen-to-square menu__option"></i>
                    <span class="menu__overlay menu__editar">Editar</span>
                </a>                    

                <a class="option" href="#" onclick="confirmDelete(<?php echo $mostrar['0']; ?>, '<?php echo $mostrar['2']; ?>', '<?php echo $mostrar['3']; ?>');">
                    <i class="fas fa-trash menu__option"></i>
                    <span class="menu__overlay menu__eliminar">Eliminar</span>
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
        text: userName + ' ' + userLastName + " se eliminará permanentemente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Utiliza window.location.href para redirigir al usuario
            window.location.href = `../php/delete.php?id=${userId}`;
        }
    });
}

    </script>
</body>
</html>




