<?php

/**
 * Created by PhpStorm.
 * User: Mikhael
 * Date: 23/03/2017
 * Time: 13:20
 */

class Carro{
    private $id, $placa, $renavam, $modelo, $documento, $dataInicio, $dataFim, $obs, $status, $faturamento, $taxaUber, $combustivel, $despesas, $sobra, $fifty, $pago, $saldo, $numeroViagens;
    public $validador = 1;

    public function __construct($sql,$id = null){
        $execute = $sql->select("SELECT c.id, placa, renavam, modelo, documento, dataInicio, dataFim, obs, status, SUM(faturamento) as fat, SUM(taxaUber) as txuber, SUM(combustivel) as comb, SUM(despesas) as desp, SUM(faturamento-taxaUber-combustivel-despesas) as sobra, SUM((faturamento-taxaUber-combustivel-despesas)/2) as fifty, SUM(pago) as pago, count(idMot) as viagens FROM `carro` c INNER join `turno` t on t.idCarro = c.ID WHERE idCarro={$id}");
        $celula = $execute->fetch_assoc();
        if($celula['id'] != null){
            //$num = $execute->num_rows;
            $this->setId($id);
            $this->setPlaca($celula['placa']);
            $this->setRenavam($celula['renavam']);
            $this->setModelo($celula['modelo']);
            $this->setStatus($celula['status']);
            $this->setNumeroViagens($celula['viagens']);
            $this->setFaturamento($celula['fat']);
            $this->setTaxaUber($celula['txuber']);
            $this->setCombustivel($celula['comb']);
            $this->setDespesas($celula['desp']);
            $this->setSobra($celula['sobra']);
            $this->setFifty($celula['fifty']);
            $this->setPago($celula['pago']);
            @$this->setMediaViagensFifty($celula['fifty']/$celula['viagens']);
            $this->setSaldo($celula['pago']-$celula['fifty']);
        }else{
            $this->validador = 0;
        }
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPlaca(){
        return $this->placa;
    }

    public function setPlaca($placa){
        $this->placa = $placa;
    }

    public function getRenavam(){
        return $this->renavam;
    }

    public function setRenavam($renavam){
        $this->renavam = $renavam;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function setModelo($modelo){
        $this->modelo = $modelo;
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }

    public function getDataInicio(){
        return $this->dataInicio;
    }

    public function setDataInicio($dataInicio){
        $this->dataInicio = $dataInicio;
    }

    public function getDataFim(){
        return $this->dataFim;
    }

    public function setDataFim($dataFim){
        $this->dataFim = $dataFim;
    }

    public function getObs(){
        return $this->obs;
    }

    public function setObs($obs){
        $this->obs = $obs;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getFaturamento(){
        return number_format($this->faturamento,2, ',', '');
    }

    public function setFaturamento($faturamento){
        $this->faturamento = $faturamento;
    }

    public function getTaxaUber(){
        return number_format($this->taxaUber,2, ',', '');
    }

    public function setTaxaUber($taxaUber){
        $this->taxaUber = $taxaUber;
    }

    public function getCombustivel(){
        return number_format($this->combustivel,2, ',', '');
    }

    public function setCombustivel($combustivel){
        $this->combustivel = $combustivel;
    }

    public function getDespesas(){
        return number_format($this->despesas,2, ',', '');
    }

    public function setDespesas($despesas){
        $this->despesas = $despesas;
    }

    public function getSobra(){
        return number_format($this->sobra,2, ',', '');
    }

    public function setSobra($sobra){
        $this->sobra = $sobra;
    }

    public function getFifty(){
        return number_format($this->fifty,2, ',', '');
    }

    public function setFifty($fifty){
        $this->fifty = $fifty;
    }

    public function getPago(){
        return number_format($this->pago,2, ',', '');
    }

    public function setPago($pago){
        $this->pago = $pago;
    }

    public function getSaldo(){
        return number_format($this->saldo,2, ',', '');
    }

    public function setSaldo($saldo){
        $this->saldo = $saldo;
    }

    public function getNumeroViagens(){
        return $this->numeroViagens;
    }

    public function setNumeroViagens($numeroViagens){
        $this->numeroViagens = $numeroViagens;
    }

    public function getMediaViagensFifty(){
        if($this->getNumeroViagens()){
            return number_format($this->mediaViagensFifty,2, ',', '');
        }else{
            return 0;
        }

        //return $this->mediaViagensFifty;
    }

    public function setMediaViagensFifty($mediaViagensFifty){
        $this->mediaViagensFifty = $mediaViagensFifty;
    }
}