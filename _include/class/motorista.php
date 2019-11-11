<?php

/**
 * Created by PhpStorm.
 * User: Mikhael
 * Date: 15/03/2017
 * Time: 12:42
 */

class Motorista{
    private $id, $nome, $sobrenome, $cnh, $endereco, $status, $numeroViagens, $faturamento, $taxaUber, $combustivel, $despesas, $sobra, $fifty, $pago, $saldo, $mediaViagensFifty;
    public $validador = 1;

    public function __construct($sql,$id = null){
        $execute = $sql->select("SELECT m.id,nome,cnh,endereco,documento,dataInicio,dataFim,status, SUM(faturamento) as fat, SUM(taxaUber) as txuber, SUM(combustivel) as comb, SUM(despesas) as desp, SUM(pago) as pago, SUM(faturamento-taxaUber-combustivel-despesas) as sobra, SUM((faturamento-taxaUber-combustivel-despesas)/2) as fifty, count(idMot) as viagens FROM `motorista` m INNER join `turno` t on t.idMot = m.ID WHERE idMot={$id}");
        $celula = $execute->fetch_assoc();
        if($celula['id'] != null){
            //$num = $execute->num_rows;
            $this->setId($id);
            $this->setNome($celula['nome']); //$this->setSobrenome($celula['id']);
            $this->setCnh($celula['cnh']);
            $this->setEndereco($celula['endereco']);
            $this->setStatus($celula['status']);
            $this->setNumeroViagens($celula['viagens']);
            $this->setfaturamento($celula['fat']);
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

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }

    public function getCnh(){
        return $this->cnh;
    }

    public function setCnh($cnh){
        $this->cnh = $cnh;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getNumeroViagens(){
        return $this->numeroViagens;
    }

    public function setNumeroViagens($numeroViagens){
        $this->numeroViagens = $numeroViagens;
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