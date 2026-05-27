<?php
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "tccpsicoweb1";
    $con = new mysqli ($host,$usuario,$senha,$banco,3306);

    if($con->connect_error)
        {
            die ("Erro de conexão: ".$con->connect_error);
        }
        $con->set_charset("utf8");
?>