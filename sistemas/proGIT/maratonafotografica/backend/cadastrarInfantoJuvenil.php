<?php
require_once("db-comum.php"); 

$sql = "SELECT COUNT(*) AS qtd FROM infantoJuvenil WHERE ano = ".date("Y");
$result = $conn->query($sql);
$result = $result->fetch_assoc();

if($result['qtd'] < 80){
    require_once("db.php");

    $nome                = utf8_decode($_POST['nome']);
    $dataNasc            = utf8_decode($_POST['dataNasc']);
    $nacionalidade       = utf8_decode($_POST['nacionalidade']);
    $faixaEtaria         = utf8_decode($_POST['faixaEtaria']);
    $email               = utf8_decode($_POST['email']);
    $telefone            = utf8_decode($_POST['telefone']);
    $celular             = utf8_decode($_POST['celular']);
    $equipamento         = utf8_decode($_POST['equipamento']);
    $endereco            = utf8_decode($_POST['endereco']);
    $bairro              = utf8_decode($_POST['bairro']);
    $cidade              = utf8_decode($_POST['cidade']);
    $cep                 = utf8_decode($_POST['cep']);
    $instituicaoEnsino   = utf8_decode($_POST['instituicaoEnsino']);
    $instituicaoTelefone = utf8_decode($_POST['instituicaoTelefone']);
    $responsavelNome     = utf8_decode($_POST['responsavelNome']);
    $responsavelProfissao= utf8_decode($_POST['responsavelProfissao']);
    $responsavelRG       = utf8_decode($_POST['responsavelRG']);
    $responsavelCPF      = utf8_decode($_POST['responsavelCPF']);
    $banco               = utf8_decode($_POST['banco']);
    $agencia             = utf8_decode($_POST['agencia']);
    $bancoNum            = utf8_decode($_POST['bancoNum']);
    $contaNum            = utf8_decode($_POST['contaNum']);
    $parentesco          = utf8_decode($_POST['parentesco']);
    $cpf                 = utf8_decode($_POST['cpf']);
    $ano                 = date("Y");

    $sql = "SELECT COUNT(*) AS qtd FROM infantoJuvenil WHERE ano = ".date("Y")." AND cpf = '" . $cpf . "'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    if(trim($cpf) != ""){
        if ($result['qtd'] == 1) {
            $erro = 'LIMITE MAXIMO DE CADASTRO POR CPF ATINGIDO';
            echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $cpf));
            die;
        }
    }

    function verificaFaixaEtaria($nasc, $faixaEtaria) {
        list($ano, $mes, $dia) = explode('-', $nasc);

        // data atual
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

        // cálculo
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        switch ($faixaEtaria)
        {
            case 1:
                if(!($idade >= 6 && $idade <= 9)) {
                    $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária (6-9) escolhida';
                    echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => 'dataNasc'));
                    die;
                }
                break;
            case 2:
                if(!($idade >= 10 && $idade <= 12)) {
                    $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária (10-12) escolhida';
                    echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => 'dataNasc'));
                    die;
                }
                break;
            case 3:
                if(!($idade >= 13 && $idade <= 15)) {
                    $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária (13-15) escolhida';
                    echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => 'dataNasc'));
                    die;
                }
                break;
            case 4:
                if(!($idade >= 16 && $idade <= 17)) {
                    $erro = 'A idade (' . $idade . ') do participante não condiz com a faixa etária (16-17) escolhida';
                    echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => 'dataNasc'));
                    die;
                }
                break;
        }
    }

    function verificaVazio($var, $campo, $campoClass) {
        if(empty($var)){
            $erro = 'O Campo "'.$campo.'" não pode ficar em branco';
            echo json_encode(array('sucesso' => 0, 'erro' => $erro, 'idErro' => $campoClass));
            die;
        }
    }

    verificaVazio($nome, 'nome', 'nome' );
    verificaVazio($nome, 'Data de Nascimento', 'dataNasc' );
    verificaVazio($nacionalidade, 'Nacionalidade', 'nacionalidade' );
    verificaVazio($faixaEtaria, 'Faixa Etaria', 'faixaEtaria' );
    verificaVazio($email, 'Email', 'email' );
    verificaVazio($telefone, 'Telefone', 'telefone' );
    verificaVazio($celular, 'celular', 'celular' );
    verificaVazio($equipamento, 'Equipamento', 'equipamento' );
    verificaVazio($endereco, 'Endereço', 'endereco' );
    verificaVazio($bairro, 'Bairro', 'bairro' );
    verificaVazio($cidade, 'Cidade', 'cidade' );
    verificaVazio($cep, 'CEP', 'cep' );
    verificaVazio($instituicaoEnsino, 'Instituição de Ensino', 'instituicaoEnsino' );
    verificaVazio($instituicaoTelefone, 'Telefone da Instituição', 'instituicaoTelefone' );
    verificaVazio($responsavelNome, 'Nome do Responsável', 'responsavelNome' );
    verificaVazio($responsavelRG, 'RG do responsável', 'responsavelRG' );
    verificaVazio($responsavelCPF, 'CPF do Responsável', 'responsavelCPF' );
    verificaVazio($banco, 'Banco', 'banco' );
    verificaVazio($agencia, 'Agencia', 'agencia' );
    verificaVazio($bancoNum, 'N° do Banco', 'bancoNum' );
    verificaVazio($contaNum, 'N° da Conta', 'contaNum' );
    verificaVazio($responsavelProfissao, 'Profissão do Responsável', 'responsavelProfissao' );
    verificaVazio($parentesco, 'Parentesco', 'parentesco' );

    $dataNasc = explode('/', $dataNasc);
    $dataNasc = $dataNasc[2]  . "-" . $dataNasc[1] . "-" . $dataNasc[0];

    verificaFaixaEtaria($dataNasc, $faixaEtaria);

    $insertQuery = $db->prepare("INSERT INTO infantoJuvenil 
                                 (nome, dataNasc, faixaEtaria, email, telefone, celular, equipamento, endereco, bairro, cidade, cep, instituicaoEnsino, responsavelNome, responsavelRG, responsavelCPF, banco, agencia, bancoNum, contaNum, instituicaoTelefone, nacionalidade, responsavelProfissao, parentesco, ano, cpf)
                                 VALUES 
                                    (:nome, :dataNasc, :faixaEtaria, :email, :telefone, :celular, :equipamento, :endereco, :bairro, :cidade, :cep, :instituicaoEnsino, :responsavelNome, :responsavelRG, :responsavelCPF, :banco, :agencia, :bancoNum, :contaNum, :instituicaoTelefone, :nacionalidade, :responsavelProfissao, :parentesco, :ano, :cpf)");

    $insertQuery->bindParam(':nome', $nome);
    $insertQuery->bindParam(':dataNasc', $dataNasc);
    $insertQuery->bindParam(':faixaEtaria', $faixaEtaria);
    $insertQuery->bindParam(':email', $email);
    $insertQuery->bindParam(':telefone', $telefone);
    $insertQuery->bindParam(':celular', $celular);
    $insertQuery->bindParam(':equipamento', $equipamento);
    $insertQuery->bindParam(':endereco', $endereco);
    $insertQuery->bindParam(':bairro', $bairro);
    $insertQuery->bindParam(':cidade', $cidade);
    $insertQuery->bindParam(':cep', $cep);
    $insertQuery->bindParam(':instituicaoEnsino', $instituicaoEnsino);
    $insertQuery->bindParam(':responsavelNome', $responsavelNome);
    $insertQuery->bindParam(':responsavelRG', $responsavelRG);
    $insertQuery->bindParam(':responsavelCPF', $responsavelCPF);
    $insertQuery->bindParam(':banco', $banco);
    $insertQuery->bindParam(':agencia', $agencia);
    $insertQuery->bindParam(':bancoNum', $bancoNum);
    $insertQuery->bindParam(':contaNum', $contaNum);
    $insertQuery->bindParam(':instituicaoTelefone', $instituicaoTelefone);
    $insertQuery->bindParam(':nacionalidade', $nacionalidade);
    $insertQuery->bindParam(':responsavelProfissao', $responsavelProfissao);
    $insertQuery->bindParam(':parentesco', $parentesco);
    $insertQuery->bindParam(':ano',$ano);
    $insertQuery->bindParam(':cpf',$cpf);

    $execute = $insertQuery->execute();

    if($execute){
        session_start();
        $_SESSION['id'] = $db->lastInsertId();
        echo json_encode(array('sucesso' => 1));
    }else{
        echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
    }

}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'inscrições encerradas', 'classe' => 'geral'));
}

?>