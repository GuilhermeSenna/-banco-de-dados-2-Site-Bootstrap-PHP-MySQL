<?php include "utils/header.php" ?>

<?php 

include 'conexao.php';

?>


<?php
    $sql = "SELECT * FROM venda";

    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $existe = True;
    }else{
        $existe = False;
        ?> 
            <h1 class="text-center">Não há vendas cadastradas.</h1>
        <?php
    }

    $conn->close();
?>


<?php 

if($existe){ ?>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nº pedido</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Quantidade escolhida</th>
                    <th scope="col">Quantidade em estoque</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preco</th>
                </tr>
            </thead>
            <tbody>
            <?php include 'conexao.php';

            $sql = "SELECT pedido.ID as pedidoid, produto.nome as nomeproduto, pedido.quantidade as quantidadecarrinho, produto.quantidade as quantidadeproduto, categoria.nome as nomecategoria, produto.preco as preco
            FROM pedido
            INNER JOIN produto
            ON pedido.produtoID = produto.ID
            INNER JOIN categoria
            ON produto.categoriaID = categoria.ID";

            $soma = 0;

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        //echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                        echo '<td>'.$row["pedidoid"].'</td>';
                        echo '<td>'.$row["nomeproduto"].'</td>';
                        echo '<td>'.$row["quantidadecarrinho"].'</td>';
                        echo '<td>'.$row["quantidadeproduto"].'</td>';
                        echo '<td>'.$row["nomecategoria"].'</td>';
                        echo '<td>R$ '.number_format($row["preco"] , 2, ',', '').'</td>';
                        //echo '<td id='.$cont.'><a href="#" type="submit">Comprar</a></td>';
                    echo'</tr>'; 
                }
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php } ?>


<?php include 'utils/footer.php' ?>