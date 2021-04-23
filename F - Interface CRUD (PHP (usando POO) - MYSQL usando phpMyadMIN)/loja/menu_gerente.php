<?php include "utils/header.php" ?>

<nav class="navbar" style="background: #4aba70;">
  <h1 class="navbar-brand p-3" href="#" style="color: white;">Bem vindo, Gerente </h1>
  <a class="navbar-brand" href="menu_cliente.php" class="text-bold">Entrar como cliente</a>
  <a class="navbar-brand" href="index.php" style="color: red;">Sair</a>
</nav>

<div class="container">
    <div class="row">
        <div class="card-deck mt-3">
            <div class="card">
                <a href="adicionar_produto.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/adicionar-produto.png" alt="Card image cap" style="color: green;">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Adicionar produto</h5>
                </div>
                </a>
            </div>

            <div class="card">
                <a href="editar_produtos.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/editar-produto.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Editar produtos</h5>
                </div>
                </a>
            </div>

            <div class="card">
                <a href="adicionar_categoria.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/adicionar-categoria.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Adicionar categoria</h5>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-deck mt-3">
            <div class="card">
                <a href="editar_categorias.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/editar-categoria.png" alt="Card image cap" style="color: green;">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Editar categorias</h5>
                </div>
                </a>
            </div>

            <div class="card">
                <a href="clientes.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/clientes.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Lista de clientes</h5>
                </div>
                </a>
            </div>

            <div class="card">
                <a href="vendas.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/grafico.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Histórico de vendas</h5>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>


<?php include 'utils/footer.php' ?>