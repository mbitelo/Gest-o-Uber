<?php
    $title = "Consultar";
    include_once "../_include/header.php";
?>

    <body>

        <!-- Static navbar -->
<?php include "../_include/navbar.php"; ?>

        <div class="container">


            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label " for="horario">Motorista no horário</label>
                    <div class="col-sm-2">
                        <input type="text" autocomplete="off" class="form-control DTpicker" maxlength="25" id="horario" name="horario" required>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default" name="buscar" value="horario">Buscar</button>
                    </div>
                </div>
            </form>
            <?php
            if(!empty(@$_POST['buscar'] == "horario") && $_POST['horario'] != null ) {
                @$datahora = $data->PTBRHojeMYSQL($_POST['horario']);

                $execute = $sql->select("SELECT nome,placa FROM `turno` t INNER join `motorista` m on t.idMot = m.ID INNER JOIN `carro` c on t.idCarro = c.ID WHERE `inicioTurno` < '$datahora' and `fimTurno` > '$datahora'");
                if($execute){
                    $celula = $execute->fetch_assoc();
                    $num = $execute->num_rows;
                    do{
                        ?>
                        <p>Motorista no dia <?php echo @$_POST['horario']; ?>: <?php echo $celula["nome"]." - ".$celula["placa"] ?></p>
                    <?php }while($celula = $execute->fetch_array());}else{
                    echo "Nenhum resultado encontrado";}
            }
            ?>

            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label " for="idMot">Saldo motorista:</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="idMot" name="idMot" required>
                            <option value="">ESCOLHA</option>
                            <?php include_once "../_include/rotinas/motorista_todos.php"?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default" name="buscar" value="saldoMot">Buscar</button>
                    </div>
                </div>
            </form>
            <?php
            if(!empty(@$_POST['buscar'] == "saldoMot") && $_POST['idMot'] != null ) {
                $m = new Motorista($sql, $_POST['idMot']);
                if ($m->validador) {
                    echo "<p>Motorista: " . $m->getNome() . "</p>";
                    echo "<p>Fifty: " . $m->getfiftyTotal() . " - ";
                    echo "Pago: " . $m->getPagoTotal() . " - ";
                    echo "Saldo: " . $m->getSaldoTotal() . "</p>";
                }
            }
            ?>

            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label " for="idCarro">Saldo carro:</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="idCarro" name="idCarro" required>
                            <option value="">ESCOLHA</option>
                            <?php include_once "../_include/rotinas/carro_todos.php"?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default" name="buscar" value="saldoCarro">Buscar</button>
                    </div>
                </div>
            </form>
            <?php

            if(!empty(@$_POST['buscar'] == "saldoCarro") && $_POST['idCarro'] != null ) {

                $execute = $sql->select("SELECT SUM(pago) as totalPago, SUM(faturamento-taxaUber-combustivel-despesas) as totalDevido, placa FROM `turno` t INNER join `carro` c on t.idCarro = c.ID WHERE idCarro={$_POST['idCarro']}");
                if($execute){
                    $celula = $execute->fetch_assoc();
                    $num = $execute->num_rows;
                    do{
                        ?>
                        <p>Placa: <?php echo $celula["placa"]; ?></p>
                        <p>Fifty: <?php echo number_format($celula["totalDevido"]/2,2, ',', ''); ?></p>
                        <p>Pago: <?php echo number_format($celula["totalPago"],2, ',', ''); ?></p>
                        <p>Saldo: <?php echo number_format($celula["totalPago"]-$celula["totalDevido"]/2,2, ',', ''); ?></p>
                    <?php }while($celula = $execute->fetch_array());}else{
                    echo "Nenhum resultado encontrado";}
            } ?>

            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label " for="listar">Listar Ficha:</label>
                    <div class="col-sm-2">
                        <select id="valor" name="listar" class="form-control">
                            <option value="">ESCOLHA</option>
                            <option value="Carro">Carro</option>
                            <option value="Mot">Motorista</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select id="opcao" name="idBusca" class="form-control">
                            <option value="" class="">ESCOLHA</option>
                            <?php include "../_include/rotinas/carro_todos.php"?>
                            <?php include "../_include/rotinas/motorista_todos.php"?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default" name="buscar" value="listar">Buscar</button>
                    </div>
                </div>
            </form>



            <?php

            if(!empty(@$_POST['buscar'] == "listar") && $_POST['idBusca'] != null ) {?>
            <table class="table table-condensed" style="font-size:12px">
                <thead>
                <tr>
                    <th>Motorista</th>
                    <th>Placa</th>
                    <th>Horário inicial</th>
                    <th>Horário final</th>
                    <th>KM inicial</th>
                    <th>KM final</th>
                    <th>KM Rod</th>
                    <th>Fat.</th>
                    <th>Taxa Uber</th>
                    <th>Comb.</th>
                    <th>Desp</th>
                    <th>Sobra</th>
                    <th>Fifty</th>
                    <th>Pago</th>
                    <th>R$/km</th>
                </tr>
                </thead>
                <tbody>
                <?php

            $execute = $sql->select("SELECT inicioTurno, fimTurno,kmInicial,kmFinal,faturamento,taxaUber,combustivel,despesas,pago,placa,modelo,nome FROM `turno` t INNER join `carro` c on t.idCarro = c.ID INNER JOIN motorista m on m.id = t.idMot WHERE id{$_POST['listar']} = {$_POST['idBusca']} ORDER by inicioTurno");
            if($execute){
                $celula = $execute->fetch_assoc();
                $num = $execute->num_rows;
                do{
                    ?>
                <tr>
                    <td><?php echo $celula["placa"] //. " - " . $celula["modelo"]; ?></td>
                    <td><?php echo $celula["nome"]; ?></td>
                    <td><?php echo $data->MYSQLparaPTBR($celula["inicioTurno"]); ?></td>
                    <td><?php echo $data->MYSQLparaPTBR($celula["fimTurno"]); ?></td>
                    <td><?php echo $celula["kmInicial"]; ?></td>
                    <td><?php echo $celula["kmFinal"]; ?></td>
                    <td><?php echo $celula["kmFinal"]-$celula["kmInicial"]; ?></td>
                    <td><?php echo number_format($celula["faturamento"], 2, ',', ''); ?></td>
                    <td><?php echo number_format($celula["taxaUber"], 2, ',', ''); ?></td>
                    <td><?php echo number_format($celula["combustivel"], 2, ',', ''); ?></td>
                    <td><?php echo number_format($celula["despesas"], 2, ',', ''); ?></td>
                    <td><?php echo number_format($a = $celula["faturamento"]-$celula["taxaUber"]-$celula["combustivel"]-$celula["despesas"],2, ',', ''); ?></td>
                    <td <?php if(($a/2) > 25) echo "class='success'"; else echo "class='danger'"; ?>><?php echo number_format($a/2,2, ',', ''); ?></td>
                    <td><?php echo number_format($celula["pago"],2, ',', ''); ?></td>
                    <td <?php if(($celula["faturamento"]/($celula["kmFinal"]-$celula["kmInicial"])) > 1.1) echo "class='success'"; elseif(($celula["faturamento"]/($celula["kmFinal"]-$celula["kmInicial"])) > 0.9) echo "class='warning'"; else echo "class='danger'"; ?>><?php echo number_format($celula["faturamento"]/($celula["kmFinal"]-$celula["kmInicial"]),2, ',', ''); ?></td>
                </tr>
            <?php }while($celula = $execute->fetch_array());}else{
                echo "<tr><td>Nenhum resultado encontrado</td></tr>";}}
            ?>
                </tbody>
            </table>


        </div> <!-- /container -->


        <script type="text/javascript">
            $('#opcao .Mot').css('display', 'none');
            $('#opcao .Carro').css('display', 'none');
            $('#opcao').css('display', 'block');
            $('#valor option').on('click', function(){
                var value = $( "#valor option:selected").val();
                $('#opcao option').css('display', 'none');
                $('.' + value).css('display', 'block');
                $('#opcao').val($('.' + value).eq(0).val())
            });
            function id( el ){
                return document.getElementById( el );
            }
            function getMoney( el ){
                var money = id( el ).value.replace( ',', '.' );
                return parseFloat( money )*100;
            }
            function soma(){
                var total = getMoney('faturamento')-getMoney('taxa')-getMoney('combustivel')-getMoney('despesas');
                id('sobra').value = (total/100).toFixed(2).replace('.', ',');
                id('racha').value = ((total/100)/2).toFixed(2).replace('.', ',');
            }
        </script>

        </html>
    </body>

<?php
    include_once "../_include/modal.php";
    include_once "../_include/footer.php";
?>