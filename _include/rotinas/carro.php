<?php
$sql = new ConectarBD();

$execute = $sql->select("SELECT `ID`, `placa`,`modelo` FROM `carro` WHERE status = true ORDER BY `placa` ASC");
if($execute) {
    $celula = $execute->fetch_assoc();
    $num = $execute->num_rows;
    do { ?>
        <option value="<?php echo $celula["ID"]; ?>" class="Carro"><?php echo $celula["placa"] . " - " . $celula["modelo"] ?></option>
    <?php } while (@$celula = $execute->fetch_array());
}
?>
