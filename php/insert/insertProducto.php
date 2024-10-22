<?php
include_once('../configure/configure.php');

//*Pagina dedicada para insertar los productos creados

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //*Obtencion de la información
    $Producto = $_POST['producto'];
    $Tipo = $_POST['tipo'];
    $archivo = $_FILES['archivo']['name'];

    if(isset($archivo) && $archivo != ""){
        $type = $_FILES['archivo']['type'];
        $size = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];

        if(!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) &&($size < 2000000))){
            echo '<div><br>Error. La extensión o el tamaño de los archivos es incorrecto.</br> - Se permiten archivos .gif, .jpg, .png y de 2mB como máximo.</b></div>';
        } else {
            if(move_uploaded_file($temp, '../../images/imgProds/'.$archivo)){
                chmod('../../images/imgProds/'.$archivo, 0777);
                $tiempo = time();
                $imagenGuardadaBBDD = 'images/imgProds/'.$archivo;
            }
        }
    }

    //Preparar sentencia SQL
    $sql = "INSERT INTO productos (nombre, idTipo, imagen) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt -> bind_param("sis", $Producto, $Tipo, $imagenGuardadaBBDD);

        if($stmt->execute()){
            echo "<h2> Información almacenada con exito</h2></>";
            echo "<p> Nombre: ".$Producto."</p></br>";
            echo "<img src='../../".$imagenGuardadaBBDD."'>";
            echo "<a class='button' href='../../index.php'>Inicio</a>";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " .$conn->error;
    }
}

$conn -> close();