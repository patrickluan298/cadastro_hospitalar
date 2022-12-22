<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Página de Login</title>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
            include('../conexao.php');
            $conexao = Connection();

            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $query = mysqli_query($conexao, "SELECT * FROM medicos WHERE email = '$email' AND senha = '$senha'");

            $array = mysqli_fetch_array($query);
            session_start();
            if($array){
                $_SESSION["email"] = $email;
                mysqli_close($conexao);
                header("Location: ../paciente/pagina_do_paciente.php?Login_efetuado_com_sucesso!");
            } else{
                echo "<script language='javascript' type='text/javascript'>alert('Email e/ou senha incorretos');window.location.href='login_medico.php';</script>";
            }
        }
    ?>
    <div id="login-container">
        <h1>Login</h1>
        <form action="login_medico.php" method="POST">
            <div class="full-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="full-box">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <div class="full-box">
                <a href="verificar_email.php" id="forgot-pass">Esqueceu a senha?</a>
                <input type="submit" value="Login" name="Login" id="login">
            </div>
        </form>
        <div id="social-container">
            <p>Ou entre pelas suas redes sociais</p>
            <img src ="../img/google.png" class="ico"/>
            <img src ="../img/Facebook_Logo.png" class="ico"/>
        </div>
        <div id="register-container">
            <p style="font-size: 15px">Ainda não tem uma conta? <a href="cadastro_medico.php">Registre-se</a></p>
        </div>
    </div>
</body>
</html>