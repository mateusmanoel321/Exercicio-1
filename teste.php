<?php
include("conexao.php");
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Fornecedores</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <h1>Lista de Fornecedores</h1>
    <form action="">
        <input name="busca" placeholder="Digite a Pesquisa: " type="text"> 
        <button type="submit" >Pesquisar</button>
    </form>
    <br>
    <table width="600px" border="1">
        <tr>
            <th>NomeLoja</th>
            <th>Ramo</th>
            <th>CidadeFornecedor</th>
        </tr>
        <?php 
            if(!isset($_GET['busca'])){
               ?> 
            <tr>
                 <td colspan="3">Digite algo para pesquisar</td>
            </tr> 
             <?php
            } else {
                $pesquisa = $mysqli->real_escape_string($_GET['busca']);
                $sql_code = "SELECT * 
                FROM fornecedores 
                WHERE nomeloja LIKE %$pesquisa%' 
                OR ramo LIKE '%$pesquisa%'  
                OR cidadefornecedor LIKE '%$pesquisa%'";
                $sql_query = $mysqli->query($sql_code) or die("Error ao consultar! " .$mysqli->error);

                if ($sql_query->num_rows == 0) {
                    ?>
            <tr>
                    <td colspan="3">Nenhum resultado encontrado</td>
            </tr>
            <?php
            } else {
                while($dados = $sql_query->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $dados['nomeloja'];?></td>
                    <td><?php echo $dados['ramo'];?></td>
                    <td><?php echo $dados['cidadefornecedor'];?></td>
                </tr>
                <?php
                }
            }
        ?>
        <?php
            } ?>
        
    </table>


</body>
</html>