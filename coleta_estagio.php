<?php
    include 'database\Insercao.php';
    $insert = new Insercao();
    session_start();
    $estudante = $_SESSION['estudante'];

    if(isset($_POST['concedente']) && isset($_POST['supervisor']) && isset($_POST['data-inicio']) && isset($_POST['carga-horaria']) && isset($_POST['hora-entrada']) && isset($_POST['hora-saida'])){
        $concedente = $_POST['concedente'];
        $supervisor = $_POST['supervisor'];
        $carga_horaria = $_POST['carga-horaria'];
        $data_inicio = $_POST['data-inicio'];
        $hora_entrada = $_POST['hora-entrada'];
        $hora_saida = $_POST['hora-saida'];

        $insert->estagio($estudante, $concedente, $supervisor, $carga_horaria, $data_inicio, $hora_entrada, $hora_saida);
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
                <?php
                    $conexao = include_once "database\Conexao.php";
                    $Mysql = new Conexao();
                    $Mysqli = $Mysql->conexao();
                    $code_c = "SELECT * FROM concedente";
                    $query_c = $Mysqli->query($code_c);
                    $code_s = "SELECT * FROM concedente t1 INNER JOIN supervisor t2 ON t1.id = t2.concedente_id";
                    $query_s = $Mysqli->query($code_s);
                ?>  
            <form class="form col-md-6 col-sm-8 col-xs-12" action="" method="POST">
                <h1 style="text-align: center;">Coleta de dados do Estágio</h1>
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="dados01">Concedente</label>
                        <select name="concedente" class="form-control" id="">
                            <option value="0" selected>Selecione a Concedente</option>
                            <?php
                                $c = 1;
                                while($concedente = $query_c->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $c;?>"><?php echo $concedente['NOME'];?></option>
                                    
                                    <?php $c++;
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dados01">Supervisor</label>
                        <select name="supervisor" class="form-control" id="">
                            <option value="0" selected>Selecione o supervisor</option>
                            <?php
                                $c = 1;
                                while($supervisor = $query_s->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $c;?>"><?php echo $supervisor['NOME'];?></option>
                                    
                                    <?php $c++;
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dados02">Data de inicio</label>
                        <input type="date" class="form-control" name="data-inicio" id="dados02" placeholder="" value=""
                            required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dadosUsername">Carga Horaria</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="carga-horaria" id="dadosUsername"
                                placeholder="Carga Horaria Total de Estagio" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <label for="dados05">Hora de Entrada</label>
                            <input type="time" class="form-control" name="hora-entrada" id="dados05" placeholder="CEP" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dados03">Hora de Saida</label>
                            <input type="time" class="form-control" name="hora-saida" id="dados03" placeholder="Cidade"
                                required>
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