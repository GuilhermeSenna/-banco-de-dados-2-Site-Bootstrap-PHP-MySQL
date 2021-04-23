<?php include "utils/header.php" ?>

<h1 class="text-center p-3" style="background: #4aba70; color: white;">Selecione a ordem de ordenação dos produtos: </h1>

<div class="container">
    <div class="row">
        <div class="card-deck p-3 m-3"  style="width: 60rem;">
            <div class="card">
                <a href="produtos_alfabetica.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/ordem-alfabetica.png" alt="Card image cap" style="color: green;">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Ordem alfabetica</h5>
                </div>
                </a>
            </div>

            <div class="card">
                <a href="produtos_categoria.php" style="color: #999;">
                <img class="card-img-top" src="src/imgs/lista-de-produto.png" alt="Card image cap">
                <hr>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Por categoria</h5>
                </div>
                </a>
            </div>

        </div>
    </div>
</div>

<?php include "utils/footer.php" ?>