<?php require_once('./php/configure/configure.php');

$esAdmin = false;

if(session_start() && $_SESSION["Rol"] == 1){
    $esAdmin = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anselmo's Bakery</title>
    <link rel="icon" href="🍞" type="image/x-icon"/>
</head>
<body>
    
</body>
</html>