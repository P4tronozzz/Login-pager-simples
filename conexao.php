<?php 

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "academia";

$conn = new mysqli ($host , $usuario , $senha , $banco);

if ($conn -> connect_error){
    die ("erro de corecxao" . conn -> connect_error);
}











?>