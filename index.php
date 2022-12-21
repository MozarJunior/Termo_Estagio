<?php 
session_start();
$_SESSION['cadastro'] = null;
$_SESSION['estudante'] = 1;
$_SESSION['pessoa'] = null;
header('location: inicio.php');
include_once('Documento.php');
$pdf = new Documento();

$pdf->lerArquivo();
?>