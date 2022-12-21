<?php

class Consulta
{
    private function conexao_mysql()
    {
        $conexao = include_once("Conexao.php");
        $Mysql = new Conexao();

        return $Mysql->conexao();
    }

    public function estudante($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM estudante WHERE id = '$id'";
        $query = $Mysql->query($code);
        $estudante = $query->fetch_assoc();

        return $estudante;
    }

    public function pessoa($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM pessoa WHERE id = '$id'";
        $query = $Mysql->query($code);
        $pessoa = $query->fetch_assoc();

        return $pessoa;
    }

    public function endereco($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM endereco WHERE id = '$id'";
        $query = $Mysql->query($code);
        $endereco = $query->fetch_assoc();

        return $endereco;
    }

    public function curso()
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM pessoa";
        $query = $Mysql->query();
        $curso = $query->fetch_assoc();

        return $curso;
    }

    public function estagio($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM ESTAGIO WHERE ESTUDANTE_ID = '$id'";
        $query = $Mysql->query($code);
        $estagio = $query->fetch_assoc();
        
        return $estagio;
    }

    public function supervisor($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM SUPERVISOR WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $supervisor = $query->fetch_assoc();

        return $supervisor;
    }

    public function orientador($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM PESSOA t1 INNER JOIN ORIENTADOR t2 ON t1.ID = t2.PESSOA_ID WHERE t2.ID = '$id'";
        $query = $Mysql->query($code);
        $orientador = $query->fetch_assoc();

        return $orientador;
    }
}