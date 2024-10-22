<?php
require_once('../configure/configure.php');

$todoCorrecto = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $coste = $_POST['precio'];

    $sql = "INSERT INTO stock (idProd, cantidad, coste) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);

    $sqlCoste = "SELECT sum(coste) AS coste FROM stock";
    $resultCoste = $conn->query($sqlCoste);
    
    $sqlMax = "SELECT sum(s.cantidad) AS cant, t.nombre FROM stock AS s INNER JOIN productos AS p ON s.idProd = p.id INNER JOIN tipos as t ON p.idTipo = t.id GROUP BY t.id";
    $resultMax = $conn->query($sqlMax);
    
    if($resultCoste->num_rows > 0){
        $row = $resultCoste->fetch_assoc();
        $costeQueLlevamos = $row["coste"];
        $costeTotal = $coste + $costeQueLlevamos;
        if($costeTotal > 650){
            $todoCorrecto = true;
            echo "<script>alert('Anselmo que ya estamos superando el 65% del presupuestoooooo!!!!');</script>";
        }
        else if($costeTotal > 1000){
            echo "<script>alert('Exceso de presupuesto'); window.location.href='../../comprarProductos.php';</script>";
        } else {
            $todoCorrecto = true;
        }
    }
    
    if($resultMax->num_rows > 0){
        while($row = $resultMax->fetch_assoc()){
            if(strtolower($row['nombre'] === 'pan')){
                $cantidadAnyadir = $row['cant'] + $cantidad;
                if($cantidadAnyadir>20){
                    echo "<script>alert('Exceso de pan'); window.location.href='../../comprarProductos.php';</script>";
                }
            } else if(strtolower($row['nombre'] === 'bollería')){
                $cantidadAnyadir = $row['cant'] + $cantidad;
                if($cantidadAnyadir>10){
                    echo "<script>alert('Exceso de bollería'); window.location.href='../../comprarProductos.php';</script>";
                }
            } else if(strtolower($row['nombre'] === 'pastel')) {
                $cantidadAnyadir = $row['cant'] + $cantidad;
                if($cantidadAnyadir>5){
                    echo "<script>alert('Exceso de pastel'); window.location.href='../../comprarProductos.php';</script>";
                }
            } else {
                $todoCorrecto = true;
            }
        }
    }

    if($todoCorrecto === true){
        if($stmt){
            $stmt -> bind_param("iid", $Producto, $cantidad, $coste);
    
            if($stmt->execute()){
                echo "<h2>Furula</h2></br>";
                echo "<a class='button' href='../../index.php'>Inicio</a>";
            } else {
                echo "no furula: ". $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn -> close();
   