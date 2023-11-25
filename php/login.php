<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="http://localhost/proyecto_mesa/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
  <script src="http://localhost/proyecto_mesa/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>
<body>
  <?php
  // Cargar sesión
  session_start();
  // Incluir conexión
  include '../config/conexiones.php';

  // Asignar mis variables
  $usuario = $_POST['usuario'];
  $contraseña = $_POST['contraseña'];
  $contraseña = hash('sha512', $contraseña);

  // Consultar la base de datos
  $consulta = "SELECT * FROM user_security WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
  $resultado = mysqli_query($conexion, $consulta);

  if (mysqli_num_rows($resultado) == 0) {
    // No se encontró el usuario, mostrar un mensaje de error
    echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'El usuario no existe',
          text: 'Por favor, verifique los datos introducidos!'
        }).then(function() {
          window.location = '../index.php';
        });
      </script>";
      exit;
  } else {
    $filas = mysqli_fetch_array($resultado);
    $rol = $filas['id_cargo'];
    $_SESSION['rol'] = $rol;

    if ($rol == 1) {       
       header("Location: ../views/dashboard.php");
    } elseif ($rol == 2) {
      // Si id_cargo es 2 (cliente), redirigir a supervisor.php
      header("Location: ../views/supervisor.php");
    }
  }
  ?>
</body>
</html>
