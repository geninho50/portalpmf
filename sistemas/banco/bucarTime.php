<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$modalidade          = $gdb->vargetpost('modalidade');
$genero         	 = $gdb->vargetpost('genero');
$nome     		     = $gdb->vargetpost('nome');
$matricula       	 = $gdb->vargetpost('matricula');
$nascimento          = $gdb->vargetpost('nascimento');
$idEscola 		     = $gdb->vargetpost('idEscola');
$faixaEtaria	     = $gdb->vargetpost('faixaEtaria');
$situacao 	     	 = $gdb->vargetpost('situacao');
$result 			 = 0;	


  if( $situacao !='t' ){	
	if( $faixaEtaria == '11 a 13' ){
	    $anos = "'2005','2006','2007'";		
	}else{
		$anos = "'2002','2003','2004'";
	}
	
	$gdb->open("select a.nome,
					   a.matricula,					   
					   a.nascimento,
					   e.genero,
					   e.faixaEtaria,
					   e.modalidade
				 from aluno a,
				 	  preEquipe e,
				 	  preEquipeAluno p 

				 where
				   	  e.idEscola = '$idEscola'
				AND   p.idAluno = a.idAluno 
				AND e.idpreEquipe = p.idpreEquipe
				ORDER BY e.modalidade");
    
	if( $gdb->linhas>0 ){
		$gdb->titulo_campo = "Nome,Matricula,Idade,Sexo,Faixa Et&aacute;ria,Modalidade";
		$gdb->formato_campo = ",,,,";
		$gdb->visivel_campo = "v,v,v,v,v";
		$gdb->alinha_campo = "e,e,c,c,c";				
		$gdb->print_tabela("Rela&ccedil;&atilde;o dos Atletas do(a) ".$gdb->gs['MODALIDADE'][0], 1, 1, "");
	}else{
		print "<h1>N&atilde;o tem nenhum atleta inscrito na modalidade  ".$modalidade." dessa Unidade Escolar.<h1>";
	}
  }else{
	 	$gdb->open("select a.nome,
					   a.matricula,					   
					   a.nascimento,
					   e.genero,
					   e.faixaEtaria,
					   e.modalidade
				 from aluno a,
				 	  preEquipe e,
				 	  preEquipeAluno p 
				 where
				   	    e.idEscola = '$idEscola'
					AND p.idAluno = a.idAluno 
					AND e.idpreEquipe = p.idpreEquipe
					AND e.modalidade = $modalidade ");
	if( $gdb->linhas>0 ){
		$gdb->titulo_campo = "Nome,Matricula,Idade,Sexo,Faixa Et&aacute;ria,Modalidade";
		$gdb->formato_campo = ",,,";
		$gdb->visivel_campo = "v,v,v,v,v";
		$gdb->alinha_campo = "e,e,c,c,c";				
		$gdb->print_tabela("Rela&ccedil;&atilde;o dos Atleta Inscritos", 1, 1, "");
	}else{
		print "<h1>N&atilde;o tem nenhum atleta inscrito dessa Unidade Escolar.<h1>";
	}			   
  }	

?>