<?php include "utils/header.php" ?>
<?php
if (isset($_POST["erro"])) {
    echo '<h3 class= "text-center" style="color: red">'.$_POST["erro"].'</h3>';
}
?>


    <div class="login-form">    
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
            <h4 class="modal-title">Logue em sua conta</h4>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nome de usuário" required="required" name="nome">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="CPF/RG" required="required" name="senha">
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Logar">              
        </form>			
        <div class="text-center">Não tem uma conta? <a href="/loja/registro1.php">Registre-se</a></div>
    </div>




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"])) {

        include 'conexao.php';

        $sql = "SELECT id, nome, cpf, rg FROM cliente";
        $results = $conn->query($sql);

        $found = False;

        if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            if ($_POST["senha"] == $row["cpf"] || $_POST["senha"] == $row["rg"]){

                ?>
                <!-- <form action="registro1.php" id="form_erro" method="post">
                    <input type="hidden" name="erro" value="Erro: já existe um usuário cadastrado com esse RG/CPF em nosso sistema.">
                </form>

                <script>document.getElementById("form_erro").submit();</script> -->
                

                <?php

                if(strtolower($_POST["nome"]) != strtolower($row["nome"])){
                    ?>
                    <form action="index.php" id="form_erro2" method="post">
                        <input type="hidden" name="erro" value="Erro: o CPF/RG não bate com o nome informado.">
                    </form>

                    <script>document.getElementById("form_erro2").submit();</script>
                    <?php
                }else{
                    ?>
                    <form action="menu_cliente.php" id="form_nome" method="post">
                        <input type="hidden" name="idusuario" value="<?php echo $row["id"]?>">
                    </form>

                    <script>document.getElementById("form_nome").submit();</script> <?php
                }
            }
        }
    }
    
    $conn->close();

    if (!$found){
        ?>

        <form action="index.php" id="form_erro1" method="post">
            <input type="hidden" name="erro" value="Erro: CPF/RG não cadastrado em nosso sistema!">
        </form>

        <script>document.getElementById("form_erro1").submit();</script>

        <?php
    }

        // header('Location: registro2.php');
    }

}
?>

<?php include 'utils/footer.php' ?>