<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Página do Paciente</title>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["email"])){
            echo "<script language='javascript' type='text/javascript'>alert('É necessário realizar o login!');window.location.href='../medico/login_medico.php';</script>";
        }
    ?>
    <br><br><br><br><br><br>
    <div id="main-container">
        <div class="half-box spacing">
            <h1>Página do Paciente</h1>
            <a href="cadastro_paciente.php"><input type="submit" value="Cadastrar paciente"></a>
            <a href="buscar_paciente.php"><input type="submit" value="Buscar paciente"></a>
            <a href="listar_pacientes.php"><input type="submit" value="Listar pacientes"></a>
            <a href="../logout.php"><input type="submit" value="Desconectar-se"></a>
        </div>
    </div>
    <p class="error-validation template"></p>
    <script src="../js/scripts.js"></script>
</body>
</html>