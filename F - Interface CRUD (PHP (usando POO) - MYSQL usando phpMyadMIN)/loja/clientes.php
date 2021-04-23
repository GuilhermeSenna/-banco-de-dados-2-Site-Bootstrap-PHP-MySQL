<?php include "utils/header.php" ?>

<?php 

include 'conexao.php';

?>


<?php
    $sql = "SELECT * FROM cliente";

    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $existe = True;
    }else{
        ?> 
            <h1 class="text-center">Não há clientes cadastrados.</h1>
        <?php
    }

    $conn->close();
?>


<?php 

if($existe){ ?>

<div class="container">
    <div class="row mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome cliente</th>
                    <th scope="col">RG</th>
                    <th scope="col">CPF</th>
                    <th scope="col">rua</th>
                    <th scope="col">numero</th>
                    <th scope="col">bairro</th>
                </tr>
            </thead>
            <tbody>
            <?php include 'conexao.php';

            $sql = "SELECT cliente.nome as nome, cliente.RG as RG, cliente.CPF as CPF, endereco.rua as rua, endereco.numero as numero, endereco.bairro as bairro
            FROM cliente
            INNER JOIN endereco
            WHERE cliente.enderecoID = endereco.ID;";

            $soma = 0;

            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    echo '<tr>';
                        //echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                        echo '<td>'.$row["nome"].'</td>';
                        echo '<td>'.$row["RG"].'</td>';
                        echo '<td>'.$row["CPF"].'</td>';
                        echo '<td>'.$row["rua"].'</td>';
                        echo '<td>'.$row["numero"].'</td>';
                        echo '<td>'.$row["bairro"].'</td>';
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


<?php } ?>


<?php include 'utils/footer.php' ?>