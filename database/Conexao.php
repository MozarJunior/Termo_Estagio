<?php
class Conexao
{
    public function conexao()
    {
        $localhost = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "sistema";

        $mysqli = mysqli_connect($localhost, $usuario, $senha, $banco);

        if(!$mysqli){
            die("A conexao Falhou");
        }else{
            echo "";
        }

        return $mysqli;
    }
}
