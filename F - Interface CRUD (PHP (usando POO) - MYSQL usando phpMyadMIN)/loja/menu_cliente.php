<?php include "utils/header.php" ?>

<?php

include 'conexao.php';


session_start();

if (isset($_POST["idusuario"])) {
    $_SESSION["newsession"] = $_POST["idusuario"];
}

$id = $_SESSION["newsession"];

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

<nav class="navbar" style="background: #4aba70;">
  <h1 class="navbar-brand p-3" href="#" style="color: white;">Bem vindo, <?php echo $nome; ?></h1>
  <a class="navbar-brand" href="menu_gerente.php" class="text-bold">Entrar como gerente</a>
  <a class="navbar-brand" href="index.php" style="color: red;">Sair</a>
</nav>

<div class="container">
    <div class="row">
        <div class="card-deck mt-3">
            <div class="card">
                <img class="card-img-top" src="src/imgs/editar.png" alt="Card image cap" style="color: green;">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Editar dados</h5>
                </div>
            </div>

            <div class="card">
                <a href="menu_produtos.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/caixa.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Olhar produtos</h5>
                </div>
                </a>
            </div>

            <div class="card">
                <a href="carrinho.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/carrinho-de-compras.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Checar carrinho</h5>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'utils/footer.php' ?>