<?php

class Consulta_docs
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

        $code = "SELECT * FROM ESTUDANTE WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $estudante = $query->fetch_assoc();

        return $estudante;
    }

    public function estagio($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM ESTAGIO WHERE ESTUDANTE_ID = '$id'";
        $query = $Mysql->query($code);
        $estagio = $query->fetch_assoc();
        
        return $estagio;
    }

    public function concedente($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM CONCEDENTE WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $concedente = $query->fetch_assoc();

        return $concedente;
    }

    public function supervisor($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM SUPERVISOR WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $supervisor = $query->fetch_assoc();

        return $supervisor;
    }

    public function representante($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM REPRESENTANTE T1 INNER JOIN PESSOA T2 ON T1.PESSOA_ID = T2.ID WHERE T1.CONCEDENTE_ID = '$id'";
        $query = $Mysql->query($code);
        $representante = $query->fetch_assoc();

        return $representante;
    }

    public function pessoa($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM PESSOA WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $pessoa = $query->fetch_assoc();

        return $pessoa;
    }

    public function endereco($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM ENDERECO WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $endereco = $query->fetch_assoc();

        return $endereco;
    }

    public function curso($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM CURSO WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $curso = $query->fetch_assoc();

        return $curso;
    }

    public function orientador($id)
    {
        $Mysql = $this->conexao_mysql();

        $code = "SELECT * FROM ORIENTADOR WHERE ID = '$id'";
        $query = $Mysql->query($code);
        $orientador = $query->fetch_assoc();

        return $orientador;
    }
}