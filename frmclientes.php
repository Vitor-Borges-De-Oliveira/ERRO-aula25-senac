<?php

//7 parte 2

$idcliente = isset($_GET["idcliente"]) ? $_GET["idcliente"]:null;

//8 parte 3
$op = isset($_GET["op"]) ? $_GET["op"]:null;

try{
    
    $servidor = "localhost";
    $usuario   = "root";
    $senha     = "";
    $bd        = "bdrevisao";

    $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario,$senha);


    //8 parte 4

    if($op=="del"){

        $sql = "DELETE FROM tblclientes where idcliente=:idcliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->execute();
        header("Location: listarclientes.php");
    }

    if($idcliente){

        $sql = "SELECT * FROM tblclientes WHERE idcliente=:idcliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idcliente", $idcliente);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_OBJ);

    }

    //8 parte 5

    if($_POST){

        if($_POST["idcliente"]){

            $sql = "UPDATE tblclientes SET cliente=:cliente, dtcad=:dtcad, valor=:valor WHERE idcliente=:idcliente";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":cliente", $_POST["cliente"]);
            $stmt->bindValue(":dtcad", $_POST["dtcad"]);
            $stmt->bindValue(":valor", $_POST["valor"]);
            $stmt->bindValue(":idcliente", $_POST["idcliente"]);
            $stmt->execute();

        }

        else{

            $sql = "INSERT INTO tblclientes (cliente,dtcad,valor) VALUES (:cliente,:dtcad,:valor)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":cliente", $_POST["cliente"]);
            $stmt->bindValue(":dtcad", $_POST["dtcad"]);
            $stmt->bindValue(":valor", $_POST["valor"]);
            $stmt->execute();

        }

        header("Location: listarclientes.php");

    }

}

catch(PDOException $e){
    echo $e->getMessage();
}


?>


<!-- 7 -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
include "menunav.php";
?>

<hr>
    
    <!-- 7 parte 1 -->

    <h1>Cadastro de Clientes</h1>
    <br>

        <div class="container">

            <form method="POST">

                <!-- 7 parte 3 -->

                Cliente          <input type="text" name="cliente" value=" <?php echo isset($cliente) ? $cliente->cliente   :null ?> ">
                Data de Cadastro <input type="date" name="dtcad"   value=" <?php echo isset($cliente) ? $cliente->dtcad     :null ?> ">
                Valor            <input type="text" name="valor"   value=" <?php echo isset($cliente) ? $cliente->valor     :null ?> ">
                <input type="hidden" name="idcliente"                       value=" <?php echo isset($cliente) ? $cliente->idcliente :null ?> ">
                <input type="submit" value="Cadastrar" class="btn btn-warning">


            </form>

        </div>

<?php
include "menuinf.php"
?>