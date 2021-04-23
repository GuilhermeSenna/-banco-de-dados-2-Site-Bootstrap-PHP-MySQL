<?php include "utils/header.php" ?>

<h1 class="text-center p-3" style="background: #4aba70; color: white;">Produtos por ordem alfabética: </h1>

<h1 id="aviso-compra" class="text-center" style="display: none;"> O produto foi adicionado ao carrinho</h1>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preco</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php

            include 'conexao.php';

            $sql = "SELECT produto.id as id, produto.nome as nomeproduto, produto.preco as preco, produto.quantidade as quantidade, categoria.nome as nomecategoria 
            FROM produto 
            INNER JOIN categoria 
            ON produto.categoriaID = categoria.ID
            ORDER BY nomeproduto";

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        echo '<form action="teste_carrinho.php" method="post">';
                            echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                            echo '<td>'.$row["nomeproduto"].'</td>';
                            echo '<td>'.$row["nomecategoria"].'</td>';
                            echo '<td>R$ '.$row["preco"].'</td>';
                            echo '<td>'.$row["quantidade"].'</td>';
                            echo '<td><input type="submit" class="btn btn-primary btn-block btn-lg" value="Comprar"></td>';
                            //echo '<td id='.$cont.'><a href="#" type="submit">Comprar</a></td>';
                        echo '</form>';
                    echo'</tr>'; 
                }
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "utils/footer.php" ?>