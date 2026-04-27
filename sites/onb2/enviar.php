<?php 
$conecta = mysql_connect("127.0.0.1", "root", ""); 
$data = mysql_select_db('db_orcamento') or die ("falha ao conectar no BD");
if (isset ($_POST ['submit'])){
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$titulo = $_POST['titulo'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$ambito = $_POST['ambito'];
$descricao = $_POST['descricao'];
$local = $_POST['local'];
//$foto = $_POST['foto'];
//$data = $_POST['data'];

//deve ser arrumada a query
$cadastro = mysql_query ("INSERT INTO formulario (nome, endereco, cpf, titulo, telefone, ambito, descricao, local)
 VALUES('$nome','$endereco','$cpf','$titulo','$telefone','$ambito','$descricao','$local')") /* ,'$foto','$data' */ or die ("falha no inserir");
echo "Enviado com sucesso!";
}

else 
echo "Erro ao conectar!";
?> 