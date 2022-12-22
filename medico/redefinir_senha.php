<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Redefinição de Senha</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION["email"])){
            $email = $_SESSION["email"];
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $senha = $_POST["senha"];

            include('../conexao.php');
            $conexao = Connection();

            $query = mysqli_query($conexao, "UPDATE medicos SET senha = '$senha' WHERE email = '$email'");

            if($query){
                mysqli_close($conexao);
                echo "<script language='javascript' type='text/javascript'>alert('Senha atualizada com sucesso!');window.location.href='login_medico.php';</script>";
            }
            else{
                echo "<script language='javascript' type='text/javascript'>alert('Não foi possível redefinir a senha!');window.location.href='redefinir_senha.php';</script>";
            }
        }
    ?>
    <div id="main-container">
        <h1>Digite uma nova senha</h1>
        <form id="register-form" action="redefinir_senha.php" method="POST">
            <div class="half-box spacing">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" data-password-validate data-required required>
            </div>
            <div class="half-box">
                <label for="passconfirmation">Confirmação de senha</label>
                <input type="password" name="passconfirmation" id="passwordconfirmation" placeholder="Digite sua senha novamente" data-equal="password" required>
                <input type="submit" value="Redefinir">
            </div>
        </form>
    </div>
    <p class="error-validation template"></p>
    <script src="../js/scripts.js"></script>
</body>
</html>