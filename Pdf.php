<?php

require __DIR__ . '\vendor\autoload.php';
include 'Documento.php';

use Dompdf\Dompdf;
use Dompdf\Options;

//Variaveis
$d = new Documento();

// instancia de options
$options = new Options();
$options->setChroot(__DIR__.'\Estrutura');

// Instacia de dompdf
$dompdf = new Dompdf($options);

$d->lerArquivo();
// $arquivo_html = file_get_contents('Estrutura\novo.html');

//Indica o arquivo para escrita do pdf
$dompdf->loadHtmlFile(__DIR__.'\Estrutura\novo.html');
// $dompdf->loadHtml($arquivo_html);

$dompdf->setPaper('A4', 'portrait');

// renderiza o arquivo pdf
$dompdf->render();
header('Content-type: application/pdf');

// imprime conteudo do pdf na tela
echo $dompdf->output();
