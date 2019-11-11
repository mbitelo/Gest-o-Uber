<?php
date_default_timezone_set('America/Sao_Paulo');
include_once "class/data.php";
include_once "class/sql.php";
include_once "class/Funcoes.php";
include_once "class/motorista.php";
include_once "class/carro.php";
$data = new Data();
$sql = new ConectarBD();
$funcoes = new Funcoes($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">

        <title>UBER<?php echo (isset($title)) ? " - ".$title : "";?></title>

        <!-- Bootstrap core CSS -->
        <link href="../_include/css/bootstrap.min.css" rel="stylesheet">
        <link href="../_include/css/jquery.datetimepicker.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../_include/css/style.css" rel="stylesheet">


        <script src="../_include/js/jquery.min.js"></script>
        <script src="../_include/js/bootstrap.min.js"></script>
        <script src="../_include/js/jquery.datetimepicker.full.min.js"></script>

    </head>