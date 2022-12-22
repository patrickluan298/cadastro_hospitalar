<?php
    function Connection(){
        $SERVER = "localhost";
        $USERNAME = "root";
        $PASSWORD = "";
        $DBNAME = "ProgramacaoWeb";
        $PORT = 3306;

        $connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DBNAME, $PORT);  // Faz conexão com o banco de dados

        if(mysqli_connect_errno()){     // Retorna um erro caso exista
            echo "Erro ao se conectar com o banco de dados:" . mysqli_connect_error($connection);
            exit();
        }
        return $connection;
    }
?>