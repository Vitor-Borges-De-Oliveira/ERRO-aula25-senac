<!-- 5 -->

<?php
include "conexao.php";
include "menunav.php";
//6

try {

    $sql = "SELECT * FROM tblclientes";
    $qry = $conn->query($sql);
    $clientes = $qry->fetchAll(PDO::FETCH_OBJ);

    echo "<pre>";  
        
        //print_r($clientes);
        //die();

}

catch (PDOException $erro) {
    echo $erro->getMessage();
}


?>

    <!-- 5 parte 1 -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
   
    <h1>Clientes Cadastrados</h1>
    <hr>

    <div class="container">
        <a href="frmclientes.php" class="btn btn-primary">Novo</a>

        <table class="table table-dark">
            <thead>

                <th>idcliente</th>
                <th>cliente</th>
                <th>Data de Cadastro</th>
                <th>Valor</th>
                <th colspan="2">Ações</th>

            </thead>


        <!-- 5 parte 2 -->
            <tbody>
                <?php  foreach ($clientes as $c) { ?>
                <tr>

                    <th> <?php echo $c->idcliente ?> </th>
                    <th> <?php echo $c->cliente ?> </th>
                    <th> <?php echo $c->dtcad ?> </th>
                    <th> <?php echo $c->valor ?> </th>

                    <!-- 8 parte 1 -->

                    <th>
                        <a href="frmcliente.php?idcliente= <?php echo $c->idcliente ?>">

                            <img src="./img/editar.png" alt="">
                    
                        </a>
                    </th>

                    <!-- 8 parte 2 -->

                    <th>
                        <a href="frmcliente.php?op=del&idcliente= <?php echo $c->idcliente ?>">Excluir
                    
                            <img src="./img/excluir.png" alt="">

                        </a>
                    </th>

                </tr>

                <?php } ?>    

            </tbody>
        </table>

    </div>

<?php
include "menuinf.php";
?>