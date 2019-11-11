<?php
$sql = new ConectarBD();

$execute = $sql->select("SELECT `ID`, `nome` FROM `motorista` WHERE status = true ORDER BY `nome` ASC");
if($execute) {
    $celula = $execute->fetch_assoc();
    $num = $execute->num_rows;
    do { ?>
        <option value="<?php echo $celula["ID"]; ?>" class="Mot"><?php echo utf8_encode($celula["nome"]); ?></option>
    <?php } while (@$celula = $execute->fetch_array());
}
?>
