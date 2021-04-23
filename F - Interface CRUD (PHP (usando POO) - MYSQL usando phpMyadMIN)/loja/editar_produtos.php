<?php include "utils/header.php" ?>

<?php
if (isset($_POST["mensagem"])) {
    echo $_POST["mensagem"];
    ?>
        <div class="login-form">    
            <form action="editar_produtos.php" method="post">
                <h4 class="modal-title">Escolha o ID</h4>
                <hr>
                <div class="form-group">
                ID produto:  <input type="text" class="form-control" placeholder="ID do produto" required="required" name="idprod" >
                </div>
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Enviar">              
            </form>			
        </div> <?php
    
}else{
    if (isset($_POST["idprod"])) {

        $idprod = $_POST["idprod"];
        echo $idprod;
        include 'conexao.php';
        
        $sql = "SELECT produto.id as produtoid, categoria.id as categoriaid, produto.nome as nomeproduto, produto.preco as preco, produto.quantidade as quantidade
            FROM produto 
            INNER JOIN categoria 
            ON produto.categoriaID = categoria.ID
            WHERE produto.id = $idprod";

        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            while($row = $results->fetch_assoc()) {
                $nome = $row["nomeproduto"];
                $categoria = $row["categoriaid"];
                $preco = $row["preco"];
                $quantidade = $row["quantidade"];
            }
        }

        $conn->close();

        ?>
        <div class="login-form">    
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <h4 class="modal-title">Adicione o produto</h4>
                <hr>
                <div class="form-group">
                Nome produto:  <input type="text" class="form-control" placeholder="ID do produto" required="required" name="nome" value="<?php echo $nome; ?>">
                </div>
                <div class="form-group">
                    Categoria: <input type="number" class="form-control" placeholder="Digite a categoria do produto" required="required" name="categoria" value="<?php echo $categoria; ?>">
                </div>
                <div class="form-group">
                    Estoque: <input type="number" class="form-control" placeholder="Digite a quantidade em estoque" required="required" name="quantidade" value="<?php echo $quantidade; ?>">
                </div>
                <div class="form-group">
                    Valor unitário: <input type="text" class="form-control" placeholder="Digite o valor unitário" required="required" name="valor" value="<?php echo $preco; ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $idprod;?>">
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Alterar">              
            </form>			
        </div>
        <?php

    }else{
        ?>
        <div class="login-form">    
            <form action="editar_produtos.php" method="post">
                <h4 class="modal-title">Escolha o ID</h4>
                <hr>
                <div class="form-group">
                ID produto:  <input type="text" class="form-control" placeholder="ID do produto" required="required" name="idprod" >
                </div>
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Enviar">              
            </form>			
        </div> <?php
    }
}
?>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preco</th>
                    <th scope="col">Quantidade</th>
                </tr>
            </thead>
            <tbody>
            <?php

            include 'conexao.php';

            $sql = "SELECT produto.id as id, produto.nome as nomeproduto, produto.preco as preco, produto.quantidade as quantidade, categoria.nome as nomecategoria 
            FROM produto 
            INNER JOIN categoria 
            ON produto.categoriaID = categoria.ID
            ORDER BY id";

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        echo '<td>'.$row["id"].'</td>';
                        echo '<td>'.$row["nomeproduto"].'</td>';
                        echo '<td>'.$row["nomecategoria"].'</td>';
                        echo '<td>R$ '.$row["preco"].'</td>';
                        echo '<td>'.$row["quantidade"].'</td>';
                    echo'</tr>'; 
                }
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $categoria = $_POST["categoria"];
        $quantidade = $_POST["quantidade"];
        $valor = $_POST["valor"];

        echo $categoria;

        include 'conexao.php';

        $sql = "SELECT * FROM CATEGORIA
                WHERE ID = $categoria";

        $results = $conn->query($sql);
        
        if ($results->num_rows > 0) {
            $ha = True;
        }else{
           $ha = false;
        }

        $conn->close();

        if ($quantidade < 1){
            ?>
            <form action="editar_produtos.php" id="form_quantidade" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Digite uma quantidade maior que 0!</h1>">
            </form>

            <script>document.getElementById("form_quantidade").submit();</script> <?php
        } else if($valor < 1){
            ?>
            <form action="editar_produtos.php" id="form_valor" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Digite um valor maior que 0!</h1>">
            </form>

            <script>document.getElementById("form_valor").submit();</script> <?php
        }else if(!$ha){
            ?>
            <form action="editar_produtos.php" id="form_categoria" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Digite uma categoria existente!</h1>">
            </form>

            <script>document.getElementById("form_categoria").submit();</script> <?php
        }else{

            include 'conexao.php';

            $sql = "UPDATE produto
            SET nome = '$nome', categoriaID = $categoria, quantidade = $quantidade, preco = '$valor'
            WHERE ID = $id";

            if (!$conn->query($sql) === TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }

    }
}
?>

<?php include 'utils/footer.php' ?>