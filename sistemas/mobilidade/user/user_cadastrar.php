<?php
session_start();
include_once("conexao.php");
header('Content-type: text/html; charset=UTF-8');
$nome = $_POST['nome'];
$nome = mb_strtoupper($nome, 'UTF-8'); // troca tudo por maiusculo
$email = $_POST['email'];
$origem = 'PMF';

if ($_POST['setor1']!=='') {
	$sigla = $_POST['setor1'];
};
if ($_POST['setor2']!=='') {
	$sigla = $_POST['setor2'];
};

// $sigla = $_POST['setor1'];
$matricula = $_POST['matricula'];
//$categoria = $_POST['categoria'];

$usuario = $_POST['usuario']; // ja vem do formulario padrao que a pessoa usa
$data_criado = date("Y-m-d H:i:s");
$cpf = $_POST['cpf'];
$cpf = (preg_replace("/[^0-9]/", "", $cpf));
$senha = $_POST['senha'];
$nivel_acesso = $_POST['nivel_acesso'];
$pagina = $_POST['pagina'];

$sql = "SELECT id FROM login.usuarios WHERE id=(select max(id) from login.usuarios)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch();
$id = $row["id"] + 1;
$codigo_registro = substr(md5(mt_Rand()), 0, 3);
$id_user = $codigo_registro . str_pad($id, 4, '0', STR_PAD_LEFT);

$query_03 = "SELECT * FROM login.usuarios where id_user = '$id_user'";
$resultado_03 = $conn->query($query_03);
$count03 = $resultado_03->rowCount();

if ($count03 != 0) {
	"
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=". $pagina ."'>
	        ";
} else {

	$sql = 'INSERT INTO login.usuarios
	(
	id_user,
	nivel_acesso,
  	nome,
	usuario,
	email,
    matricula,
	senha,
	cpf,
    data_criado,
	sigla,
	origem

	) VALUES (
	:id_user,
	:nivel_acesso,
	:nome,
	:usuario,
	:email,
    :matricula,
	:senha,
	:cpf,
    :data_criado,
	:sigla,
	:origem

  	)';

	$stmt = $conn->prepare($sql);
	$stmt->bindValue(':id_user', $id_user);
	$stmt->bindValue(':nivel_acesso', $nivel_acesso, PDO::PARAM_INT);
	$stmt->bindValue(':nome', $nome);
	$stmt->bindValue(':usuario', $usuario);
	$stmt->bindValue(':email', $email);
	$stmt->bindValue(':matricula', $matricula);
	$stmt->bindValue(':senha', MD5($senha));
	$stmt->bindValue(':cpf', $cpf, PDO::PARAM_INT);
	$stmt->bindValue(':data_criado', $data_criado);
	$stmt->bindValue(':sigla', $sigla);
	$stmt->bindValue(':origem', $origem);
	$stmt->execute();

	$query_02 = "SELECT * FROM login.usuarios where data_criado = '$data_criado'";
	$resultado_02 = $conn->query($query_02);
	$count = $resultado_02->rowCount();

?>


<!DOCTYPE html>
	<html lang="pt-br">

	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
			if ($count != 0) {
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=". $pagina ."' > 
				<script type=\"text/javascript\">alert(\"Cadastro efetuado.\");
		</script>
	
		     ";
			} else {
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=". $pagina ."'>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>
			";
			} ?>
	</body>
    </html>
<?php
} ?>
