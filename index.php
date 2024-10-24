<?php require_once('./php/configure/configure.php');

$esAdmin = false;
$rol = 2;

if (session_start()) {
    $esAdmin = true;
    $nombre = $_SESSION["Nombre"];
    $rol = $_SESSION["Rol"];
    $sql = "SELECT imagen FROM empleado WHERE nombre ='$nombre'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $Imagen = "<img src='./" . $row["imagen"] . "' alt='Imagen de " . $nombre . "' class='img-fluid' width='100px'>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anselmo's Bakery</title>
    <link rel="icon" href="./images/panIcon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <a class="nav-link active" aria-current="page" href="#"><b>Inicio</b></a>
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
    <?php 
    } else if($rol == 2){
    ?>
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
                        <a class="nav-link active" aria-current="page" href="#"><b>Inicio</b></a>
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
    <?php } ?>
</body>

</html>