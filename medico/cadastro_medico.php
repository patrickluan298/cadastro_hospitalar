<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Página de Cadastro</title>
</head>
<body>
    <?php
        session_start();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            include('../conexao.php');
            $conexao = Connection();

            $select = mysqli_query($conexao, "SELECT email FROM medicos WHERE email = '$email'");

            $array = mysqli_fetch_array($select);

            $logarray = $array['email'];

            if($nome == "" || $nome == null){
                echo "<script language='javascript' type='text/javascript'>alert('O campo nome deve ser preenchido');window.location.href='cadastro_medico.php';</script>";
            }
            else if($email == "" || $email == null){
                echo "<script language='javascript' type='text/javascript'>alert('O campo email deve ser preenchido');window.location.href='cadastro_medico.php';</script>";
            }
            else if($senha == "" || $senha == null){
                echo "<script language='javascript' type='text/javascript'>alert('O campo senha deve ser preenchido');window.location.href='cadastro_medico.php';</script>";
            }
            else{
                if(!is_string($nome)){
                    echo "<script language='javascript' type='text/javascript'>alert('Informe um nome válido!');window.location.href='cadastro_medico.php';</script>";
                }
                else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "<script language='javascript' type='text/javascript'>alert('Informe um email válido!');window.location.href='cadastro_medico.php';</script>";
                }
                else if($logarray == $email){
                    echo "<script language='javascript' type='text/javascript'>alert('Este email já existe');window.location.href='cadastro_medico.php';</script>";
                    die();
                }
                else{
                    $insert = mysqli_query($conexao, "INSERT INTO medicos (nome, email, senha) VALUES ('$nome', '$email', '$senha')");

                    if($insert){
                        mysqli_close($conexao);
                        echo "<script language='javascript' type='text/javascript'>alert('Médico cadastrado com sucesso!');window.location.href='login_medico.php';</script>";
                    }
                    else{
                        echo "<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar este médico');window.location.href='cadastro_medico.php';</script>";
                    }
                }
            }
        }
    ?>
    <div id="main-container">
        <h1>Cadastre-se para acessar o sistema</h1>
        <form id="register-form" action="cadastro_medico.php" method="POST">
            <div class="half-box spacing">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome" data-required data-min-length="3" data-max-length="16" required>
            </div>
            <div class="full-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" data-min-length="2" data-email-validate required>
            </div>
            <div class="half-box spacing">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" data-password-validate data-required required>
            </div>
            <div class="half-box">
                <label for="passconfirmation">Confirmação de senha</label>
                <input type="password" name="passconfirmation" id="passwordconfirmation" placeholder="Digite sua senha novamente" data-equal="password" required>
            </div>
            <div>
                <label for="agreement" id="agreement-label">Eu li e aceito os <a href="#">termos de uso</a></label>
                <input type="checkbox" name="agreement" id="agreement" required>
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