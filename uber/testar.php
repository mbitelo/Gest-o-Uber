<?php
include_once "_include/class/motorista.php";
include_once "_include/class/sql.php";
echo "<pre>";
$sql = new ConectarBD();
?>
<fieldset>
    <?php /*
    $m1 = new Motorista($sql,$_GET['id']);
    if($m1->validador){ ?>
        <tr>
            <td><?php echo $m1->getNome(); ?></td>
            <td><?php echo $m1->getfifty(); ?></td>
            <td><?php echo $m1->getPago(); ?></td>
            <td><?php echo $m1->getSaldo(); ?></td>
        </tr>
    <?php }else{
        echo "Nenhum resultado encontrado";
    } */
    ?>
</fieldset>
<fieldset>
<?php /*
    $execute = @$sql->select("SELECT id FROM motorista");
    if($execute){
        $celula = $execute->fetch_assoc();
        do{
            $m1 = new Motorista($sql, $celula['id']);
                echo "<p>Motorista: ".$m1->getNome()."</p>";
                echo "<p>Fifty: ".$m1->getfifty()." - ";
                echo "Pago: ".$m1->getPago()." - ";
                echo "Saldo: ".$m1->getSaldo()."</p><br>";

        }while($celula = $execute->fetch_assoc());
    }
    else{
    echo "Nenhum resultado encontrado";
    } */
    ?>
</fieldset>

<?php
$execute = $sql->select("SELECT sum(valor) as banco,(SELECT sum(pago) from turno)as pago FROM `banco` ");
if($execute){
    $celula = $execute->fetch_assoc();
    $num = $execute->num_rows;
    do{
        ?>
        <tr>
            <td><?php echo $celula["pago"]; ?></td>
            <td><?php echo $celula["banco"]; ?></td>
            <td><?php echo $celula["banco"]+$celula["pago"]; ?></td>
        </tr>
    <?php }while($celula = $execute->fetch_array());}else{
    echo "<tr><td>Nenhum resultado encontrado</td></tr>";}
?>