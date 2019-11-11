<?php
    $title = "Cadastrar";
    include_once "../_include/header.php";
?>

    <body>

        <!-- Static navbar -->
<?php include "../_include/navbar.php"; ?>

        <div class="container">

<?php if(@$_POST["cadastro"]){
    if ( isset( $_FILES['documento'][ 'name' ] ) && $_FILES['documento'][ 'error' ] == 0 ) {
        //echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'documentos' ][ 'name' ] . '</strong><br />';
        //echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'documentos' ][ 'type' ] . ' </strong ><br />';
        //echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'documentos' ][ 'tmp_name' ] . '</strong><br />';
        //echo 'Seu tamanho é: <strong>' . $_FILES[ 'documentos' ][ 'size' ] . '</strong> Bytes<br /><br />';

        $arquivo_tmp = $_FILES['documento' ]['tmp_name' ];
        $nome = $_FILES['documento' ]['name'];

        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        // Somente imagens, .jpg;.jpeg;.gif;.png
        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        // Isso serve apenas para eu poder pesquisar dentro desta String
        if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
            // Cria um nome único para esta imagem
            // Evita que duplique as imagens no servidor.
            // Evita nomes com acentos, espaços e caracteres não alfanuméricos
            $novoNome =  time ()  . ".".$extensao;

            // Concatena a pasta com o nome
            $destino = '../_documentos/'.$_POST['cadastro'].'/' . $novoNome;

            // tenta mover o arquivo para o destino
            if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                $msg[0] = 0;$msg[1] = 0;
            }
            else
                $msg[0] = "warning"; $msg[1] = 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.';
        }
        else
            $msg[0] = "warning"; $msg[1] = 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"';
    }
    else
        $msg[0] = "warning"; $msg[1] = 'Você não enviou nenhum arquivo!';

    if(@$msg[0]){
        echo "<div class=\"alert alert-$msg[0] alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  $msg[1]
</div>";
    }else{
        $_POST['D'] = $data->PTBRHojeMYSQL($_POST['D']);
        $_POST['E'] = ($_POST['E'] != "") ? "'{$_POST["E"]}'" : "NULL" ;
        if($sql->manipular("INSERT INTO `{$_POST['cadastro']}` VALUES (NULL,'{$_POST['A']}',{$_POST['B']},'{$_POST['C']}', '$novoNome','{$_POST['D']}', NULL,{$_POST['E']}, '1')")){
            echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
    Inserido com sucesso um novo {$_POST['cadastro']}
</div>";

        }else{
            echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
    Não foi possivel inserir
</div>";
        }
    };
};
?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- painel collapse -->
                <div class="panel panel-default"> <!-- painel novo motorista -->
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#motorista" aria-expanded="false" aria-controls="motorista">
                                Cadastrar novo motorista
                            </a>
                        </h4>
                    </div>
                    <div id="motorista" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nome" class="col-sm-2 control-label">Nome: </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nome" name="A" autocomplete="off">
                                    </div>
                                    <label for="cnh" class="col-sm-1 control-label">CNH: </label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cnh" name="B" maxlength="11" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2 control-label">Endereço: </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="endereco" name="C" autocomplete="off">
                                    </div>
                                    <label for="documentos" class="col-sm-2 control-label">Documentos: </label>
                                    <div class="col-sm-4">
                                        <input type="file" id="documentos" name="documento">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dataInicio" class="col-sm-2 control-label">Data Ínicio: </label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control Dpicker" id="dataInicio" name="D" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="obs" class="col-sm-2 control-label">Observação: </label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" id="obs" name="E" autocomplete="off" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="cadastro" value="motorista">Gerar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- /painel novo motorista -->
                <div class="panel panel-default"> <!-- painel novo carro -->
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#carro" aria-expanded="false" aria-controls="carro">
                                Cadastrar novo carro
                            </a>
                        </h4>
                    </div>
                    <div id="carro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="placa" class="col-sm-2 control-label">Placa: </label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="placa" name="A" placeholder="AAA0000" autocomplete="off">
                                    </div>
                                    <label for="renavam" class="col-sm-4 control-label">Renavam: </label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="renavam" name="B" maxlength="11" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="modelo" class="col-sm-2 control-label">Modelo: </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="modelo" name="C" placeholder="Modelo Cor - Ano" autocomplete="off">
                                    </div>
                                    <label for="documentos" class="col-sm-2 control-label">Documentos: </label>
                                    <div class="col-sm-4">
                                        <input type="file" id="documentos" name="documento">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dataInicio" class="col-sm-2 control-label">Data Ínicio: </label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control Dpicker" id="dataInicio" name="D" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="obs" class="col-sm-2 control-label">Observação: </label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" id="obs" name="E" autocomplete="off" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="cadastro" value="carro">Gerar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- /painel novo carro -->
            </div>


        </div> <!-- /container -->


    </body>

<?php
    include_once "../_include/modal.php";
    include_once "../_include/footer.php";
?>