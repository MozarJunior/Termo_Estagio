<?php
    include 'database\Insercao.php';
    include 'database\Consulta.php';
    $insert = new Insercao();
    session_start();
    $estudante = $_SESSION['estudante'];

    if(isset($_POST['curso']) && isset($_POST['periodo']) && isset($_POST['orientador'])){
        $curso = $_POST['curso'];
        $periodo = $_POST['periodo'];
        $orientador = $_POST['orientador'];

        $insert->academico($estudante, $curso, $periodo, $orientador);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>SIT - Dados Academicos</title>
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
                <h1 style="text-align: center;">Coleta de Dados Academicos</h1>
                <?php
                    $conexao = include_once "database\Conexao.php";
                    $Mysql = new Conexao();
                    $Mysqli = $Mysql->conexao();        
                    $code_o = "SELECT * FROM pessoa t1 INNER JOIN orientador t2 ON t1.ID = t2.PESSOA_ID";
                    $query_o = $Mysqli->query($code_o);
                    $code_c = "SELECT * FROM curso";
                    $query_c = $Mysqli->query($code_c);
                ?>
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="dados01">Curso</label>
                        <select name="curso" class="form-control" id="">
                            <option value="0" selected>Selecione o Curso</option>
                            <?php
                                $c = 1;
                                while($nome_curso = $query_c->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $c;?>"><?php echo $nome_curso['NOME'];?></option>
                                    
                                    <?php $c++;
                                }
                            ?>
                        </select>
                        
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="dadosUsername">Orientador</label>
                        <select name="orientador" class="form-control" id="">
                            <option value="0" selected>Selecione o Professor</option>
                            <?php
                                $c = 1;
                                while($nome_orientador = $query_o->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $nome_orientador['ID'];?>"><?php echo $nome_orientador['NOME'];?></option>
                                    
                                    <?php $c++;
                                }
                            ?>
                        </select>
                    </div>
                
                    <div class="col-md-6 mb-4">
                        <label for="dados02">Periodo</label>
                        <input type="text" class="form-control" name="periodo" id="dados01" placeholder="Periodo Do Curso"
                            value="" required>
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