<?php

/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 16/08/2016
 * Time: 11:27
 **/

class ConectarBD{
    private $conexao;

    function __construct(){
        $conecta = new mysqli('localhost', 'root', '', 'firmauber');
        if ($conecta->connect_error) {
            die("Conexão falhou: " . $this->conexao->connect_error);
        } else {
            $this->conexao = $conecta;
        }
    }

    public function getConexao(){
        return $this->conexao;
    }

    public function select($consulta){
        $sql = $this->conexao->query($consulta);

        if ($sql->num_rows) {
            return $sql;
        } else {
            return FALSE;
        }
    } // Fecha função select

    public function manipular($consulta){
        $this->conexao->query($consulta);

        if ($this->conexao->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } // Fecha função manipular


    private function desconetar(){
        $this->conexao->close();
    }
}

/******* Como selecionar *******
if($aux = $c1->select("Select * from usuario")){
foreach ($aux as $coluna){
echo $coluna["nome_usuario"];
}
}else{
echo "Nenhum registro";
}
/******* Como deletar *******
if($c1->delete("DELETE FROM usuario WHERE nome_usuario = 'Izadora'")){
echo "Excluido com sucesso";
}else{
echo "Não foi possivel excluir";
}

 */
