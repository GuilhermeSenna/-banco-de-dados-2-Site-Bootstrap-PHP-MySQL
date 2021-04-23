<?php include "utils/header.php" ?>

<?php
if (isset($_POST["mensagem"])) {
    echo $_POST["mensagem"];
}
?>

<div class="login-form">    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h4 class="modal-title">Edite a categoria</h4>
        <hr>
        <div class="form-group">
           ID categoria:  <input type="text" class="form-control" placeholder=" Digite o nome da categoria" required="required" name="id">
        </div>
        <div class="form-group">
           Nome categoria:  <input type="text" class="form-control" placeholder=" Digite o nome do produto" required="required" name="nome">
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Alterar">              
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
        $id = $_POST["id"];
        $nome = $_POST["nome"];

        include 'conexao.php';

        $sql = "SELECT ID, nome FROM categoria";
        $results = $conn->query($sql);

        $found_name = False;
        $found_id = False;

        if ($results->num_rows > 0) {
            while($row = $results->fetch_assoc()) {
                if(strtolower($nome) == strtolower($row["nome"])){
                    $found_name = True;
                }
            }
            while($row = $results->fetch_assoc()) {
                if($_POST["id"] == $row["ID"]){
                    $found_id = True;
                }
            }
        }

        $conn->close();

        if ($found_name){
            ?>
            <form action="editar_categorias.php" id="form_categoria" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Já existe uma categoria com esse nome!</h1>">
            </form>

            <script>document.getElementById("form_categoria").submit();</script> <?php
        }elseif($found_id){
            ?>
            <form action="editar_categorias.php" id="form_id" method="post">
                <input type="hidden" name="mensagem" value="<h1 class='text-center' style='color:red'>Não existe um ID com esse valor!</h1>">
            </form>

            <script>document.getElementById("form_id").submit();</script> <?php
        }else{

            include 'conexao.php';

            $sql = "UPDATE categoria SET nome = '$nome' WHERE ID = $id";

            if (!$conn->query($sql) === TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
}
?>

<?php include 'utils/footer.php' ?>