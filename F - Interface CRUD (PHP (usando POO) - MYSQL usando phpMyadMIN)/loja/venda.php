<?php include "utils/header.php" ?>

<?php 
    $totprod = $_POST["totprod"];
    $desc = $_POST["desconto"];
    $totalbru = $_POST["totalbruto"];

    session_start();

    $id = $_SESSION["newsession"];

    include 'conexao.php';
    $date = date('Y-m-d H:i:s');

    $sql = "SELECT pedido.ID as pedidoid, produto.nome as nomeproduto, pedido.quantidade as quantidadecarrinho, produto.quantidade as quantidadeproduto, categoria.nome as nomecategoria, produto.preco as preco, fn_somarProdutoQntdPreco(produto.preco, pedido.quantidade) as precoquantidade
            FROM pedido
            INNER JOIN produto
            ON pedido.produtoID = produto.ID
            INNER JOIN categoria
            ON produto.categoriaID = categoria.ID";

    $results = $conn->query($sql);
    if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            $pedido = $row["pedidoid"];
            $precquant = $row["precoquantidade"];
            $sql2 = "INSERT INTO venda(pedidoID, clienteID, data_venda, desconto_venda, valorBruto_venda)
                     VALUES ('$pedido', '$id', '$date', '$desc', '$precquant')";

            if (!$conn->query($sql2) === TRUE) {
                
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }


        }
    }


?>

<h1 class="text-center" style="color: green">Compra efetuada com sucesso!</h1>

<?php
    $sql = "SELECT nome
    FROM cliente
    WHERE ID = $id;";

    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            $nome = $row["nome"];
        }
    }

    $conn->close();
?>

<h2 class="text-center">Comprador: <?php echo $nome; ?></h2>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preco unitário</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço x Quantidade</th>
                </tr>
            </thead>
            <tbody>
            <?php include 'conexao.php';

            $sql = "SELECT pedido.ID as id, produto.nome as nomeproduto, pedido.quantidade as quantidadecarrinho, produto.quantidade as quantidadeproduto, categoria.nome as nomecategoria, produto.preco as preco, fn_somarProdutoQntdPreco(produto.preco, pedido.quantidade) as precoquantidade
            FROM pedido
            INNER JOIN produto
            ON pedido.produtoID = produto.ID
            INNER JOIN categoria
            ON produto.categoriaID = categoria.ID";

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        //echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                        echo '<td>'.$row["nomeproduto"].'</td>';
                        echo '<td>'.$row["nomecategoria"].'</td>';
                        echo '<td>R$ '.number_format($row["preco"] , 2, ',', '').'</td>';
                        echo '<td>'.$row["quantidadecarrinho"].' (estoque: '.$row["quantidadeproduto"].')</td>';
                        echo '<td>R$ '.number_format($row["precoquantidade"], 2, ',', '').'</td>';
                        //echo '<td id='.$cont.'><a href="#" type="submit">Comprar</a></td>';
                    echo'</tr>'; 
                }
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <h5>Quantidade total de produtos: <?php echo $totprod; ?><h5>
    </div>
    <div class="row">
        <h5>Total bruto:</h5><h5  class="font-weight-bold text-dark" >&nbsp R$ <?php echo $totalbru; ?></h5>
    </div>
    <div class="row">
        <h5>Desconto: </h5><h5  class="font-weight-bold text-dark">&nbsp  <?php echo $desc; ?>%</h5>
    </div>
    <div class="row">
        <h5>Total: </h5><h5  class="font-weight-bold text-dark">&nbsp R$ <?php echo number_format(floatval($totalbru) * ((100-$desc)/100), 2, ',', '');?></h5>
    </div>
    
</div>


<?php include "utils/footer.php" ?>