<?php
    include 'database\Insercao.php';
    $insert = new Insercao();
    session_start();
    if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['rg']) && isset($_POST['orgao-expedidor']) && isset($_POST['email']) && isset($_POST['telefone'])){
        $estudante_id = $_SESSION['estudante'];
        $nome = $_POST['nome'];
        // $data_nascimento = $_POST['data-nascimento'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $orgao_expedidor = $_POST['orgao-expedidor'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $insert->pessoa($estudante_id, $nome, $cpf, $rg, $orgao_expedidor, $email, $telefone); 
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Coleta de Dados Pessoais</title>
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
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <!-- Rerceber os dois formularios endereço e dados pessois -->
            <form class="form col-md-6 col-sm-8 col-xs-12" action="" method="POST">
                <h1 style="text-align: center;">Coleta de dados</h1>
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="dados01">Nome</label>
                        <input type="text" class="form-control" name="nome" id="dados01" placeholder="Nome" value=""
                            required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dados02">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="dados02" placeholder="CPF" value="" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dadosUsername">RG</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="rg" id="dadosUsername" placeholder="RG"
                                aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dados05">Orgão Expedidor</label>
                        <input type="text" class="form-control" name="orgao-expedidor" id="dados05"
                            placeholder="Orgão Expedidor" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="dados03">Telefone</label>
                        <input type="tel" class="form-control" name="telefone" id="dados03" placeholder="Telefone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dados04">E-mail</label>
                        <input type="email" class="form-control" name="email" id="dados04" placeholder="E-mail" required>
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" value="Enviar">
                <?php 
                    if($_SESSION['cadastro'] != null)
                    {   
                        session_start();
                        $mensagem = $_SESSION['cadastro'];
                        echo $mensagem;
                        $_SESSION['cadastro'] = null;
                    }
                ?>
            </form>
        </div>
        
    </main>
</body>

</html>