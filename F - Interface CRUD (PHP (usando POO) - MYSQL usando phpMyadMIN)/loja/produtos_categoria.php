<?php include "utils/header.php" ?>

<?php

    include 'conexao.php';

    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if (!strpos($url,'?')) {
        $specified = False;
    } else {
        $specified = True;
        $escolha = substr($url, strpos($url, '?')+1);
    }

    if(!$specified){
        ?>
        <h1 class="text-center p-3" style="background: #4aba70; color: white;">Selecione a categoria: </h1>
        <?php
    }else{
        ?>
        <h1 class="text-center p-3" style="background: #4aba70; color: white;">Produtos da categoria <?php echo $escolha; ?>: </h1>
        <?php
    }
?>


<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
    <thead>

        <?php
        if(!$specified){
            ?>
            <tr>
                <th scope="col">Nome categoria</th>
                <th scope="col">Quantidade</th>
            </tr>
            </thead>
                <tbody>
        <?php

            $sql = "SELECT categoria.nome as nome, count(*) as quantidade
            FROM produto
            INNER JOIN categoria
            ON produto.categoriaID = categoria.ID
            GROUP BY categoriaID;";

            $results = $conn->query($sql);

            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {

                    echo '<tr>';
                        echo '<th scope="row"><a href="?'.$row['nome'].'">'.$row["nome"].'</a></th>';
                        echo '<td>'.$row["quantidade"].'</td>';
                    echo'</tr>'; 
                }
            }
        }else{
            ?>
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Preco</th>
                <th scope="col">Quantidade</th>
                <th scope="col"></th>
            </tr>
            </thead>
                <tbody>
        <?php

            $sql = "SELECT produto.id as id, produto.nome as nome, produto.preco as preco, produto.quantidade as quantidade
            FROM produto
            INNER JOIN categoria
            ON produto.categoriaID = categoria.ID
            WHERE categoria.nome = '$escolha'";

            $results = $conn->query($sql);

            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {

                    echo '<tr>';
                    echo '<form action="teste_carrinho.php" method="post">';
                        echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                        echo '<td>'.$row["nome"].'</td>';
                        echo '<td>R$ '.$row["preco"].'</td>';
                        echo '<td>'.$row["quantidade"].'</td>';
                        echo '<td><input type="submit" class="btn btn-primary btn-block btn-lg" value="Comprar"></td>';
                    echo '</form>';
                    echo'</tr>'; 
                }
            }
        
        }
        
        $conn->close();
        ?>
        </tbody>
    </table>
    </div>
</div>

<?php include "utils/footer.php" ?>