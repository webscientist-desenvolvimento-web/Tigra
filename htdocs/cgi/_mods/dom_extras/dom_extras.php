<?php
class DomExtras{
	public $frete, $vinhos_personalizados, $embalagens_promocionais;
	
	public function __construct(){
	}
	
	public function busca($id){
		$tabela = "extras";
		$campos = "*";
		$condicao = "";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->frete = $dados['frete'];
		$this->vinhos_personalizados = $dados['vinhos_personalizados'];
                $this->embalagens_promocionais = $dados['embalagens_promocionais'];
	}
	
	public function __destruct(){
	}
}
?>