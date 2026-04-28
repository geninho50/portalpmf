<?php
class Arquivo
{
	protected $abertura;
	protected $gravacao;
	protected $leitura;
	
	function abreArq ($nome_arq, $tipo_abertura)
	{
		$this->abertura = fopen("$nome_arq", "$tipo_abertura");
	}
	
	function gravaArq ($conteudo)
	{
		$this->gravacao = fwrite($this->abertura, $conteudo);
	}
	
	function leArq ()
	{
		$this->leitura = fread($this->abertura, $this->gravacao);
	}
	
	function fechaArq ()
	{	
		fclose ($this->abertura);
	}
	
	function exibeArq ()
	{
		echo "<br> Conteúdo do arquivo: ". $this->leitura;
	}
}
?>
