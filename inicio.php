<?php
include "database\Consulta.php";
session_start();
$consulta = new Consulta();
$estudante = $consulta->estudante($_SESSION['estudante']);
$pessoa = $consulta->pessoa($estudante['PESSOA_ID']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>SIT - Pagina Inicial</title>
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
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(Página atual)</span></a>
                    </li>
                    <?php if($estudante['PESSOA_ID'] != null && $estudante['ORIENTADOR_ID'] != null && $estudante['SUPERVISOR_ID'] != null){
                        echo "<li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"show_dados.php\">Meus Dados</a>
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
        <div>
            <h2 style="text-align: center;">Bem
                Vindo<br><?php if($estudante['PESSOA_ID'] != null){ echo $pessoa['NOME'];}?></h2>
        </div>

        <div style="text-align: center; margin: 20px;">
            <h3>Coleta de dados</h3>
            <div>
                <a href="coleta_dados.php" class="btn btn-primary">Dados Pessoais</a>
                <a href="coleta_endereco.php" class="btn btn-primary">Endereço</a>
                <a href="coleta_academico.php" class="btn btn-primary">Dados Academicos</a>
                <a href="coleta_estagio.php" class="btn btn-primary">Dados do Estágio</a>
            </div>
        </div>
        <div style="text-align: center; margin: 20px;">
            <h3>Meus Dados</h3>
            <div>
                <?php if($estudante['PESSOA_ID'] != null && $estudante['ORIENTADOR_ID'] != null && $estudante['SUPERVISOR_ID'] != null){
                    echo "<a href=\"show_dados.php\" style=\"margin: 5px;\" class=\"btn btn-primary\">Meus Dados</a><br>";
                    echo "<a href=\"Pdf.php\" class=\"btn btn-primary\">Gerar Termo de Estágio</a>";
                }else{
                    echo "Informe os dados para ter acesso";
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>