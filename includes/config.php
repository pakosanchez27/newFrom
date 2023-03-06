<?php

function conectarDB(){
    $db = mysqli_connect('localhost', 'root', 'root', 'formulario');

    if (!$db) {
        echo "Error al conectar";
        exit;
    }
    
    return $db;

}


?>
