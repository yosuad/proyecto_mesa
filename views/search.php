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
    <title>Document</title>
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
    ?>

    <!-- ESTILOS SWEET ALERT -->
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- MAIN BUSQUEDA -->
    <div class="content__info">

        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <table class="nuevo__contet">
                <tbody class="tbody__content">
                    <tr class="nuevo__nombre">
                        <td class="title__nuevonom">Nombre</td>
                        <td class="content__inputnew"><input type="text" name="nombre" id="nombre" class="new__iput" placeholder="Nombre"></td>
                    </tr>
                    <tr class="nuevo__documento">
                        <td class="title__nuevo">Documento</td>
                        <td class="content__inputnew"><input type="number" name="documento" id="documento" class="new__iput" placeholder="Documento"></td>
                    </tr>
                    <tr class="content__btn">
                        <td><input type="submit" value="Buscar" class="new__btn" name="buscar"></td>
                    </tr>
                </tbody>
            </table>
        </form>

        <!-- MAIN LISTADO -->
        <div class="content__info">
            <table action="" class="info__layout" id="registros">
                <tr class="table__titulos">
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

                // REVISAR SI SE PRESIONA BUSCAR
                if (isset($_POST['buscar'])) {
                    $nombre = $_POST['nombre'];
                    $documento = $_POST['documento'];

                    if (empty($nombre) && empty($documento)) {
                        echo "
                            <script>
                            Swal.fire({
                                title: 'Campos vacíos',
                                text: 'Por favor digite los datos del usuario que desea buscar',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInUp animate__faster'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutDown animate__faster'
                                }
                            });
                        </script>
                        ";
                    } else {
                        $sql = "SELECT * FROM usuarios WHERE";

                        if (!empty($nombre)) {
                            $sql .= " nombre LIKE '%" . $nombre . "%'";
                        }

                        if (!empty($documento)) {
                            if (!empty($nombre)) {
                                $sql .= " AND";
                            }
                            $sql .= " documento = " . $documento;
                        }

                        $resultado = mysqli_query($conexion, $sql);

                        // Resto del código...
                    }
                } else {
                    // SI NO ENCUENTRA REGISTROS
                }

                if (isset($resultado) && $resultado) {
                    while ($mostrar = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <tr>
                            <td style="display: none;"><?php echo $mostrar['id']; ?></td>
                            <td><?php echo $mostrar['medio']; ?></td>
                            <td><?php echo $mostrar['nombre']; ?></td>
                            <td><?php echo $mostrar['apellido']; ?></td>
                            <td><?php echo $mostrar['tipo']; ?></td>
                            <td><?php echo $mostrar['documento']; ?></td>
                            <td><?php echo $mostrar['correo']; ?></td>
                            <td><?php echo htmlspecialchars($mostrar['direccion']); ?></td>
                            <td class="layout__opcion">
                                <a class="option" href="update.php?id=<?php echo $mostrar['id']; ?>&medio=<?php echo $mostrar['medio']; ?>&nombre=<?php echo $mostrar['nombre']; ?>&apellido=<?php echo $mostrar['apellido']; ?>&tipo=<?php echo $mostrar['tipo']; ?>&documento=<?php echo $mostrar['documento']; ?>&correo=<?php echo $mostrar['correo']; ?>&direccion=<?php echo urlencode(htmlspecialchars($mostrar['direccion'])); ?>">
                                    <i class="fas fa-pen-to-square menu__option"></i>
                                    <span class="menu__overlay optionedit_search">Editar</span>
                                </a>
                                <a class="option" href="#" onclick="confirmDelete(<?php echo $mostrar['id']; ?>, '<?php echo $mostrar['nombre']; ?>', '<?php echo $mostrar['apellido']; ?>');">
                                    <i class="fas fa-trash menu__option"></i>
                                    <span class="menu__overlay optioneli_search">Eliminar</span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                }
                mysqli_close($conexion);
                ?>
            </table>
        </div>
    </div>  
        
</body>
</html>