<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db_mesa_medios";
    // $db1 = "mesa_de_medios";

    $conexion = mysqli_connect($host, $user, $pass, $db);
    // $conexion2 = mysqli_connect($host, $user, $pass, $db1);



    //Forma como reviso que la base de datos tenga conexion 
    
    // if($conexion){
    //     echo 'Conectado exitoramente a la Base de Datos';
    // } else{
    //     echo 'No se ha podido conectar a la Base de datos';
    // }
    

?>
