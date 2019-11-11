<?php

/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 15/09/2016
 * Time: 14:59
 */
class Funcoes{
    private $sql;
    const RANDOM_MAIUSCULAS = 1; // 0001
    const RANDOM_MINUSCULAS = 2; // 0010
    const RANDOM_LETRAS = 3; // 0011
    const RANDOM_NUMEROS = 4; // 0100
    const RANDOM_ALFANUM = 7; // 0111
    const RANDOM_SIMBOLOS = 8; // 1000
    const RANDOM_COMPLETO = 15; // 1111


    function __construct($sql){
        $this->sql = $sql;
    }

    public function motoristaDoDia(){
        $dia = Data::semanaHoje();
        if($aux = $this->sql->select("SELECT nomeMot, idDupla FROM `locacao_dupla` lc INNER JOIN `locacao_motorista` ld on lc.idMot = ld.idMot where statusDupla = true and idEscala = '{$dia}'")){
                $r[] = $aux[0]["nomeMot"];
                $r[] = $aux[0]["idDupla"];
                return $r;
        }
    }

/* FUNÇÃO SEM UTILIDADE
    public function pesquisaDia($data = NULL){
        $hoje = date('Y-m-d');
        $data3 = date('Y-m-d', $data);
        return ((!empty($data)) ? "$data3" : "$hoje");
    }
*/

