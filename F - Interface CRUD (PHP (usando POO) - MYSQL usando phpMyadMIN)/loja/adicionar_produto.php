<?php include "utils/header.php" ?>

<?php
if (isset($_POST["mensagem"])) {
    echo $_POST["mensagem"];
}
?>

<div class="login-form">    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h4 class="modal-title">Adicione o produto</h4>
        <hr>
        <div class="form-group">
           Nome produto:  <input type="text" class="form-control" placeholder=" Digite o nome do produto" required="required" name="nome">
        </div>
        <div class="form-group">
            Categoria: <input type="number" class="form-control" placeholder="Digite a categoria do produto" required="required" name="categoria">
        </div>
        <div class="form-group">
            Estoque: <input type="number" class="form-control" placeholder="Digite a quantidade em estoque" required="required" name="quantidade">
        </div>
        <div class="form-group">
            Valor unitário: <input type="text" class="form-control" placeholder="Digite o valor unitário" required="required" name="valor">
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Cadastrar">              
    </form>			
</div>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID categoria</th>
                    <th scope="col">Nome da categoria</th>
                </tr>
            </thead>
            <tbody>
            <?php include 'conexao.php';

            $sql = "SELECT ID as id, nome as nome
                    FROM categoria
                    ORDER BY id";

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        //echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                        echo '<td>'.$row["id"].'</td>';
                        echo '<td>'.$row["nome"].'</td>';
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"])) {
        $nome = $_POST["nome"];
        $categoria = $_POST["categoria"];
        $quantidade = $_POST["quantidade"];
        $valor = $_POST["valor"];


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
            <form action="adicionar_produto.php" id="form_quantidade" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Digite uma quantidade maior que 0!</h1>">
            </form>

            <script>document.getElementById("form_quantidade").submit();</script> <?php
        } else if($valor < 1){
            ?>
            <form action="adicionar_produto.php" id="form_valor" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Digite um valor maior que 0!</h1>">
            </form>

            <script>document.getElementById("form_valor").submit();</script> <?php
        }else if(!$ha){
            ?>
            <form action="adicionar_produto.php" id="form_categoria" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Digite uma categoria válida!</h1>">
            </form>

            <script>document.getElementById("form_categoria").submit();</script> <?php
        }else{

            include 'conexao.php';

            $sql = "INSERT INTO produto(nome, categoriaID, quantidade, preco) 
                    VALUES ('$nome', $categoria, $quantidade, $valor)";

            if (!$conn->query($sql) === TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
}
?>

<?php include 'utils/footer.php' ?>