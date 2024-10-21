<?php
include_once('./configure/configure.php');

//*Zona donde se comprueba que se ha iniciado la sesión correctamente

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Email = $_POST['email'];
    $Password = $_POST['pass'];

    $Pass = md5($Password);

    $sql = "SELECT nombre AS n, idRol AS rol FROM empleado WHERE email='$Email' AND password='$Pass'";

    $result = $conn->query($sql);

    if($result-> num_rows > 0){
        session_start();

        $row = $result ->fetch_assoc();

        $_SESSION["Nombre"] = $row["n"];

        $_SESSION["Rol"] = $row["rol"];

        header("Location: ../index.php");

    } else {
        header("Location: ../login.php");
    }

}