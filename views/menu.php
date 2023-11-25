<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="layout">
  <!-- Menu -->
  <div class="sidebar">

    <div class="sidebar__logo"></div>
      <ul class="sidebar__manu">

        <li class="sidebar__option">
          <a href="dashboard.php" class="sidebar__link">
            <i class="fas fa-tachometer-alt icon__dashboard"></i>
            <span class="sidebar__span">Dashboard</span>
          </a>
        </li>

        <li class="sidebar__option">
          <a href="usuarios.php" class="sidebar__link">
            <i class="fas fa-user sidebar__icon icon__sidebar icon__dashboard"></i>
            <span class="sidebar__span">Usuarios</span>
          </a>
        </li>

        <li class="sidebar__option">
          <a href="reserva.php" class="sidebar__link">
            <i class="fas fa-calendar sidebar__icon icon__dashboard"></i>
            <span class="sidebar__span">Reserva</span>
          </a>
        </li>

        <li class="sidebar__option">
          <a href="nuevo.php" class="sidebar__link">
            <i class="fas fa-solid fa-plus sidebar__icon icon__dashboard"></i>
            <span class="sidebar__span">Nuevo Usuario</span>
          </a>
        </li>

        <li class="sidebar__option">
          <a href="search.php" class="sidebar__link">
            <i class="fas fa-magnifying-glass sidebar__icon icon__dashboard"></i>
            <span class="sidebar__span">Buscar Usuario</span>
          </a>
        </li>

        <li class="sidebar__option">
          <a href="registros.php" class="sidebar__link">
            <i class="fas fa-notes-medical sidebar__icon icon__dashboard"></i>
            <span class="sidebar__span">Registros</span>
          </a>
        </li>

        <li class="sidebar__option sidebar__out">
          <a href="../php/cerrar_session.php" class="sidebar__link">
            <i class="fas fa-right-from-bracket sidebar__icon icon__dashboard"></i>
            <span class="sidebar__span">Cerrar Session</span>
          </a>
        </li> 
              
        
      </ul>
  </div>
 

   <!-- DASHBOARD  -->
  <div class="main__content">
    <div class="content__header">
      <div class="header__title">
        <span>CRM</span>
        <h2>Dashboard Mesa de Medios</h2>
      </div>
      <div class="user__info">
        <div class="search__box">
          <!-- <i class="fas fa-magnifying-glass"></i> -->
          <!-- <input type="text" placeholder="search"> -->
        </div>
        <img class="header__img" src="http://localhost/proyecto_mesa/assets/img/logo.png" alt="">
      </div>
    </div>

    
</body>
</html>