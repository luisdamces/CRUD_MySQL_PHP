<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen CRUD MySQL & PHP</title>
</head>
<body>
    <?php
        //CONEXIÓN
        $conexion = mysqli_connect("localhost", "root", "", "accesodatos") or
        die("Problemas con la conexión");
        if(isset($_POST['instruccion'])){
            //CONSULTAR
            if(isset($_POST['nombre']) && $_POST['instruccion']=="consultar"){
                $registros = mysqli_query($conexion, "SELECT nombre, categoria, valoracion, url FROM ludoteca where nombre LIKE '".$_POST['nombre']."%';") or
                die("Problemas en el select:" . mysqli_error($conexion));
                while ($reg = mysqli_fetch_array($registros)) {
                    echo $reg['nombre'] . "</br>";
                    echo $reg['categoria'] . "</br>";
                    echo $reg['valoracion'] . "</br>";
                    echo $reg['url'] . "</br>";
                    echo "</br>";
                } 
            }
            //INSERTAR
            if(isset($_POST['nombre']) && isset($_POST['categoria']) && isset($_POST['url']) && isset($_POST['valoracion']) && $_POST['instruccion']=="insertar"){
                $registros = mysqli_query($conexion, "INSERT INTO ludoteca (nombre, categoria, valoracion, url) VALUES ('".$_POST['nombre']."','".$_POST['categoria']."',".$_POST['valoracion'].",'".$_POST['url']."');") or
                die("Problemas al insertar:" . mysqli_error($conexion));
            }
                                                
            //MODIFICAR
            if($_POST['instruccion']=="modificar"){
                $registros = mysqli_query($conexion, "UPDATE ludoteca SET  categoria='".$_POST['categoria']."', valoracion=".$_POST['valoracion'].", url='".$_POST['url']."' WHERE nombre='".$_POST['nombre']."';") or
                die("Problemas al modificar:" . mysqli_error($conexion));
            }

            //ELIMINAR
            if($_POST['instruccion']=="eliminar"){
                $registros = mysqli_query($conexion, "DELETE FROM ludoteca WHERE nombre='".$_POST['nombre']."';") or
                die("Problemas al eliminar:" . mysqli_error($conexion));
            }

            mysqli_close($conexion);
        }
        else{
            echo "<p>Selecciona instrucción a realizar</p>";
        }
    ?>
    <form action="index.php" method="post" name="repaso" target="_self">
    <p>Nombre:&nbsp;<input name="nombre" type="text" /><br />
    Categor&iacute;a:<input name="categoria" type="text" /><br />
    Valoraci&oacute;n:<input name="valoracion" type="text" /><br />
    URL:&nbsp;<input name="url" type="text" /></p>

    <p><select name="instruccion"><option selected="selected" value="">Seleccionar</option><option value="consultar">Consultar</option><option value="insertar">Insertar</option><option value="modificar">Modificar</option><option value="eliminar">Eliminar</option></select></p>

    <p><input name="Enviar" type="submit" /></p>
    </form>
</body>
</html>