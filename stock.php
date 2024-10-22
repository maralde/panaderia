<?php
require_once('./php/configure/configure.php');
$rol = 2;
$anselmo = false;

if (session_start()) {

    $nombre = $_SESSION["Nombre"];
    if($nombre == "Anselmo"){
        $anselmo = true;
    }
    $rol = $_SESSION["Rol"];
    $sql = "SELECT imagen FROM empleado WHERE nombre ='$nombre'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $Imagen = "<img src='./" . $row["imagen"] . "' alt='Imagen de " . $nombre . "' class='img-fluid' width='100px'>";
    }
}
$sql = "SELECT p.id AS id, s.id AS idStock, p.nombre AS nombre, t.nombre as nombreTipo, SUM(s.cantidad) AS cantidad, SUM(s.coste*s.cantidad) AS costeTotal FROM stock AS s INNER JOIN productos AS p ON s.idProd=p.id INNER JOIN tipos AS t ON p.idTipo = t.id GROUP BY s.id, p.id, t.id";

$result = $conn->query($sql);

$tabla = "";

if($result -> num_rows > 0){
    $tabla = "<table class='table table-bordered'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Coste</th>";
            if($anselmo == true){
                $tabla .= "<th>Eliminar</th>";
            }
        $tabla .="</tr>
    </thead>
    <tbody>";
    while($row = $result -> fetch_assoc()){
        $tabla .= "<tr>
        <td>".$row["id"]."</td>
        <td>".$row["nombreTipo"]."</td>
        <td>".$row["nombre"]."</td>
        <td>".$row["cantidad"]."</td>
        <td>".round($row["costeTotal"],2)."</td>";
        if($anselmo == true){
            $tabla .="<td><a href='./php/delete/eliminarStock.php?id=".$row["idStock"]."'>Eliminar Producto</a></td>";
        }
        $tabla .="</tr>";
    }
    $tabla .="</tbody></table>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stock</title>
    <link rel="icon" href="./images/panIcon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php if($rol == 1){?>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <h1 class="mb-0">
                Hola <?php echo $nombre; ?>
            </h1>
            <?php echo $Imagen; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controlls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle-navigation">
                <span class="navbar-toggler-icon navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex justify-content-center align-items-center ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php"><b>Inicio</b></a>
                    </li>
                    <li class="nav-item">
                        <!--Debe llevar a una lista con nuestros productos-->
                        <a class="nav-link" href="./crearProductos.php">Crear Productos</a>
                    </li>
                    <li class="nav-item">
                        <!--Debe llevar a una lista con nuestros productos-->
                        <a class="nav-link" href="./comprarProductos.php">Comprar Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./stock.php">stock</a>
                    </li>
                    <li class="nav-item">
                        <!--Debe llevar a la pagina de iniciar sesión-->
                        <a class="nav-link" href="./php/cerrarSesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php }else{?>
        <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <h1 class="mb-0">
                Hola <?php echo $nombre; ?>
            </h1>
            <?php echo $Imagen; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controlls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle-navigation">
                <span class="navbar-toggler-icon navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex justify-content-center align-items-center ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php"><b>Inicio</b></a>
                    </li>
                    <li class="nav-item">
                        <!--Debe llevar a una lista con nuestros productos-->
                        <a class="nav-link" href="./stock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <!--Debe llevar a la pagina de iniciar sesión-->
                        <a class="nav-link" href="./php/cerrarSesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php }?>
    <div class="container mt-5">
        <?php echo $tabla; ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>