<?php

session_start();

if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
    if ($rol == 1) {
        header("Location: views/dashboard.php");
        exit;
    } elseif ($rol == 2) {
        header("Location: views/supervisor.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fonts/poppins/poppins.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <title>Mesa de Medios</title>
</head>
<body>
    
    <div class="layout__content layout__animation">


        <div class="content__form">
            <span class="content__logo">
                <img class="logo__principal" src="assets/img/logo.png" />
            </span>           
        
        
        <!-- Login Form -->
        <form class="form__content" action="php/login.php" method="post">
            <input type="text" id="login" name="usuario" placeholder="Nombre" class="form__name">
            <input type="password" id="password" name="contraseña" placeholder="Contraseña" class="form__pass">
            <input type="submit" value="Ingresar" class="form__btn">
        </form>

      

        </div>
    </div>
  
</body>
</html>
