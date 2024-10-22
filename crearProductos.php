<?php 
include_once('./php/configure/configure.php');


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

$sql ="SELECT * FROM tipos";
$result = $conn -> query($sql);

$selectTipos = "<select name='tipo' class='form-select'>";
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $selectTipos .= "<option value='".$row['id']. "'>".$row['nombre']."</option>";
    }
}
$selectTipos .= "</select>";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de Productos</title>
    <link rel="icon" href="./images/panIcon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-header text-dark text-center">
                <h4 class="mb-0">🍞Crear Producto🍞</h4>
            </div>
            <div class="card-body">
                <form action="./php/insert/insertProducto.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto</label>
                        <input type="text" class="form-control" placeholder="Introduce el nombre del producto" name="producto" required/>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Producto</label>
                        <?php echo $selectTipos; ?>
                    </div>
                    <div class="mb-3">
                        <label for="archivo" class="form-label">Imagen</label>
                        <input name="archivo" id="archivo" type="file"/>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn bg-btn">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>l