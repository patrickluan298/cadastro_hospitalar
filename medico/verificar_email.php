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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];

            include('../conexao.php');
            $conexao = Connection();

            $select = mysqli_query($conexao, "SELECT email FROM medicos WHERE email = '$email'");

            $array = mysqli_fetch_array($select);

            $logarray = $array['email'];

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<script language='javascript' type='text/javascript'>alert('Informe um email válido!');window.location.href='redefinir_senha.php';</script>";
            }
            else if($logarray == $email){
                $_SESSION["email"] = $email;
                mysqli_close($conexao);
                header("Location: redefinir_senha.php");
            }else{
                echo "<script language='javascript' type='text/javascript'>alert('Email não cadastrado!');window.location.href='verificar_email.php';</script>";
            }
        }
    ?>
    <div id="main-container">
        <h1>Redefinição de Senha</h1>
        <form id="register-form" action="verificar_email.php" method="POST">
            <div class="full-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" data-min-length="2" data-email-validate required>
                <input type="submit" value="Buscar">
            </div>
        </form>
    </div>
    <p class="error-validation template"></p>
    <script src="../js/scripts.js"></script>
</body>
</html>