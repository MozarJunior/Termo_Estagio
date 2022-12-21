<?php
    include 'database\Insercao.php';
    $insert = new Insercao();
    session_start();
    if(isset($_POST['rua']) && isset($_POST['numero']) && isset($_POST['bairro']) && isset($_POST['cep']) && isset($_POST['cidade']) && isset($_POST['estado'])){
        $pessoa_id = $_SESSION['pessoa'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $insert->endereco($pessoa_id, $rua, $numero, $bairro, $cep, $cidade, $estado);  
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Coleta de Dados Endereço</title>
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
            <form class="form col-md-6 col-sm-8 col-xs-12" action="" method="POST">
                <h1 style="text-align: center;">Coleta do Endereço</h1>
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="dados01">Logradouro/Rua</label>
                        <input type="text" class="form-control" name="rua" id="dados01" placeholder="Logradouro/Rua"
                            value="" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dados02">Número</label>
                        <input type="text" class="form-control" name="numero" id="dados02" placeholder="Número" value=""
                            required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dadosUsername">Bairro</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="bairro" id="dadosUsername"
                                placeholder="Bairro" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-6 mb-4">
                            <label for="dados05">Cep</label>
                            <input type="text" class="form-control" name="cep" id="dados05" placeholder="CEP" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dados03">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="dados03" placeholder="Cidade"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dados04">Estado</label>
                            <input type="text" class="form-control" name="estado" id="dados04" placeholder="UF" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Enviar</button>
                    <?php
                    if($_SESSION['cadastro'] != null)
                    {
                        echo $_SESSION['cadastro'];
                        $_SESSION['cadastro'] = null;
                    }
                ?>
            </form>
        </div>
        
    </main>
</body>

</html>