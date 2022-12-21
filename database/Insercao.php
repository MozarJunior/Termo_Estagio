<?php

class Insercao
{
    private function conexao_mysql()
    {
        $conexao = include_once "Conexao.php";
        $Mysql = new Conexao();

        return $Mysql->conexao();
    }

    public function pessoa($id, $nome, $cpf, $rg, $orgao_expedidor, $email, $telefone)
    {
        $Mysql = $this->conexao_mysql();
        
        $code = "INSERT INTO pessoa(NOME, CPF, RG, ORGAO_EXPEDIDOR, EMAIL, TELEFONE) VALUES ('$nome', '$cpf', '$rg', '$orgao_expedidor', '$email', '$telefone')";
        
        try {
            $query = $Mysql->query($code);
            $code_p = "SELECT MAX(ID) as ID FROM pessoa";
            $query_p = $Mysql->query($code_p);
            $pessoa = $query_p->fetch_assoc();
            $pessoa_id = $pessoa['ID'];
            $code_es = "UPDATE estudante SET PESSOA_ID = '$pessoa_id' WHERE id = $id";
            try {
                $query_es = $Mysql->query($code_es);
                session_start();
                $_SESSION['cadastro'] = "<div class=\"alert alert-success alert-dismissible fade show mt-3\" role=\"alert\">
                " . "O cadastro foi realizado com Sucesso!" . "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"
                aria-label=\"Close\">X</button>
                </div>";
                $_SESSION['pessoa'] = $pessoa['ID'];
                header("location: inicio.php");
            } catch (mysqli_sql_exception $e) {
                session_start();
                $_SESSION['cadastro'] = "<div class=\"alert alert-danger alert-dismissible fade show mt-3\" role=\"alert\">
                " . "Algumas informações digitadas pode já existir no sistema" . "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\">X</button>
                </div>";
                die(header("location: coleta_dados.php"));
            }
            
        } catch(mysqli_sql_exception $e) {
            session_start();
            $_SESSION['cadastro'] = 0;
            die(header("location: coleta_dados.php"));
        }
    }

    public function endereco($id, $rua, $numero, $bairro, $cep, $cidade, $estado)
    {
        $Mysql = $this->conexao_mysql();

        $code = "INSERT INTO endereco(LOGRADOURO, NUMERO, BAIRRO, CEP, CIDADE, ESTADO) VALUES ('$rua', '$numero', '$bairro', '$cep', '$cidade', '$estado')";
        
        try {
            $query = $Mysql->query($code);
            $code_e = "SELECT MAX(ID) as ID FROM endereco";
            $query_e = $Mysql->query($code_e);
            $endereco = $query_e->fetch_assoc();
            $endereco_id = $endereco['ID'];
            $pessoa = "UPDATE pessoa SET ENDERECO_ID = '$endereco_id' WHERE id = $id";
            try {
                $query_pessoa = $Mysql->query($pessoa);
                session_start();
                $_SESSION['cadastro'] = 'Cadastro realizado com sucesso';
                header("location: inicio.php");
            } catch (mysqli_sql_exception $e) {
                session_start();
                $_SESSION['cadastro'] = 'O cadastro não foi realizado';
                die(header("location: coleta_endereco.php"));
            }
        } catch(mysqli_sql_exception $e) {
            session_start();
            $_SESSION['cadastro'] = 'O cadastro não foi realizado';
            die(header("location: coleta_endereco.php"));
        }
    }

    public function academico($id, $curso, $periodo, $orientador)
    {
        $Mysql = $this->conexao_mysql();

        $code = "UPDATE estudante SET CURSO_ID = '$curso', PERIODO_CURSO = '$periodo', ORIENTADOR_ID = '$orientador' WHERE id = '$id'";
        
        try {
            $query = $Mysql->query($code);
            try {
                session_start();
                $_SESSION['cadastro'] = 'Cadastro realizado com sucesso';
                header("location: inicio.php");
            } catch (mysqli_sql_exception $e) {
                session_start();
                $_SESSION['cadastro'] = 'O cadastro não foi realizado';
                die(header("location: coleta_academico.php"));
            }
        } catch(mysqli_sql_exception $e) {
            session_start();
            $_SESSION['cadastro'] = 'O cadastro não foi realizado';
            die(header("location: coleta_academico.php"));
        }
    }


    public function estagio($id, $concedente, $supervisor, $duracao, $data_inicio, $hora_entrada, $hora_saida)
    {
        $Mysql = $this->conexao_mysql();

        $code = "INSERT INTO ESTAGIO(DATA_INICIO, HORA_ENTRADA, HORA_SAIDA, DURACAO, ESTUDANTE_ID, CONCEDENTE_ID) VALUES ('$data_inicio', '$hora_entrada', '$hora_saida', '$duracao', '$id', '$concedente')";
        
        try {
            $query = $Mysql->query($code);

            $code_s = "UPDATE ESTUDANTE SET SUPERVISOR_ID = '$supervisor' WHERE ID = '$id'";
            try {
                $query_s = $Mysql->query($code_s);
                session_start();
                $_SESSION['cadastro'] = 'Cadastro realizado com sucesso';
                header("location: inicio.php");
            } catch (mysqli_sql_exception $e) {
                session_start();
                $_SESSION['cadastro'] = 'O cadastro não foi realizado';
                die(header("location: coleta_estagio.php"));
            }
        } catch(mysqli_sql_exception $e) {
            session_start();
            $_SESSION['cadastro'] = 'O cadastro não foi realizado';
            die(header("location: coleta_estagio.php"));
        }
    }
}