<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Busca de paciente</title>
</head>
<body>
<div class="container">
    <?php
        session_start();
        if(!isset($_SESSION["email"])){
            echo "<script language='javascript' type='text/javascript'>alert('É necessário realizar o login!');window.location.href='../medico/login_medico.php';</script>";
        } else{
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id = $_POST["id"];
            
                include('../conexao.php');
                $conexao = Connection();

                $resultado_paciente = mysqli_query($conexao, "SELECT * FROM pacientes WHERE id = $id");
                
                if(($resultado_paciente) and ($resultado_paciente->num_rows != 0)){
                    ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>IDADE</th>
                                <th>PESO</th>
                                <th>ALTURA</th>
                                <th>IMC</th>
                            </tr>
                        </thead>
                        <tbody>        
                            <?php
                            while($row_paciente = mysqli_fetch_assoc($resultado_paciente)){
                                ?>
                                <tr>
                                    <th><?php echo $row_paciente['id'];?></th>
                                    <td><?php echo $row_paciente['nome'];?></td>
                                    <td><?php echo $row_paciente['idade']." anos";?></td>
                                    <td><?php echo $row_paciente['peso']." kg";?></td>
                                    <td><?php echo $row_paciente['altura']." cm";?></td>
                                    <td><?php echo $row_paciente['imc']." kg/m²";?></td>
                                </tr>
                                <?php
                            }?>
                        </tbody>
                    </table>
                <?php
                }else{
                    echo "<div class='alert alert-danger' role='alert'>Nenhum paciente encontrado!</div>";
                }
            }
        }?>
    <br><br>
    <div id="main-container">
        <h1><strong>Busca do Paciente</strong></h1>
        <form id="register-form" action="buscar_paciente.php" method="POST">
            <div class="full-box">
                <label for="id">ID</label>
                <input type="number" name="id" id="id" placeholder="Digite o ID do paciente" required>
                <input type="submit" value="Buscar">
            </div>
        </form>
        <div class="full-box">
            <a href="pagina_do_paciente.php"><input type="submit" value="Voltar"></a>
        </div>
    </div>
</div>
</body>
</html>