<?php include "utils/header.php" ?>

<?php 

include 'conexao.php';
$existe = False;
if (isset($_POST["mensagem"])) {
    echo $_POST["mensagem"];
}

if (isset($_POST["quantidade"])) {
    $quantidade = $_POST["quantidade"];
    $id = $_POST["id"];
    if ($_POST["quantidade"] == 0){
        echo '<h1 class="text-center" style="color: red;">'.$_POST["nome"].' removido do carrinho. </h1>';

        $sql = "DELETE FROM pedido WHERE ID = $id";

        if (!$conn->query($sql) === TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        $sql = "UPDATE pedido
        SET quantidade = $quantidade
        WHERE ID = $id";

        if (!$conn->query($sql) === TRUE) {
            echo '<h2 class="text-center">Erro em: ' . $sql . ',</h2><h2 class="text-center" style="color: red;">' . $conn->error .'</h2>';
        }
    }
}
?>


<?php
    $sql = "SELECT *
    FROM pedido";

    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $existe = True;
    }else{
        ?> 
            <h1 class="text-center">Seu carrinho está vazio</h1>
        <?php
    }

    $conn->close();
?>


<?php 

if($existe){ ?>
<h2><a class="navbar-brand" href="menu_produtos.php">Escolher outros produtos</a></h2>
<div class="container">
<div class="row">
<h3><span style="color: black;">Promoção:</span> <br> - Leve 5 ou mais produtos e ganhe 2% de desconto <br> - Leve 10 produtos ou mais e ganhe 5% de desconto <br> - Leve 15 produtos ou mais e ganhe 15% de desconto  </h3>

</div>
</div>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preco unitário</th>
                    <th scope="col">Quantidade carrinho</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
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

            $totalprods = [];

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        //echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                        echo '<td>'.$row["nomeproduto"].'</td>';
                        echo '<td>'.$row["nomecategoria"].'</td>';
                        echo '<td>R$ '.number_format($row["preco"] , 2, ',', '').'</td>';
                        echo '<td>'.$row["quantidadecarrinho"].' (estoque: '.$row["quantidadeproduto"].')</td>';

                        echo '<form action="carrinho.php" method="post">';
                            echo '<input type="hidden" name="nome" value="'.$row["nomeproduto"].'">';
                            echo '<input type="hidden" name="id" value="'.intval($row["id"]).'">';
                            echo '<input type="hidden" name="quantidade" value="'.intval($row["quantidadecarrinho"] - 1).'">';
                            echo '<td><input type="submit" class="btn btn-danger" value="-"></td>';
                        echo '</form>';

                        echo '<form action="carrinho.php" method="post">';
                            echo '<input type="hidden" name="nome" value="'.$row["nomeproduto"].'">';
                            echo '<input type="hidden" name="id" value="'.intval($row["id"]).'">';
                            echo '<input type="hidden" name="quantidade" value="'.intval($row["quantidadecarrinho"] + 1).'">';
                            echo '<td><input type="submit" class="btn btn-success" value="+"></td>';
                        echo '</form>';


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
    <?php

        include 'conexao.php';

        $sql = "CALL totalbruto(@variavel_temporaria);";
        $sql.= "SELECT @variavel_temporaria as totalbru;";

        if (!$conn->multi_query($sql)) {
            echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
        }
        
        do {
            if ($res = $conn->store_result()) {
                while ($row = $res->fetch_assoc()){
                    $totalbru = $row["totalbru"];
                }
                $res->free();
            }
        } while ($conn->more_results() && $conn->next_result());
        
        $sql = "SELECT SUM(pedido.quantidade) as quantotal FROM PEDIDO;";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            while($row = $results->fetch_assoc()) {
                $totprod = $row["quantotal"];
            }
        }

        if($totprod < 5){
            $desc = 0;
        }else if($totprod >= 5 && $totprod < 10){
            $desc = 2;
        }else if($totprod >= 10 && $totprod < 15){
            $desc = 5;
        }else{
            $desc = 15;
        }

        
        $conn->close();

    ?>
    <div class="row">
        <h5>Quantidade total de produtos: <?php echo $totprod; ?><h5>
    </div>
    <div class="row">
        <h5>Total bruto:</h5><h5  class="font-weight-bold text-dark" >&nbsp R$ <?php echo number_format($totalbru , 2, ',', ''); ?></h5>
    </div>
    <div class="row">
        <h5>Desconto: </h5><h5  class="font-weight-bold text-dark">&nbsp  <?php echo $desc; ?>%</h5>
    </div>
    <div class="row">
        <h5>Total: </h5><h5  class="font-weight-bold text-dark">&nbsp R$ <?php echo number_format($totalbru * ((100-$desc)/100), 2, ',', '');?></h5>
    </div>

    <div class="row">
        <form action="venda.php" method="post">
            <input type="hidden" name="totprod" value="<?php echo $totprod;?>">
            <input type="hidden" name="desconto" value="<?php echo $desc;?>">
            <input type="hidden" name="totalbruto" value="<?php echo number_format($totalbru, 2, ',', '');?>">
            <input type="submit" class="btn btn-success" value="comprar">
        </form>
    </div>
    
</div>


<?php } ?>


<?php include 'utils/footer.php' ?>