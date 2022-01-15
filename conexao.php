<?php

//2)

$servidor = "localhost";
$usuario   = "root";
$senha     = "";
$bd        = "bdrevisao";

try{

    $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario,$senha);

}

catch (PDOException $erro){
    echo "Erro: ".$erro->getMessage();
}