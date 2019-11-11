<?php
if(@$title == "Reservar veículo"){
?>
        <!-- Inicio modal ações reserva de carro -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <!-- fim modal ações reserva de carro -->


        <!-- Inicio modal Nova reserva de carro -->
        <div class="modal fade" id="modalNovaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form action="" method="post" class="form-horizontal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Faça uma reserva</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="hora">Hora:</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="hora" name="hora">
                                        <option value="08:30">08:30</option>
                                        <option value="08:45">08:45</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:15">09:15</option>
                                        <option value="09:30">09:30</option>
                                        <option value="09:45">09:45</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:15">10:15</option>
                                        <option value="10:30">10:30</option>
                                        <option value="10:45">10:45</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:15">11:15</option>
                                        <option value="11:30">11:30</option>
                                        <option value="11:45">11:45</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:15">13:15</option>
                                        <option value="13:30">13:30</option>
                                        <option value="13:45">13:45</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:15">14:15</option>
                                        <option value="14:30">14:30</option>
                                        <option value="14:45">14:45</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:15">15:15</option>
                                        <option value="15:30">15:30</option>
                                        <option value="15:45">15:45</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:15">16:15</option>
                                        <option value="16:30">16:30</option>
                                        <option value="16:45">16:45</option>
                                        <option value="17:00">17:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="usuario">Usuário:</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="usuario" name="servidor" required><?php include_once "../_include/rotinas/reserva_carro.php"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="destino">Destino:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="destino" name="destino" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="retorno">Hora de Retorno:</label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="retorno" name="horaretorno">
                                        <option value="00:00">Sem previsão</option>
                                        <option value="08:30">08:30</option>
                                        <option value="08:45">08:45</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:15">09:15</option>
                                        <option value="09:30">09:30</option>
                                        <option value="09:45">09:45</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:15">10:15</option>
                                        <option value="10:30">10:30</option>
                                        <option value="10:45">10:45</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:15">11:15</option>
                                        <option value="11:30">11:30</option>
                                        <option value="11:45">11:45</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:15">13:15</option>
                                        <option value="13:30">13:30</option>
                                        <option value="13:45">13:45</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:15">14:15</option>
                                        <option value="14:30">14:30</option>
                                        <option value="14:45">14:45</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:15">15:15</option>
                                        <option value="15:30">15:30</option>
                                        <option value="15:45">15:45</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:15">16:15</option>
                                        <option value="16:30">16:30</option>
                                        <option value="16:45">16:45</option>
                                        <option value="17:00">17:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="destino">Data:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="data" name="data" maxlength="10" value="<?php echo @$variavelData; ?>" onkeypress="mascaraData( this, event )">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="reservar">Reservar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- fim modal nova reserva carro -->
<?php } ?>
<?php
if(@$title == "Ínicio" && @$pcvalido){
?>
        <!-- Inicio modal AVISO -->
        <div class="modal fade" id="modalNovoAviso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Novo aviso</h4>
                        </div>
                        <div class="modal-body">
                            <label>Aviso: </label><br>
                            <textarea name="texto" required></textarea><br>
                            <label>Data limite:</label><br>
                            <input type="text" name="datalimite" maxlength="10" nada="<?php echo date("d/m/Y", strtotime("+7days")) ?>" onkeypress="mascaraData( this, event )" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="salvarAviso">Salvar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fim modal AVISO -->
<?php } ?>

        <!-- Inicio modal SOBRE -->
        <div class="modal fade" id="modalSobre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Sobre este sistema</h4>
                    </div>
                    <div class="modal-body">
                        <p onclick="window.open('https://192.168.254.1:6081/php/uid.php?vsys=1', '_blank');">Criado por Mikhael Bitelo</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim modal SOBRE -->