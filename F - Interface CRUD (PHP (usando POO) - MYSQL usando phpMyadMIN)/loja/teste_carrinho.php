<?php include "utils/header.php" ?>


<?php
if (isset($_POST["id"])) {
    $id = $_POST["id"];

    include 'conexao.php';

    $sql = "SELECT produtoID FROM pedido WHERE ProdutoID=$id";
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        while($row = $results->fetch_assoc()) {

            if ($id == $row["produtoID"]){
                echo 'Esse produto já está incluso';

                $conn->close();
                ?>
                <form action="carrinho.php" id="form_envio" method="post">
                    <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Esse produto já está incluido no carrinho!</h1>">
                </form>

                

                <script>document.getElementById("form_envio").submit();</script>
                <?php

                
            }
        }
    }

    // Adicionar novo

    $sql = "INSERT INTO pedido (produtoID, quantidade)
    VALUES ($id, 1)";

    if (!$conn->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();

    ?>
    <form action="carrinho.php" id="form_envio" method="post">
        <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:green'>Produto adicionado com sucesso</h1>">
    </form>

    <script>document.getElementById("form_envio").submit();</script>
    <?php
}
?>


<?php include "utils/footer.php" ?>