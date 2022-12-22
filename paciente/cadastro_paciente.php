<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Página de Cadastro</title>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["email"])){
            echo "<script language='javascript' type='text/javascript'>alert('É necessário realizar o login!');window.location.href='../medico/login_medico.php';</script>";
        } else{
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $nome = $_POST["nome"];
                $idade = $_POST["idade"];
                $peso = $_POST["peso"];
                $altura = $_POST["altura"];
                $imc = number_format($peso / ($altura * $altura) * 10000, 2, '.');

                include('../conexao.php');
                $conexao = Connection();

                if($nome == "" || $nome == null){
                    echo "<script language='javascript' type='text/javascript'>alert('O campo nome deve ser preenchido');window.location.href='cadastro_paciente.php';</script>";
                }
                else if($idade == "" || $idade == null){
                    echo "<script language='javascript' type='text/javascript'>alert('O campo idade deve ser preenchido');window.location.href='cadastro_paciente.php';</script>";
                }
                else if($peso == "" || $peso == null){
                    echo "<script language='javascript' type='text/javascript'>alert('O campo peso deve ser preenchido');window.location.href='cadastro_paciente.php';</script>";
                }
                else if($altura == "" || $altura == null){
                    echo "<script language='javascript' type='text/javascript'>alert('O campo altura deve ser preenchido');window.location.href='cadastro_paciente.php';</script>";
                }
                else{
                    if(!is_string($nome)){
                        echo "<script language='javascript' type='text/javascript'>alert('Informe um nome válido!');window.location.href='cadastro_paciente.php';</script>";
                    }
                    else if(!filter_var($idade, FILTER_VALIDATE_INT)){
                        echo "<script language='javascript' type='text/javascript'>alert('Informe uma idade válida!');window.location.href='cadastro_paciente.php';</script>";
                    }
                    else if(!filter_var($peso, FILTER_VALIDATE_FLOAT)){
                        echo "<script language='javascript' type='text/javascript'>alert('Informe um peso válido!');window.location.href='cadastro_paciente.php';</script>";
                    }
                    else if(!filter_var($altura, FILTER_VALIDATE_INT)){
                        echo "<script language='javascript' type='text/javascript'>alert('Informe uma altura válida!');window.location.href='cadastro_paciente.php';</script>";
                    }
                    else{
                        $insert = mysqli_query($conexao, "INSERT INTO pacientes (nome, idade, peso, altura, imc) VALUES ('$nome', $idade, $peso, $altura, $imc)");

                        if($insert){
                            mysqli_close($conexao);
                            echo "<script language='javascript' type='text/javascript'>alert('Paciente cadastrado com sucesso!');window.location.href='pagina_do_paciente.php';</script>";
                        }
                        else{
                            echo "<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar este paciente');window.location.href='cadastro_paciente.php';</script>";
                        }
                    }
                }
            }
        }
    ?>
    <div id="main-container">
        <h1>Cadastro do Paciente</h1>
        <form id="register-form" action="cadastro_paciente.php" method="POST">
            <div class="half-box spacing">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome" data-required data-min-length="3" data-max-length="16" required>
            </div>
            <div class="full-box">
                <label for="idade">Idade</label>
                <input type="number" name="idade" id="idade" placeholder="Digite sua idade" required>
            </div>
            <div class="full-box">
                <label for="peso">Peso</label>
                <input type="number" name="peso" id="peso" placeholder="Digite seu peso" required>
            </div>
            <div class="full-box">
                <label for="altura">Altura (cm)</label>
                <input type="number" name="altura" id="altura" placeholder="Digite sua altura" required>
            </div>
            <div class="full-box">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
    </div>
    <p class="error-validation template"></p>
    <script src="../js/scripts.js"></script>
</body>
</html>