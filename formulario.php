<?php
// importar conexion
require 'includes/config.php';

$db = conectarDB();




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($db,  $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST["apellido"]);
    $carrera = mysqli_real_escape_string($db, $_POST['carrera']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $genero = mysqli_real_escape_string($db, $_POST['sexo']);
    $conocimiento = isset($_POST['conocimiento']) ? mysqli_real_escape_string($db, implode(', ', $_POST['conocimiento'])) : '';
    $fecha = $_POST['fecha'];
    $comentario = mysqli_real_escape_string($db, $_POST['comentario']);
    $foto = $_FILES["foto"];
    // $temp = $_FILES["foto"]["tmp_name"];
    // move_uploaded_file($temp, "imagenes/$foto");

    // Crear carpeta
    $carpetaImagenes = 'imagenes/';

    if (!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
    }

    // Generar un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";


    // Subir la imagen
    move_uploaded_file($foto['tmp_name'], $carpetaImagenes . $nombreImagen);

    // Crear el query

    $query = "INSERT INTO datos (nombre, apellido, email, carrera, sexo, conocimiento, fecha, comentario, foto) VALUES ('$nombre', '$apellido', '$email', '$carrera', '$genero', '$conocimiento', '$fecha', '$comentario', '$nombreImagen')";

    //  echo $query;
    //    Isertar los datos

    $resultado = mysqli_query($db, $query);

    if ($resultado) {
          // Redireccionar al usuario.
          header('Location: dashboard.php?resultado=1');
    }
}



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
    <title>Validaciones</title>
</head>

<body>
    <div class="contenedor">
        <div class="hero"></div>
        <div class="spinner hidden" id="spinner">
            <div class="lds-facebook ">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="logo">
            <p>Aplicaciones <span>Web</span></p>
        </div>
        <div class="principal">

            <div class="contenido">
                <div class="contenido__titulo">
                    <h2>Ingresa tus datos<span>.</span></h2>
                </div>
                <div class="contenedor__formulario">
                    <form id="formulario" action="/formulario.php" method="POST" class="formulario" enctype="multipart/form-data">
                        <div class="input nombre">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" require>
                        </div>
                        <div class="input apellido">
                            <label for="apellido">Apellidos</label>
                            <input type="text" name="apellido" id="apellido" placeholder="Tu apellido">
                        </div>
                        <div class="input email">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Tu correo electronico">
                        </div>
                        <div class="input fecha">
                            <label for="fecha">Fecha de Nacimiento</label>
                            <input type="date" name="fecha" id="fecha">
                        </div>
                        <div class="input sexo">
                            <div class="campo">
                                <p>Sexo</p>
                            </div>
                            <div class="radio-container">
                                <input class="radio-input" id="hombre" type="radio" name="sexo" value="Masculino" />
                                <label class="radio" for="hombre">Hombre</label>
                                <input class="radio-input" id="mujer" type="radio" name="sexo" value="Femenino" />
                                <label class="radio" for="mujer">Mujer</label>
                            </div>
                        </div>
                        <div class="input carrera">
                            <label for="carrera">Carrera</label>
                            <select name="carrera" id="carrera">
                                <option selected disabled>--Seleccionar--</option>
                                <option value="TI Infraestructura de Redes Digitales">TI Infraestructura de Redes
                                    Digitales</option>
                                <option value="TI Desarrollo de Software Multiplataforma">TI Desarrollo de Software
                                    Multiplataforma</option>
                                <option value="Mecatrónica Área Sistemas de Manufactura Flexible">Mecatrónica Área
                                    Sistemas de Manufactura Flexible</option>
                                <option value="Administración Área Capital Humano">Administración Área Capital Humano
                                </option>
                                <option value="Desarrollo de Negocios Área Mercadotecnia">Desarrollo de Negocios Área
                                    Mercadotecnia</option>
                                <option value="Procesos Industriales Área Manufactura">Procesos Industriales Área
                                    Manufactura</option>
                                <option value="Química Área Tecnología Ambiental">Química Área Tecnología Ambiental
                                </option>
                                <option value="Mantenimiento Aeronáutico Área Aviónica">Mantenimiento Aeronáutico Área
                                    Aviónica</option>
                                <option value="TI Entornos Virtuales y Negocios Digitales">TI Entornos Virtuales y
                                    Negocios Digitales</option>
                            </select>
                        </div>
                        <div class="input conocimiento">
                            <div class="campo">
                                <p>Conocimiento</p>
                            </div>
                            <div class="skills">
                                <svg class="checkbox-symbol">
                                    <symbol id="check" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                                    </symbol>
                                </svg>

                                <div class="checkbox-container">
                                    <input class="checkbox-input" id="php" type="checkbox" value="PHP" name="conocimiento[]" />
                                    <label class="checkbox" for="php">
                                        <span>
                                            <svg width="12px" height="10px">
                                                <use xlink:href="#check"></use>
                                            </svg>
                                        </span>
                                        <span>PHP</span>
                                    </label>

                                    <input class="checkbox-input" id="java" type="checkbox" value="JAVA" name="conocimiento[]" />
                                    <label class="checkbox" for="java">
                                        <span>
                                            <svg width="12px" height="10px">
                                                <use xlink:href="#check"></use>
                                            </svg>
                                        </span>
                                        <span>JAVA</span>
                                    </label>
                                    <input class="checkbox-input" id="pythom" type="checkbox" value="Pythom" name="conocimiento[]" />
                                    <label class="checkbox" for="pythom">
                                        <span>
                                            <svg width="12px" height="10px">
                                                <use xlink:href="#check"></use>
                                            </svg>
                                        </span>
                                        <span>Pythom</span>
                                    </label>

                                    <input class="checkbox-input" id="c#" type="checkbox" value="C#" name="conocimiento[]" />
                                    <label class="checkbox" for="c#">
                                        <span>
                                            <svg width="12px" height="10px">
                                                <use xlink:href="#check"></use>
                                            </svg>
                                        </span>
                                        <span>C#</span>
                                    </label>

                                    <input class="checkbox-input" id="Json" type="checkbox" value="Json" name="conocimiento[]" />
                                    <label class="checkbox" for="Json">
                                        <span>
                                            <svg width="12px" height="10px">
                                                <use xlink:href="#check"></use>
                                            </svg>
                                        </span>
                                        <span>Json</span>
                                    </label>

                                    <input class="checkbox-input" id="JavaScript" type="checkbox" value="JavaScript" name="conocimiento[]" />
                                    <label class="checkbox" for="JavaScript">
                                        <span>
                                            <svg width="12px" height="10px">
                                                <use xlink:href="#check"></use>
                                            </svg>
                                        </span>
                                        <span>JavaScript</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="input comentario">
                            <label for="comentario">Sobre Mi</label>
                            <textarea name="comentario" id="comentario" cols="30" rows="5" placeholder="Escribe algo sobre ti"></textarea>
                        </div>
                        <div class="botones">
                            <div class="input foto">
                                <label for="file-input" class="file-label">
                                    Seleccionar archivo
                                </label>
                                <input type="file" id="file-input" class="file-input" name="foto" accept="image/jpeg, image/png" />
                            </div>
                            <div class="btn">
                                <input type="reset" value="Limpiar" class="boton limpiar" id="limpiar">
                                <input type="submit" value="Enviar" class="boton enviar opacity50" id="enviar" disabled>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="js/form.js"></script>
</body>

</html>