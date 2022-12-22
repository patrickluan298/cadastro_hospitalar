<?php
    session_start();
    session_destroy();
    header("Location: medico/login_medico.php");
?>