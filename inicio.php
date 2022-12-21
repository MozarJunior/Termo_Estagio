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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>SIT - Pagina Inicial</title>
</head>

<body>
    <main>
        <div>
            <h2 style="text-align: center;">Bem Vindo<br><?php if($estudante['PESSOA_ID'] != null){ echo $pessoa['NOME'];}?></h2>
        </div>

        <div style="text-align: center;">
            <h3>Coleta de dados</h3>
            <div>
                <a href="coleta_dados.php" class="btn btn-primary">Dados Pessoais</a>
                <a href="coleta_endereco.php" class="btn btn-primary">Endereço</a>
                <a href="coleta_academico.php" class="btn btn-primary">Dados Academicos</a>
                <a href="coleta_estagio.php" class="btn btn-primary">Dados do Estágio</a>
            </div>
        </div>
        <div style="text-align: center;">
            <h3>Meus Dados</h3>
            <div>
                <?php if($estudante['PESSOA_ID'] != null && $estudante['ORIENTADOR_ID'] != null && $estudante['SUPERVISOR_ID'] != null){
                    echo "<a href=\"show_dados.php\" class=\"btn btn-primary\">Meus Dados</a>";
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