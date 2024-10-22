<?php
require_once('../configure/configure.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM stock WHERE id ='$id'";

    $conn -> query($sql);

    $conn -> close();

    header("Location: ../../stock.php");
}