    private function random($tamanho = 10, $simbolos = Funcoes::RANDOM_ALFANUM) {
        if (!$simbolos) {
            trigger_error('Símbolos inválido', E_USER_ERROR);
            return false;
        }
        $str = '';
        if ($simbolos & Funcoes::RANDOM_MAIUSCULAS) {
            $str .=  'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($simbolos & Funcoes::RANDOM_MINUSCULAS) {
            $str .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($simbolos & Funcoes::RANDOM_NUMEROS) {
            $str .= '0123456789';
        }
        if ($simbolos & Funcoes::RANDOM_SIMBOLOS) {
            $str .= '?!@#$%&*()[]{}<>_+-=;:,.';
        }
        $str = str_shuffle($str);
        $ultimo = strlen($str) - 1;

        $saida = '';
        for ($i = abs($tamanho); $i > 0; --$i) {
            $saida .= $str[mt_rand(0, $ultimo)];
        }
        return $saida;
    } // fim function random

    private function textooubranco($tipo, $texto){
        switch ($tipo){
            case "N":
                $r = (!empty($texto)) ? $texto : "<u>                                                                              </u>";
                break;
            case "M":
                $r = (!empty($texto)) ? $texto : "<u>                    </u>";
                break;
            case "D":
                $r = (!empty($texto)) ? $texto : "<u>      /      /        </u>" ;
                break;
            case "F":
                $r = (!empty($texto)) ? $texto : "<u>      </u>" ;
                break;
        }
        return $r;
    } // fim função textooubranco

    private function obsFerias($tipo, $valor){
        switch ($tipo){
            case "R":
                $r = ($valor) ? "<br>Receber apenas 1/3" : "";
                break;
            case "P":
                $r = ($valor) ? "<br>Primeiro ou único período de férias" : "";
                break;
            case "S":
                $r = ($valor) ? "<br>Saldo de férias" : "";
                break;
        }
        return $r;
    }

    private function gerarlista($mes,$exce) {
        $mesatual = $mes;

        $excecao = Array();
        for($x=0;$x<count($exce);$x++){
            $excecao[] = new DateTime($mesatual."-".$exce[$x]);
        }

        // Transforma em datetime
        $data['inicio'] = new Datetime($mesatual);
        $data['fim'] = new Datetime($mesatual);

        // Adiciona um dia, porque o array do foreach começa de 0
        $data['fim']->modify('1 month');

        // Intervalo de 1 dia
        $interval = new DateInterval("P1D");

        // Crio um array com as datas do periodo definido
        $periodoVigente = new DatePeriod($data['inicio'], $interval, $data['fim']);

        $html = '';
        // Agora, percorro o array, pegando apenas datas
        foreach ($periodoVigente as $dataPeriodo) {
            // Se não for final de semana (php >= 5.1)
            if (!(date('N', strtotime($dataPeriodo->format('Y-m-d'))) >= 6) && !(in_array($dataPeriodo, $excecao))) {
                $html .= "<tr><td>{$dataPeriodo->format('d')}</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>\n";
            } else {
                $html .= "<tr class=\"folga\"><td >{$dataPeriodo->format('d')}</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>\n";
            }
        }

        return $html;
    }//fim função gerarlista

    public function salvarFormulario($modelo, $conteudo){
        $mes = Array("janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro" );
        $data = "Gravataí, ". date("d"). " de " . $mes[date("m")-1] . " de " . date("Y");
        switch ($modelo) {
            case "folga":
                $html = '<table>';
                $html .= '<tr><td colspan="7" class="titulo">REQUERIMENTO DE FOLGA</td></tr>';
                $html .= '<tr><td colspan="7" class="corpo"><p>Eu, <b>'.$this->textooubranco("N", $conteudo["nome"]).'</b>, matrícula <b>'.$this->textooubranco("M", $conteudo["matricula"]).'</b>, solicito <b>'.$this->textooubranco("F", $conteudo["qtddias"]).'</b> dia(s) de folga, na(s) data(s) <b>'.$this->textooubranco("N", $conteudo["datas"]).'</b>, ocasionando o lançamento de tal saldo em banco de horas.</p></td></tr>';
                $html .= '<tr><td colspan="7" class="data">'.$data.'</td></tr>';
                $html .= '<tr><td></td><td class="assinatura" colspan="2">Assinatura do funcionário</td><td></td><td class="assinatura" colspan="2">Assinatura da chefia</td><td></td></tr>';
                $html .= '<tr><td colspan="6" class="rodape" style="width:90%;">A situação do banco de horas deverá ser verificada, previamente, com o Departamento de Pessoal, que aporá o seu saldo no quadro ao lado, para a ciência da chefia imediata.</td><td style="border:1px solid black;width:10%;"></td></tr>';
                $html .= '</table>';
                $cod = "A";
                break;

            case "ferias":
                $html = '<table>';
                $html .= '<tr><td colspan="7" class="titulo">REQUERIMENTO DE FÉRIAS</td></tr>';
                $html .= '<tr><td colspan="7" class="corpo"><p>Eu, <b>'.$this->textooubranco("N", $conteudo["nome"]).'</b>, matrícula <b>'.$this->textooubranco("M", $conteudo["matricula"]).'</b>, solicito <b>'.$this->textooubranco("F", $conteudo["qtddias"]).'</b> dia(s) de gozo, iniciando dia <b>'.$this->textooubranco("D", $conteudo["iniciogozo"]).'</b> e encerrando dia <b>'.$this->textooubranco("D", $conteudo["fimgozo"]).'</b>, relativo ao período aquisitivo que começa <b>'.$this->textooubranco("D", $conteudo["inicioaquisitivo"]).'</b> e termina <b>'.$this->textooubranco("D", $conteudo["fimaquisitivo"]).'</b>.</p>';
                $html .= '<p>&nbsp;</p><p>Observações:</p>'.$this->obsFerias("R", @$conteudo["cbum"]) . $this->obsFerias("P", @$conteudo["cbdois"]) . $this->obsFerias("S", @$conteudo["cbtres"]) . '</td></tr>';
                $html .= '<tr><td colspan="7" class="data">'.$data.'</td></tr>';
                $html .= '<tr><td></td><td class="assinatura" colspan="2">Assinatura do funcionário</td><td></td><td class="assinatura" colspan="2">Assinatura da chefia</td><td></td></tr>';
                $html .= '</table>';
                $cod = "A";
                break;

            case "altera_ponto":
                $dias = Array("25","26","27","28","29","30","31","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24");
                $html = '<table>';
                $html .= '<tr><td colspan="7" class="titulo">ALTERAÇÃO DE REGISTRO PONTO</td></tr>';
                $html .= '</table>';
                $html .= '<table class="corpo">';
                $html .= '<tr><td style="width:65%">Nome: '.$conteudo["servidor"].'</td><td style="width:35%">Mês: '.$conteudo["mes"].'</td></tr>';
                $html .= '<tr class="textocentro">';
                $html .= '<td style="width:5%">Dia</td>';
                $html .= '<td style="width:9%">Entrada</td>';
                $html .= '<td style="width:9%">Saída</td>';
                $html .= '<td style="width:9%">Entrada</td>';
                $html .= '<td style="width:9%">Saída</td>';
                $html .= '<td style="width:50%">Motivo</td>';
                $html .= '<td style="width:9%">Rubrica</td>';
                $html .= '</tr>';
                foreach ($dias as $aux) {
                    $html .= "<tr>";
                    $html .= "<td>$aux</td>";
                    $html .= "<td>".@$conteudo[qtd][$aux][0]."</td>";
                    $html .= "<td>".@$conteudo[qtd][$aux][1]."</td>";
                    $html .= "<td>".@$conteudo[qtd][$aux][2]."</td>";
                    $html .= "<td>".@$conteudo[qtd][$aux][3]."</td>";
                    $html .= "<td class=\"esquerda\">".@$conteudo[qtd][$aux][4]."</td>";
                    $html .= "<td>".@$conteudo[qtd][$aux][5]."</td>";
                    $html .= "</tr>";
                } // fim do loop
                $html .= '</table>';
                $html .= '<table>';
                $html .= '<tr><td colspan="7" style="height: 100px;"></td></tr>';
                $html .= '<tr><td></td><td class="assinatura" colspan="2">Assinatura do funcionário</td><td></td><td class="assinatura" colspan="2">Assinatura da chefia</td><td></td></tr>';
                $html .= '</table>';
                $cod = "B";
                break;

            case "ponto_cc":
                $info = explode("*", $conteudo["servidor"]);
                $data = explode("-", $conteudo["mes"]);
                $html = '<table>';
                $html .= '<tr><td class="titulo">FOLHA PONTO</td></tr>';
                $html .= '</table>';
                $html .= '<table class="tbl">';
                $html .= '<tr><th class="nome" colspan="6">Empregado: '.$info[0].' </th><th class="mes">Competência: '.$mes[$data[1]-1].'/'.$data[0].'</th></tr>';
                $html .= '<tr><th colspan="6">Local de trabalho: DEMHAB</th><th>Decreto: '.$info[1].'</th></tr>';
                $html .= '<tr><th colspan="7">Cargo: '.$info[2].'</th></tr>';
                $html .= '</table>';
                $html .= '<br><br>';
                $html .= '<table>';
                $html .= '<tdead>';
                $html .= '<tr class="cabecalho"><td class="data" rowspan="2">Dia</td><td class="turno" colspan="2">Manhã</td><td class="ass" rowspan="2">Assinatura</td><td class="turno" colspan="2">Tarde</td><td class="ass" rowspan="2">Assinatura</td></tr>';
                $html .= '<tr class="cabecalho"><td class="hora">Entrada</td><td class="hora">Saída</td><td class="hora">Entrada</td><td class="hora">Saída</td></tr>';
                $html .= '</thead>';
                $html .= $this->gerarlista($conteudo['mes'],@$conteudo['exce']);
                $html .= '</table>';
                $html .= '<table class="footer">';
                $html .= '<tr><td style="height: 90px;" colspan="7"></td></tr>';
                $html .= '<tr><td></td><td class="assinatura" colspan="2">Assinatura do funcionário</td><td></td><td class="assinatura" colspan="2">Assinatura da chefia</td><td></td></tr>';
                $html .= '</table>';
                $cod = "C";
                break;

        }// fim do switch
        $rand = $cod.$this->random(9, 5);
        $this->sql->insert("INSERT INTO `requerimento_corpo` (`idUnico`, `conteudo`, `dataHora`) VALUES ('{$rand}','". utf8_decode($html)."', NOW())");
        return $rand;
    }

}