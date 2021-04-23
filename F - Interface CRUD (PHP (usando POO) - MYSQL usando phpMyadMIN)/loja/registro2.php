<?php include "utils/header.php" ?>

<!-- 


<?php $nome = $_POST["nome"]; ?><br>
<?php $cpf = $_POST["cpf"]; ?><br>
<?php $rg = $_POST["rg"]; ?><br> -->

<div class="login-form">    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
        <h4 class="modal-title">Registre-se</h4>
        <hr>
        <p class="text-center">Dados residenciais</p>
        <div class="form-row">
            <div class="form-group col-md-9">
                Rua: <input type="text" class="form-control" placeholder="Digite sua rua" required="required" name="rua">
            </div>
            <div class="form-group col-md-3">
                Nº: <input type="number" class="form-control" placeholder="Nº" required="required" name="n">
            </div>
        </div>
        <div class="form-group">
            Bairro: <input type="text" class="form-control" placeholder="Digite seu bairro" required="required" name="bairro">
        </div>
        <input type="hidden" name="nome" value="<?php echo $nome ?>">
        <input type="hidden" name="cpf" value="<?php echo $cpf ?>">
        <input type="hidden" name="rg" value="<?php echo $rg ?>">
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Avancar">              
    </form>			
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["rua"])) {
        $rua = $_POST["rua"];
        $n = $_POST["n"];
        $bairro = $_POST["bairro"];

        include 'conexao.php';

        $sql = "INSERT INTO endereco(rua, numero, bairro) VALUES ('$rua', '$n', '$bairro')";

        if ($conn->query($sql) === TRUE) {
            
            $last_id = $conn->insert_id;
            
            $sql2 = "INSERT INTO cliente (nome, enderecoID, RG, CPF)
            VALUES ('$nome', '$last_id', '$rg', '$cpf')";

            if (!$conn->query($sql2) === TRUE) {
                
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }else{
                $last_id = $conn->insert_id;
            }


        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        ?>
        <form action="menu_cliente.php" id="form_nome" method="post">
            <input type="hidden" name="idusuario" value="<?php echo $last_id;?>">
        </form>

        <script>document.getElementById("form_nome").submit();</script>

        <?php
    }

}
?>


<?php include 'utils/footer.php' ?>