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
?>
    <!-- ESTILOS SWEET ALERT -->
    <script src="../assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- MAIN NUEVO -->
    <div class="content__info">
        <h1>Ingresar Datos</h1>
        <form action="../php/nuevo_usuario.php" method="POST" onsubmit="return validarFormulario();">
            <table class="nuevo__contet">

                <tbody class="tbody__content">
                    
                    <tr class="nuevo__medio"> 
                        <td class="title__nuevome">Medio</td>                       
                        <td class="content__inputnew"><input type="text" name="medio" id="medio" class="new__iput" placeholder="Medio"></td>
                    </tr>
                    <tr class="nuevo__nombre">
                         <td class="title__nuevonom">Nombre</td>                       
                        <td class="content__inputnew"><input type="text" name="nombre" id="nombre" class="new__iput" placeholder="Nombre"></td>
                    </tr>
                    <tr class="nuevo__apellido">
                        <td class="title__nuevo">Apellido</td>
                        <td class="content__inputnew"><input type="text" name="apellido" id="apellido" class="new__iput" placeholder="Apellido"></td>
                    </tr>
                    <tr class="nuevo__tdocumento">
                        <td class="title__nuevo">Tipo de Documento</td>
                        <td class="content__inputnew"><input type="text" name="tipo" id="tipo" class="new__iput" placeholder="Tipo de Documento"></td>
                    </tr>
                    <tr class="nuevo__documento">
                        <td class="title__nuevo">Documento</td>
                        <td class="content__inputnew"><input type="number" name="documento" id="documento" class="new__iput" placeholder="Documento"></td>
                    </tr>
                    <tr class="nuevo__correo">
                        <td class="title__nuevocor">Correo</td>
                        <td class="content__inputnew"><input type="email" name="correo" id="correo" class="new__iput" placeholder="Correo"></td>
                    </tr>
                    <tr>
                        <td class="title__nuevodir">Dirección</td>
                        <td class="content__inputnewdir"><input type="text" name="direccion" id="direccion" class="new__iput input__direccion" placeholder="Dirección"></td>
                    </tr>
                    <tr class="content__btn">
                        <td><input type="submit" value="Guardar" class="new__btn"></td>
                    </tr>

                </table>
            </form>
        </div>

        <script>
        function validarFormulario() {
            var medio = document.getElementById("medio").value;
            var nombre = document.getElementById("nombre").value;
            var apellido = document.getElementById("apellido").value;
            var tipo = document.getElementById("tipo").value;
            var documento = document.getElementById("documento").value;
            var correo = document.getElementById("correo").value;
            var direccion = document.getElementById("direccion").value;
            
            if (medio === "" || nombre === "" || apellido === "" || tipo === "" || documento === "" || correo === "" || direccion === "") {
                Swal.fire("Todos los campos de usuario son obligatorios!");
                return false;
            }
        }
        </script>
    </body>
    </html>
