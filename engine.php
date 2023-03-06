<?php
//   importar la conexion 
require 'includes/config.php';

$db = conectarDB();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /');
}

// Hacer la consulta

$query = "SELECT * FROM datos WHERE id = $id";

// Traer los resultados

$resultado = mysqli_query($db, $query);

$dato = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Resultado</title>
</head>
<body>

    <div class="presentacion">
        <div class="perfil">
        <img  src="/imagenes/<?php echo $dato['foto']; ?>" alt="Foto perfil">
            <p><?php echo $dato['nombre']; ?> <span><?php echo $dato['apellido']; ?></span></p>
            <p class="perfil__carrera"><span><?php echo $dato['carrera']; ?>"</span></p>
        </div>
        <div class="barra">
            <div class="datos">
                <img src="img/<?php echo $dato['sexo']; ?>.png">
                <span><?php echo $dato['sexo']; ?></span>
            </div>
            <div class="datos">
                <img src="img/cumple.png">
                <span><?php echo $dato['fecha']; ?></span>
            </div>
            <div class="datos">
                <img src="img/correo.png">
                <span><?php echo $dato['email']; ?></span>
            </div>
        </div>
        <hr>
        <div class="habilidades">
            <div class="titulo">
                <h2>Acerca de mi</h2>
            </div>
            <div class="acerca">
                <p><?php echo $dato['comentario']; ?></p>
            </div>
        </div>

        <hr>
        <div class="habilidades">
            <div class="titulo">
                <h2>Skills</h2>
            </div>
            <div class="skill">
                <p> <span><?php echo $dato['conocimiento']; ?></span></p>
            </div>
        </div>

        <div class="regresar">
            <a href="dashboard.php" class="boton enviar">Regresar</a>
        </div>
    </div>
</body>
</html>