<?php
require_once('./php/configure/configure.php');

if (session_start()) {

    $esAdmin = true;
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


//Generamos un select con un opt para que nuestro querido Anselmo lo vea bien
$sqlPrueba = "SELECT t.id as idTipo, t.nombre AS nomTipo, p.id AS idProd, p.nombre AS nomProd FROM productos AS p INNER JOIN tipos AS t ON p.idTipo = t.id";

$resultPrueba  = $conn->query($sqlPrueba);

$selectPrueba = "<select name='tipo' id='tipo' class='form-select'>";

if($resultPrueba->num_rows > 0){
    while($row = $resultPrueba->fetch_assoc()){
        $array[$row['nomTipo']][] = $row;
    }

    foreach($array as $key=>$value){
        if(is_array($value)){
            $selectPrueba .="<optgroup label='".$key."'>";
            foreach($value as $k=>$v){
                $selectPrueba .="<option value='".$v['idProd']."'>".$v['nomProd']."</option>";
            }
        }
    }
    $selectPrueba .= "</select>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💲Comprando💲</title>
    <link rel="icon" href="./images/panIcon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        
        .bg-btn {
            background-color: #934526;
            color: #fff;
        }

        .bg-btn:hover {
            color: #000;
        }
    </style>

</head>
<body>
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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm" style="width: 400px">
            <div class="card-header text-dark text-center">
                <h4 class="mb-0">💲Comprar Productos💲</h4>
            </div>
            <div class="card-body">
                <form action="./php/insert/insertCompra.php" method="post">

                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto: </label>
                        <?php echo $selectPrueba; ?>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad a comprar</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Introduce la cantidad" required />
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio del producto</label>
                        <input type="number" id="precio" name="precio" step="0.01" class="form-control" placeholder="Introduce el precio" required />
                    </div>

                    <div class="d-grid">

                    </div>
                        <button type="submit" class="btn bg-btn">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
</body>
</html>