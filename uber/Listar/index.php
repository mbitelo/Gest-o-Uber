<?php
    $title = "Listar";
    include_once "../_include/header.php";
?>

    <body>

    <!-- Static navbar -->
    <?php include "../_include/navbar.php"; ?>

    <div class="container">

        <table class="table lista">
            <caption>Saldo motoristas.</caption>
            <thead>
            <tr>
                <th>Motorista</th>
                <th class="espaco">Fifty</th>
                <th class="espaco">Pago</th>
                <th class="espaco">Saldo</th>
                <th class="espaco">Turnos</th>
                <th class="espaco">Média</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $execute = @$sql->select("SELECT id FROM motorista WHERE id > 1 ORDER by nome");
            if($execute){
                $celula = $execute->fetch_assoc();
                do{
                    $m = new Motorista($sql,$celula['id']);
                    if($m->getNumeroViagens() >= 0){
                    ?>
                    <tr <?php if(!$m->getStatus()) echo "class='active'"; elseif($m->getSaldo() >= 0) echo "class='success'"; else echo "class='danger'";?>>
                        <td><?php echo $m->getNome(); ?></td>
                        <td><?php echo $m->getfifty(); ?></td>
                        <td><?php echo $m->getPago(); ?></td>
                        <td><?php echo $m->getSaldo(); ?></td>
                        <td><?php echo $m->getNumeroViagens(); ?></td>
                        <td><?php echo $m->getMediaViagensFifty(); ?></td>
                    </tr>
            <?php }}while($celula = $execute->fetch_array());}else{
                echo "<tr><td>Nenhum resultado encontrado</td></tr>";}
            ?>
            </tbody>
        </table>

        <table class="table">
            <caption>Saldo carro.</caption>
            <thead>
            <tr>
                <th>Carro</th>
                <th class="espaco">Fifty</th>
                <th class="espaco">Pago</th>
                <th class="espaco">Saldo</th>
                <th class="espaco">Turnos</th>
                <th class="espaco">Média</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $execute = @$sql->select("SELECT id FROM carro WHERE id > 0 ORDER by placa");
            if($execute){
                $celula = $execute->fetch_assoc();
                do{
                    $c = new Carro($sql,$celula['id']);
                    if($c->getNumeroViagens() > 0){
                        ?>
                        <tr <?php if(!$c->getStatus()) echo "class='active'"; elseif($c->getSaldo() >= 0) echo "class='success'"; else echo "class='danger'";?>>
                            <td><?php echo $c->getPlaca(). " - ". $c->getModelo(); ?></td>
                            <td><?php echo $c->getfifty(); ?></td>
                            <td><?php echo $c->getPago(); ?></td>
                            <td><?php echo $c->getSaldo(); ?></td>
                            <td><?php echo $c->getNumeroViagens(); ?></td>
                            <td><?php echo $c->getMediaViagensFifty(); ?></td>
                        </tr>
                    <?php }}while($celula = $execute->fetch_array());}else{
                echo "<tr><td>Nenhum resultado encontrado</td></tr>";}
            ?>
            </tbody>
        </table>
<!--
        <table class="table table-condensed table-hover" style="font-size:12px">
            <caption>Turnos.</caption>
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
                <th>Taxa</th>
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
            $execute = $sql->select("SELECT inicioTurno, fimTurno,kmInicial,kmFinal,faturamento,taxaUber,combustivel,despesas,pago,placa,modelo,nome FROM `turno` t INNER join `carro` c on t.idCarro = c.ID INNER JOIN motorista m on m.id = t.idMot ORDER by inicioTurno");
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
                echo "<tr><td>Nenhum resultado encontrado</td></tr>";}
            ?>
            </tbody>
        </table>
-->
        <table id="tabela" class="table table-condensed table-hover" cellspacing="0" width="100%" style="font-size:12px">
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
            <th>Taxa</th>
            <th>Comb.</th>
            <th>Desp</th>
            <th>Sobra</th>
            <th>Fifty</th>
            <th>Pago</th>
            <th>R$/km</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Motorista</th>
            <th>Placa</th>
            <th>Horário inicial</th>
            <th>Horário final</th>
            <th>KM inicial</th>
            <th>KM final</th>
            <th>KM Rod</th>
            <th>Fat.</th>
            <th>Taxa</th>
            <th>Comb.</th>
            <th>Desp</th>
            <th>Sobra</th>
            <th>Fifty</th>
            <th>Pago</th>
            <th>R$/km</th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        $execute = $sql->select("SELECT inicioTurno, fimTurno,kmInicial,kmFinal,faturamento,taxaUber,combustivel,despesas,pago,placa,modelo,nome FROM `turno` t INNER join `carro` c on t.idCarro = c.ID INNER JOIN motorista m on m.id = t.idMot ORDER by inicioTurno");
        if($execute){
            $celula = $execute->fetch_assoc();
            $num = $execute->num_rows;
            do{
                ?>
                <tr>
                    <td><?php echo $celula["nome"]; ?></td>
                    <td><?php echo $celula["placa"] //. " - " . $celula["modelo"]; ?></td>
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
                    <td <?php if($celula["pago"] > ($a/2)) echo "class='success'"; else echo "class='danger'"; ?>><?php echo number_format($celula["pago"],2, ',', ''); ?></td>
                    <td <?php if(($celula["faturamento"]/($celula["kmFinal"]-$celula["kmInicial"])) > 1.1) echo "class='success'"; elseif(($celula["faturamento"]/($celula["kmFinal"]-$celula["kmInicial"])) > 0.9) echo "class='warning'"; else echo "class='danger'"; ?>><?php echo number_format($celula["faturamento"]/($celula["kmFinal"]-$celula["kmInicial"]),2, ',', ''); ?></td>
                </tr>
            <?php }while($celula = $execute->fetch_array());}else{
            echo "<tr><td>Nenhum resultado encontrado</td></tr>";}
        ?>
        </tbody>
    </table>
    </div>


    </div> <!-- /container -->


    </html>
    </body>




<?php
    include_once "../_include/modal.php";
    include_once "../_include/footer.php";
?>


