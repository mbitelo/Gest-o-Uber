<?php
    $title = "Ínicio";
    include_once "../_include/header.php";
?>

    <body>

        <!-- Static navbar -->
<?php include "../_include/navbar.php"; ?>

        <div class="container">

<?php

if(!empty(@$_POST['lancar'] == "okay")){
    $_POST = str_replace(",", ".", $_POST);

$_POST['inicioTurno'] = $data->PTBRHojeMYSQL($_POST['inicioTurno']);
$_POST['fimTurno'] = $data->PTBRHojeMYSQL($_POST['fimTurno']);


if($sql->manipular("INSERT INTO `turno` VALUES (null,{$_POST['idMot']},{$_POST['idCarro']},'{$_POST['inicioTurno']}','{$_POST['fimTurno']}',{$_POST['kmInicial']},{$_POST['kmFinal']},{$_POST['faturamento']},{$_POST['taxaUber']},{$_POST['combustivel']},{$_POST['despesas']},{$_POST['pago']})")){
echo "Inserido com sucesso";
}else{
echo "Não foi possivel Inserir";
}}

//echo '<pre>'; print_r($_POST); echo '</pre>';
?>

            <form method="post" class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="idMot">Motorista</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="idMot" name="idMot" required>
                            <option value="">ESCOLHA</option>
                            <?php include_once "../_include/rotinas/motorista.php"?>
                        </select>
                    </div>
                    <label class="col-sm-3 control-label" for="idCarro">Carro</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="idCarro" name="idCarro" required>
                            <option value="">ESCOLHA</option>
                            <?php include_once "../_include/rotinas/carro.php"?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label " for="inicioTurno">Hora Inicial</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control DTpicker" maxlength="25" id="inicioTurno" name="inicioTurno">
                    </div>
                    <label class="col-sm-3 control-label" for="fimTurno">Hora Final</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control DTpicker" maxlength="25" id="fimTurno" name="fimTurno">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="kmInicial">KM Inicial</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control" maxlength="6" id="kmInicial" name="kmInicial">
                    </div>
                    <label class="col-sm-3 control-label" for="kmFinal">KM Final</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control" maxlength="6" id="kmFinal" name="kmFinal">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="faturamento">Faturamento</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control valor" maxlength="6" id="faturamento" name="faturamento">
                    </div>

                    <label class="col-sm-3 control-label" for="taxaUber">Taxa Uber</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control valor" maxlength="6" id="taxaUber" name="taxaUber" value="0,00" onkeyup="soma()">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="combustivel">Combustível</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control valor" maxlength="6" id="combustivel" name="combustivel" value="0,00" onkeyup="soma()">
                    </div>
                    <label class="col-sm-3 control-label" for="despesas">Despesas</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control valor" maxlength="6" id="despesas" name="despesas" value="0,00" onkeyup="soma()">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sobra">Sobra</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control valor" maxlength="6" id="sobra" readonly>
                    </div>
                    <label class="col-sm-2 control-label" for="fifty">Fifty</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control valor" maxlength="6" id="fifty" readonly>
                    </div>
                    <label class="col-sm-2 control-label" for="pago">Pago</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control" maxlength="6" id="pago" name="pago" onkeyup="soma()">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-default" name="lancar" value="okay">Lançar</button>
                    </div>
                </div>
            </form>


        </div> <!-- /container -->


        <script type="text/javascript">
            function id( el ){
                return document.getElementById( el );
            }
            function getMoney( el ){
                var money = id( el ).value.replace( ',', '.' );
                return parseFloat( money )*100;
            }
            function soma(){
                var total = getMoney('faturamento')-getMoney('taxaUber')-getMoney('combustivel')-getMoney('despesas');
                id('sobra').value = (total/100).toFixed(2).replace('.', ',');
                id('fifty').value = ((total/100)/2).toFixed(2).replace('.', ',');
            }
        </script>

        </html>
    </body>

<?php
    include_once "../_include/modal.php";
    include_once "../_include/footer.php";
?>