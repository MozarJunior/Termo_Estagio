<?php
    include "database\Consulta.php";
    session_start();
    $estudante_id = $_SESSION['estudante'];
    $consulta = new Consulta();
    $estudante = $consulta->estudante($estudante_id);
    $pessoa = $consulta->pessoa($estudante['PESSOA_ID']);
    $endereco = $consulta->endereco($pessoa['ENDERECO_ID']);
    $estagio = $consulta->estagio($estudante_id);
    $supervisor = $consulta->supervisor($estudante['SUPERVISOR_ID']);
    $orientador = $consulta->orientador($estudante['ORIENTADOR_ID']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>SIT - Meus Dados</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">SIT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(Página atual)</span></a>
                    </li>
                    <?php if($estudante['PESSOA_ID'] != null && $estudante['ORIENTADOR_ID'] != null && $estudante['SUPERVISOR_ID'] != null){
                        echo "<li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"#\">Meus Dados</a>
                        </li>";
                        echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"Pdf.php\">Gerar Termo</a>
                    </li>";
                    }?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Dados Pessoais</h5>
                    <div class="card-body">
                        <p class="card-text"><b>Nome: </b><?php echo $pessoa['NOME'];?></p>
                        <p class="card-text"><b>CPF: </b><?php echo $pessoa['CPF'];?></p>
                        <p class="card-text"><b>RG: </b><?php echo $pessoa['RG'];?></p>
                        <p class="card-text"><b>Orgão Expedidor: </b><?php echo $pessoa['ORGAO_EXPEDIDOR'];?></p>
                        <p class="card-text"><b>Telefone: </b><?php echo $pessoa['TELEFONE'];?></p>
                        <p class="card-text"><b>E-Mail: </b><?php echo $pessoa['EMAIL'];?></p>
                    </div>

                    <a href="#" class="btn btn-primary">Atualizar Dados</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Endereço</h5>
                    <div class="card-body">
                        <p class="card-text"><b>Logradouro: </b><?php echo $endereco['LOGRADOURO'];?></p>
                        <p class="card-text"><b>Bairro: </b><?php echo $endereco['BAIRRO'];?></p>
                        <p class="card-text"><b>Número: </b><?php echo $endereco['NUMERO'];?></p>
                        <p class="card-text"><b>CEP: </b><?php echo $endereco['CEP'];?></p>
                        <p class="card-text"><b>Cidade: </b><?php echo $endereco['CIDADE'];?></p>
                        <p class="card-text"><b>Estado/UF: </b><?php echo $endereco['ESTADO'];?></p>
                    </div>
                    <a href="#" class="btn btn-primary">Atualizar Dados</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Estágio</h5>
                    <div class="card-body">
                        <p class="card-text"><b>Data Inicio: </b><?php echo $estagio['DATA_INICIO'];?></p>
                        <p class="card-text"><b>Data Final: </b><?php echo $estagio['DATA_FIM'];?></p>
                        <p class="card-text"><b>Horario de Entrada: </b><?php echo $estagio['HORA_ENTRADA'];?></p>
                        <p class="card-text"><b>Horario de Saida: </b><?php echo $estagio['HORA_SAIDA'];?></p>
                        <p class="card-text"><b>Duração: </b><?php echo $estagio['DURACAO'];?></p>
                        <p class="card-text"><b>Supervisor: </b><?php echo $supervisor['NOME'];?></p>
                        <p class="card-text"><b>Orientador: </b><?php echo $orientador['NOME'];?></p>
                    </div>
                    <a href="#" class="btn btn-primary">Atualizar Dados</a>
                </div>
            </div>
            
        </div>
    </div>
    </main>
</body>
</html>