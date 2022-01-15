<?php

$idproduto = isset($_GET["idproduto"]) ? $_GET["idproduto"] :null;

$op = isset($_GET["op"]) ? $_GET["op"] :null;

try{
    $servidor = "localhost";
    $usuario   = "root";
    $senha     = "";
    $bd        = "bdrevisao";

    $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario,$senha);

    if($op=="del"){

        $sql = "DELETE FROM tblprodutos WHERE idproduto=:idproduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idproduto", $idproduto);
        $stmt->execute();
        header("Location: listarprodutos.php");

    }

    if($idproduto){

        $sql = "SELECT * FROM tblprodutos WHERE idproduto=:idproduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idproduto", $idproduto);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_OBJ);

    }

    if($_POST){

        if($_POST["idproduto"]){

            $sql = "UPDATE tblprodutos SET produto=:produto, estoque=:estoque, valor=:valor WHERE idproduto=:idproduto";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":produto", $_POST["produto"]);
            $stmt->bindValue(":estoque", $_POST["estoque"]);
            $stmt->bindValue(":valor", $_POST["valor"]);
            $stmt->bindValue(":idproduto", $_POST["idproduto"]);
            $stmt->execute();


        }

        else{

            $sql = "INSERT INTO tblprodutos (produto,estoque,valor) VALUES (:produto,:estoque,:valor)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":produto", $_POST["produto"]);
            $stmt->bindValue(":estoque", $_POST["estoque"]);
            $stmt->bindValue(":valor", $_POST["valor"]);
            $stmt->execute();

        }

        header("Location: listarprodutos.php");

    }

}

catch(PDOException $e){
    echo $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
<?php
include "menunav.php";
?>

<h1>Cadastro de Produtos</h1>

<div class="container">

    <form method="POST">

        Produto <input type="text"   name="produto"   value=" <?php echo isset($produto) ? $produto->produto   :null ?> ">
        Estoque <input type="text"   name="estoque"   value=" <?php echo isset($produto) ? $produto->estoque   :null ?> ">
        Valor   <input type="text"   name="valor"     value=" <?php echo isset($produto) ? $produto->valor     :null ?> ">
                <input type="hidden" name="idproduto" value=" <?php echo isset($produto) ? $produto->idproduto :null ?> ">

                <input type="submit" value="Cadastrar" class="btn btn-warning">
    </form>

</div>





<?php
include "menuinf.php"
?>