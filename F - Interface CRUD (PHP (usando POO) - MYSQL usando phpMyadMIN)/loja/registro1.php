<?php include "utils/header.php" ?>

<?php
if (isset($_POST["erro"])) {
    echo '<h3 class= "text-center" style="color: red">'.$_POST["erro"].'</h3>';
}
?>

<div class="login-form">    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
        <h4 class="modal-title">Registre-se</h4>
        <hr>
        <p class="text-center">Dados pessoais</p>
        <div class="form-group">
           Nome:  <input type="text" class="form-control" placeholder=" Digite seu nome" required="required" name="nome">
        </div>
        <div class="form-group">
            CPF: <input type="number" class="form-control" placeholder="Digite seu CPF" required="required" name="cpf">
        </div>
        <div class="form-group">
            RG: <input type="number" class="form-control" placeholder="Digite seu RG" required="required" name="rg">
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Avancar">              
    </form>			
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"])) {

        echo $_POST["nome"]; ?> <br> <?php
        echo $_POST["cpf"]; ?> <br> <?php
        echo $_POST["rg"]; ?> <br> <?php

        include 'conexao.php';

        $sql = "SELECT cpf, rg FROM cliente";
        $results = $conn->query($sql);

        $found = False;

        if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {
            if ($_POST["cpf"] == $row["cpf"] || $_POST["rg"] == $row["rg"]){
                $found = True;
                echo 'Já existe um usuário cadastrado com esse CPF/RG no nosso sistema.';

                // <form action="registro1.php">
                //     <input type="submit" class="btn btn-primary btn-block btn-lg" value="Avancar">   
                // </form>
                ?>
                <form action="registro1.php" id="form_erro" method="post">
                    <input type="hidden" name="erro" value="Erro: já existe um usuário cadastrado com esse RG/CPF em nosso sistema!">
                </form>

                <script>document.getElementById("form_erro").submit();</script>
                <?php
            }
        }
    }
    
    $conn->close();

    if (!$found){
        ?>
        <form action="registro2.php" id="form_sucesso" method="post">
            <input type="hidden" name="nome" value="<?php echo $_POST["nome"] ?>">
            <input type="hidden" name="cpf" value="<?php echo $_POST["cpf"] ?>">
            <input type="hidden" name="rg" value="<?php echo $_POST["rg"] ?>">
        </form>

        <script>document.getElementById("form_sucesso").submit();</script>
        <?php
    }

        // header('Location: registro2.php');
    }

}
?>

<?php include 'utils/footer.php' ?>