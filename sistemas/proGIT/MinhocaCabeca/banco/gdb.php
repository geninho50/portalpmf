<?php
///////////////////////////////////////////////////////////////////////////////
// Arquivo de funcoes desenvolvida para qualquer sistema feito em PHP        //
// Funcoes para manipulacao de Banco de Dados                                //
// Desenvolvedor : Eugenio e Barbara                                         //
// Criacao : 28/11/2018                                                      //
// Empresa: EJC Inform?tica                                                  //
///////////////////////////////////////////////////////////////////////////////

class gdb
{

  // variavel para titulo de campo
  var $titulo_campo;

  // variavel para formato de campo
  var $formato_campo;

  // variavel para visibilidade do campo
  // V - Visivel | N - N?o Visivel
  var $visivel_campo;

  // variavel para alinhamento do campo
  // E - esquerda | D - Direita | C - Centro
  var $alinha_campo;

  // variavel para largura da tabela 
  var $largura;

  // variavel para retornar o campo chave
  var $chave_campo;

  // variavel para guardar mensagens de erro de transa??o
  var $erro_bd;

  // variavel com a estru??o SQL
  var $sql_list;

  // variavel para a coenxao com o banco
  var $conexao_lg = 0;

  var $tabela = array();

  var $ds_sql_open;

  var $vt_parm;

  var $campos;

  var $lg_resl;

  var $linhas;

  // Funcao para conexcao ao banco de dados 
  function conexao(
    $banco    = 'srh-db',
    $servidor = '192.168.12.2:3312',
    $usuario  = 'root',
    $senha    = 'Change1.'
  ) {

    $resultado = 0;
    $resultado = mysqli_connect($servidor, $usuario, $senha, $banco);
    $this->conexao_lg = $resultado;

    if ($resultado && $banco != '') {
      if (!mysqli_select_db($this->conexao_lg, $banco)) {
        mysqli_close($this->conexao_lg);
        print "Nao Acessou o banco !!";
      }
    }
    return $resultado;
  }

  function parametro(
    $vr_sql,
    $vr_tipo,
    $vr_valor
  ) {

    if ($vr_valor == '') {
      $vr_valor = 'null';
      $vr_tipo  = 'NUMERIC';
    }
    $this->vt_parm[$vr_sql]['TIPO'] = $vr_tipo;
    $this->vt_parm[$vr_sql]['VALOR'] = $vr_valor;
  }

  // fun??o para execu??o de comandos SQL
  function open(
    $ds_sql  = '',
    $nu_linh = 0,
    $utf8    = 1
  ) {

    $ok = 1;
    
    if (!$this->conexao_lg) {
      // $this->conexao('formula1');  	
   
      $this->conexao('srh-db', '192.168.12.2:3312', 'root', 'Change1.');
    }

    $this->erro_bd = 0;

    // Passando para o parametro para o SQL
    if (is_array($this->vt_parm)) {
      $vr_camp = array_keys($this->vt_parm);

      // procurando os parametros no vetor
      for (
        $vr_index = 0;
        $vr_index < count($this->vt_parm);
        $vr_index++
      ) {

        if ($this->vt_parm[$vr_camp[$vr_index]]['VALOR'] != "") {
          // preparando os valores de acordo com o tipo
          if (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "STRING")
            $vr_valr = "'" . $this->vt_parm[$vr_camp[$vr_index]]['VALOR'] . "'";

          elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "NUMERIC") {
            $vr_valr = str_replace(".", "", $this->vt_parm[$vr_camp[$vr_index]]['VALOR']);
            $vr_valr = str_replace(",", ".", $vr_valr);
          } elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "ELIKE")
            $vr_valr = "'%" . $this->vt_parm[$vr_camp[$vr_index]]['VALOR'] . "'";

          elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DLIKE")
            $vr_valr = "'" . $this->vt_parm[$vr_camp[$vr_index]]['VALOR'] . "%'";

          elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "CLIKE")
            $vr_valr = "'%" . $this->vt_parm[$vr_camp[$vr_index]]['VALOR'] . "%'";

          elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DATA")
            $vr_valr = "'" . $this->vt_parm[$vr_camp[$vr_index]]['VALOR'] . "'";

          elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "IDATA")
            $vr_valr = "'" . date("Y-m-d H:i:s", strtotime($this->vt_parm[$vr_camp[$vr_index]]['VALOR'])) . "'";

          elseif (
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DIDATE" ||
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DIDATA"
          ) {
            $vr_valr = $this->vt_parm[$vr_camp[$vr_index]]['VALOR'];
            $vr_valr = substr($vr_valr, 6, 4) . "-" . substr($vr_valr, 3, 2) . "-" . substr($vr_valr, 0, 2);
            $vr_valr = "'" . $vr_valr . " 00:00'";
          } elseif (
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DTDATE" ||
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DTDATA"
          ) {
            $vr_valr = $this->vt_parm[$vr_camp[$vr_index]]['VALOR'];
            $vr_valr = substr($vr_valr, 6, 4) . "-" . substr($vr_valr, 3, 2) . "-" . substr($vr_valr, 0, 2);
            $vr_valr = "'" . $vr_valr . " 23:59'";
          } elseif (
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "PDATE" ||
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "PDATA"
          ) {
            $vr_valr = $this->vt_parm[$vr_camp[$vr_index]]['VALOR'];
            $vr_valr = substr($vr_valr, 6, 4) . substr($vr_valr, 3, 2) . substr($vr_valr, 0, 2);
          } elseif (
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "NDATE" ||
            strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "NDATA"
          ) {
            $vr_valr = $this->vt_parm[$vr_camp[$vr_index]]['VALOR'];
            $vr_valr = "'" . substr($vr_valr, 6, 4) . "-" . substr($vr_valr, 3, 2) . "-" . substr($vr_valr, 0, 2) . "'";
          } elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "DATE")
            $vr_valr = "'" . $this->vt_parm[$vr_camp[$vr_index]]['VALOR'] . "'";

          elseif (strtoupper($this->vt_parm[$vr_camp[$vr_index]]['TIPO']) == "IDATE")
            $vr_valr = "'" . date("Y-d-m H:i:s", strtotime($this->vt_parm[$vr_camp[$vr_index]]['VALOR'])) . "'";
        }
        $ds_sql = str_replace(":" . $vr_camp[$vr_index], $vr_valr, $ds_sql);
      }
    }

    if ($utf8) {
      $this->lg_resl = mysqli_query($this->conexao_lg, "SET NAMES 'utf8'");
    }


    // Tratamento contra inject SQL
    if (strstr(strtoupper($ds_sql), strtoupper("update")) != '') {
      if (strstr(strtoupper($ds_sql), strtoupper("where")) == ''){
        $ok = 0;
      }
    } 
    if (strstr(strtoupper($ds_sql), strtoupper("SHOW")) != '') {
      $ok = 0;
    }
    if($ok) {
      $this->lg_resl = mysqli_query($this->conexao_lg, $ds_sql);
    }

    $select = strstr(strtoupper($ds_sql), strtoupper("select"));


    if (
      strstr(strtoupper($ds_sql), strtoupper("insert")) != '' ||
      strstr(strtoupper($ds_sql), strtoupper("delete")) != '' ||
      strstr(strtoupper($ds_sql), strtoupper("update")) != ''
    ) $select = '';


    $this->gs = array();

    if ($this->lg_resl) { // Se o resultado do query for verdadeiro, pode criar o vetor com a tabela
      if ($select != '') {
        $this->campos  = mysqli_num_fields($this->lg_resl); // total de campos da tabela

        $this->linhas  = mysqli_num_rows($this->lg_resl);
        if ($nu_linh > 1 && $this->linhas > $nu_linh) $this->linhas = $nu_linh;
        if ($this->linhas > 0 && $this->campos > 0) {
          for (
            $xlinhas = 0;
            $xlinhas < $this->linhas;
            $xlinhas++
          ) {
            $registro = mysqli_fetch_row($this->lg_resl);
            for (
              $xcampos = 0;
              $xcampos < $this->campos;
              $xcampos++
            ) {

              $nameField = mysqli_fetch_field_direct($this->lg_resl, $xcampos);

              $this->gs[strtoupper($nameField->name)][$xlinhas] = $registro[$xcampos];

              if ($xlinhas == 0) {
                $this->tabela[] = strtoupper($nameField->name);
              }

              /*
                         $this->gs[ strtoupper( mysql_field_name( $ds_sql ,$xcampos ) ) ][$xlinhas]=$registro[$xcampos];
						 if($xlinhas == 0) $this->tabela[] = strtoupper( mysql_field_name( $ds_sql ,$xcampos )); 
			 */
            }
          }
        }
      }
    } else $this->erro_bd = 1;

    if ($nu_linh == 1) print '<BR>' . $ds_sql . '<BR>';

    // $this->lg_resl  =$lg_resl;
    $this->sql_list = $ds_sql;

    return $this->lg_resl;
  }

  function formato($vr_varv, $vr_form)
  {

    $vr_form = strtoupper($vr_form);
    $vr_resl = $vr_varv;

    switch ($vr_form) {
      case "DD/MM/YY":
        if (count($vr_varv) == 10) $vr_resl = substr($vr_varv, 0, 2) . "/" .
          substr($vr_varv, 3, 2) . "/" .
          substr($vr_varv, 8, 2);
        else $vr_resl = substr($vr_varv, 0, 2) . "/" .
          substr($vr_varv, 3, 2) . "/" .
          substr($vr_varv, 6, 2);
        break;
      case "YYYY/MM":
        if (count($vr_varv) == 10) $vr_resl = substr($vr_varv, 6, 4) . "/" .
          substr($vr_varv, 3, 2);
        else $vr_resl = '20' . substr($vr_varv, 6, 2) . "/" . substr($vr_varv, 3, 2);
        break;
      case "DD/MM/YYYY":
        if (count($vr_varv) == 12) $vr_resl = substr($vr_varv, 0, 2) . "/" .
          substr($vr_varv, 3, 2) . "/" .
          substr($vr_varv, 8, 4);
        else $vr_resl = substr($vr_varv, 8, 2) . "/" .
          substr($vr_varv, 5, 2) . "/" .
          substr($vr_varv, 0, 4);
        break;
      case "MM/YYYY":
        if (count($vr_varv) == 10) $vr_resl = substr($vr_varv, 3, 2) . "/" .
          substr($vr_varv, 6, 4);
        else $vr_resl = '20' . substr($vr_varv, 3, 2) . "/" . substr($vr_varv, 6, 4);
        break;
      case "VALOR":
        $vr_resl = number_format($vr_varv, 2, ',', '.');
        break;
      case "MOEDA":
        $vr_resl = "R$ " . number_format($vr_varv, 2, ',', '.');
        break;
    }

    return $vr_resl;
  }

    function vargetpost( $chave, $padrao = "" ){
      $retornar = "";
      /* 
	  print '<pre>';
	  print 'Vetor POST<br>';
	  print_r( $_POST );
	  print '</pre>';	  
	  print '<pre>';	  	  	  
	  print 'Vetor GET<br>';	  
	  print_r( $_GET );	  
	  print '</pre>';	  
	 */
      if (isset($_POST[$chave])) {
        if ($_POST[$chave] != '') $retornar = $_POST[$chave];
      }
      if (isset($_GET[$chave]) && $retornar == '') {
        if ($_GET[$chave] != '') $retornar = $_GET[$chave];
      }

      if ($retornar == '') $retornar = $padrao;
      
  
      return $retornar;
    }

    function print_erro()
    {
      echo 'erro n. ' . mysql_errno() . ': ' . mysql_error() . '<BR>';
      print 'Comando SQL :';
      print_r($this->sql_list);
    }

    function AdcionarDiasNaData($date, $days)
    {
      //print "Date :".$date."<br>";
      $thisyear = substr($date, 0, 4);
      $thismonth = substr($date, 5, 2);
      $thisday =  substr($date, 8, 2);
      //print "Dias :".$thisday;
      $nextdate = mktime(0, 0, 0, $thismonth, $thisday + $days, $thisyear);
      return strftime("%Y-%m-%d", $nextdate) . ' 00:00:00';
    }

    function SubtrairDiasNaData($date, $days)
    {
      //print "Date :".$date."<br>";
      $thisyear = substr($date, 0, 4);
      $thismonth = substr($date, 5, 2);
      $thisday =  substr($date, 8, 2);
      //print "Dias :".$thisday;
      $nextdate = mktime(0, 0, 0, $thismonth, $thisday - $days, $thisyear);
      return strftime("%Y-%m-%d", $nextdate) . ' 00:00:00';
    }

    function ajustar_valores($valor)
    {
      if (strlen($valor) > 6) $valor = str_replace('.', '', $valor);
      $valor = str_replace(',', '.', $valor);
      return $valor;
    }

    function selectDados($select)
    {

      $this->open($select);

      if ($this->linhas > 0) {

        for ($xlin = 0; $xlin < $this->linhas; $xlin++) {
          for ($xcol = 0; $xcol < $this->campos; $xcol++) {
            $xcoluna = strtoupper(mysqli_field_name($this->lg_resl, $xcol));
            $value = $this->gs[$xcoluna][$xlin];
            $dadosAux[$xcoluna] = $value;
          }
          $dadosUsuario[] = $dadosAux;
        }
        /*
         array_walk_recursive( 
              $dadosUsuario,
              function ($value){ 
                if ( is_string($value) ){
                     $value = utf8_encode($value); 
                }     
          } );
         
         echo json_encode($dadosUsuario);
		 */
      } else {
        print 0;
      }
    }

    function dados($gdb)
    {

      $gdb->open($select);

      if ($gdb->linhas > 0) {

        for ($xlin = 0; $xlin < $gdb->linhas; $xlin++) {
          for ($xcol = 0; $xcol < $gdb->campos; $xcol++) {
            $xcoluna = strtoupper(mysqli_field_name($gdb->lg_resl, $xcol));
            $value = $gdb->gs[$xcoluna][$xlin];
            $dadosAux[$xcoluna] = $value;
          }
          $dadosUsuario[] = $dadosAux;
        }
        /*
         array_walk_recursive( 
              $dadosUsuario,
              function (&$value){ 
                if ( is_string($value) ){
                     $value = utf8_encode($value); 
                }     
          } );
         
         echo json_encode($dadosUsuario);
		 */
      } else {
        print 0;
      }
    }
  
    
    function cadastrarParticipante($cpf,
                                   $nome,
                                   $rg,
                                   $data_nascimento,
                                   $email,
                                   $telefone,
                                   $celular,
                                   $profissao,
                                   $numero,
                                   $complemento,
                                   $quantidade_pessoa,
                                   $cep,$logradouro,
                                   $bairro,
                                   $cidade,
                                   $senha, 
                                   $id_evento = '' )
    {
      $this->open("select count(*) as tem  From pessoa Where cpf= '$cpf' ");
      $temCPF = $this->gs["TEM"][0];

      $this->open("select count(*) as tem  From pessoa Where email= '$email' ");
      $temEMAIL = $this->gs["TEM"][0];

      $this->open("select count(*) as tem  From pessoa Where identidade= '$rg' ");
      $temRG = $this->gs["TEM"][0];

      if( $temCPF>0 ){
        return 2;
      }else if( $temEMAIL>0 ){
        return 3;
      }else if( $temRG>0 ){
        return 4;
      }else{
            $this->open($sqlCheckEndereco);
            
            $sqlCheckEndereco = "SELECT id_endereco FROM endereco WHERE cep = '$cep'";

            $this->open($sqlCheckEndereco);
            $idEndereco = $this->gs["ID_ENDERECO"][0];
            
            if( empty($idEndereco) ) {
                $sqlEndereco = "INSERT INTO endereco (cep,logradouro,bairro,cidade) VALUES ('$cep','$logradouro','$bairro','$cidade')";
                $this->open($sqlEndereco);
                $this->open($sqlCheckEndereco);
                $idEndereco = $this->gs["ID_ENDERECO"][0];
            }

            $sqlPessoa = "INSERT INTO pessoa (cpf,nome,identidade,nascimento,email,telefone,celular,profissao,numero,complemento,quantidade_pessoa,id_endereco) 
                          VALUES ('$cpf','$nome','$rg','$data_nascimento','$email','$telefone','$celular','$profissao','$numero','$complemento','$quantidade_pessoa','$idEndereco')";
            $this->open($sqlPessoa);

            $sqlIdPessoa = "SELECT id_pessoa FROM pessoa WHERE cpf = '$cpf'";
            $this->open($sqlIdPessoa);
            $idPessoa = $this->gs["ID_PESSOA"][0];

            $sqlUsuario = "INSERT INTO usuario (id_pessoa,login,nome,senha) VALUES ('$idPessoa','$email','$nome','$senha')";
            $this->open($sqlUsuario);

            $sqlConteParticipante = "SELECT COUNT(u.id_usuario) AS participantes FROM usuario u LEFT JOIN statusUsuario su ON u.id_usuario = su.id_usuario WHERE status_usuario = '1'";
            $this->open($sqlConteParticipante);
            $participantes = $this->gs["PARTICIPANTES"][0];

            if( $participantes <= 5 ) {
                $sqlCheckId = "SELECT id_usuario FROM usuario WHERE id_pessoa = '$idPessoa'";
                $this->open($sqlCheckId);
                $idUsuario = $this->gs["ID_USUARIO"][0];

                $sqlStatusUsuario = "INSERT INTO statusUsuario (id_usuario,status_usuario) VALUES ('$idUsuario','1')";
                $this->open($sqlStatusUsuario);

            } else {
                $sqlCheckId = "SELECT id_usuario FROM usuario WHERE id_pessoa = '$idPessoa'";
                $this->open($sqlCheckId);
                $idUsuario = $this->gs["ID_USUARIO"][0];

                $sqlStatusUsuario = "INSERT INTO statusUsuario (id_usuario,status_usuario) VALUES ('$idUsuario','3')";
                $this->open($sqlStatusUsuario);
            }

            if( $id_evento != '' ){
                $this->inscricaoEvento( $idPessoa,$id_evento );
            }

            return 1;
      }  

    }

    function editarSenha($id_pessoa,$senha){

      $sqlSenha = "select id_usuario FROM usuario WHERE id_pessoa = '$id_pessoa' ";
      $this->open($sqlSenha);
      
      if( $this->linhas>0 ){

          $id_usuario = $this->gs['ID_USUARIO'][0];
        
          $sqlSenha = "UPDATE usuario SET senha = '$senha' WHERE id_pessoa = '$id_pessoa'";
          $this->open($sqlSenha);  
          
          $sqlSenha = "UPDATE statusUsuario SET status_usuario = '1' WHERE id_usuario = '$id_usuario'";
          $this->open($sqlSenha);
      }else{
          $this->open("select * from pessoa where id_pessoa = '$id_pessoa' ");
          
          if( $this->linhas>0 ){
              $nome  = $this->gs["NOME"][0];
              $email = $this->gs["EMAIL"][0];
             
              $sqlSenha = "INSERT INTO usuario( id_pessoa, login, nome, senha  ) VALUES('$id_pessoa','$email','$nome','$senha' ) ";
              $this->open($sqlSenha);
          } 

          $this->open("select id_usuario FROM usuario WHERE id_pessoa = '$id_pessoa' ");
          $id_usuario = $this->gs['ID_USUARIO'][0];
          $this->open("UPDATE statusUsuario SET status_usuario = '1' WHERE id_usuario = '$id_usuario' ");
          
          // criar aqui o select para inserir o usuário e senha        
      }
      
      return 1;
    }

    function editarParticipante($id_pessoa,$email,$telefone,$celular,$profissao,$numero,$complemento,$quantidade_pessoa,$id_endereco,$cep,$logradouro,$bairro)
    {
      $sqlPessoa = "UPDATE pessoa SET email = '$email', telefone = '$telefone', celular = '$celular', profissao = '$profissao', numero = '$numero', complemento = '$complemento', quantidade_pessoa = '$quantidade_pessoa' WHERE id_pessoa = '$id_pessoa'";
      $this->open($sqlPessoa);    

      $sqlEndereco = "UPDATE endereco SET cep = '$cep', logradouro = '$logradouro', bairro = '$bairro' WHERE id_endereco = '$id_endereco'";
      $this->open($sqlEndereco);

      $sqlUsuario = "UPDATE usuario SET login = '$email' WHERE id_pessoa = '$id_pessoa'";
      $this->open($sqlUsuario);
       
      return 1;
    }

    function atualizarParticipante($id_pessoa,$cpf,$nome,$rg,$nascimento,$email,$telefone,$celular,$profissao,$numero,$complemento,$quantidade_pessoa,$id_endereco,$cep,$logradouro,$bairro)
    {
      $sqlPessoa = "UPDATE pessoa SET cpf = '$cpf', nome = '$nome', identidade = '$rg', nascimento = '$nascimento', email = '$email', telefone = '$telefone', celular = '$celular', profissao = '$profissao', numero = '$numero', complemento = '$complemento', quantidade_pessoa = '$quantidade_pessoa' WHERE id_pessoa = '$id_pessoa'";
      $this->open($sqlPessoa);    

      $sqlEndereco = "UPDATE endereco SET cep = '$cep', logradouro = '$logradouro', bairro = '$bairro' WHERE id_endereco = '$id_endereco'";
      $this->open($sqlEndereco);

      $sqlUsuario = "UPDATE usuario SET login = '$email' WHERE id_pessoa = '$id_pessoa'";
      $this->open($sqlUsuario);
       
      return 1;
    }


    function enviarArquivo($doc_rg,$doc_cpf,$doc_residencia)
    {
      $sqldocumentoPessoa = "INSERT INTO documentoPessoa (doc_rg,doc_cpf,doc_residencia) VALUES ('$doc_rg','$doc_cpf','$doc_residencia')";
      $this->open($sqldocumentoPessoa);

      $this->open("SELECT id_documento FROM documentoPessoa WHERE doc_rg = '$doc_rg' AND doc_cpf = '$doc_cpf' AND doc_residencia = '$doc_residencia'");
      $idDocumento = $this->gs["ID_DOCUMENTO"][0];

      $sqlIdPessoa = "SELECT  d.id_pessoa, p.id_pessoa FROM documentoPessoa d LEFT JOIN pessoa p  WHERE d.id_pessoa = p.id_pessoa";
      $idPessoa = $this->open($sqlIdPessoa);

      $sqldocumentoPessoa = "INSERT INTO documentoPessoa (id_documento, id_pessoa) VALUES ('$idDocumento', '$idPessoa')";
      $this->open($sqldocumentoPessoa);

      return 1;
    }


    function editarArquivo($doc_rg,$doc_cpf,$doc_residencia)
    {
      $sqlIdPessoa = "SELECT  p.id_pessoa, d.id_pessoa FROM documentoPessoa d LEFT JOIN pessoa p  WHERE d.id_pessoa = p.id_pessoa";
      $idPessoa = $this->open($sqlIdPessoa);

      $sqldocumentoPessoa = "UPDATE documentoPessoa SET doc_rg = '$doc_rg', doc_cpf = '$doc_cpf', doc_residencia = '$doc_residencia' WHERE id_pessoa = '$idPessoa'";
      $this->open($sqldocumentoPessoa);

      return 1;
    }

    function incluirEvento($nome_evento,$descricao,$ministrante,$carga_horaria,$local,$vagas,$data,$hora, $status_evento = '1', $observacao)
    {
      $data_e = $data;
      $DFm = explode("/",$data_e);
      $timestamp = $DFm[2].'-'.$DFm[1].'-'.$DFm[0];

      $sqlEvento = "INSERT INTO evento (nome_evento,descricao,ministrante,carga_horaria,local,vagas,data,hora, status_evento, observacao ) 
                    VALUES ('$nome_evento','$descricao','$ministrante','$carga_horaria','$local','$vagas','$timestamp','$hora','$status_evento','$observacao' )";

      $this->open($sqlEvento);

      $this->open("SELECT MAX(id_evento) AS ID FROM evento");

      $id_evento = $this->gs["ID"][0];

      $this->open("INSERT INTO statusEvento (id_evento, status_evento) 
                   VALUES ('$id_evento','1')");

      return 1;
    }

    function editarEvento($id_evento, $nome_evento,$descricao,$ministrante,$carga_horaria,$local,$vagas,$data,$hora,$status_evento = '1', $observacao )
    {
      $data_e = $data;
      $DFm = explode("/",$data_e);
      $timestamp = $DFm[2].'-'.$DFm[1].'-'.$DFm[0];

      $sqlEvento = "UPDATE evento 
                    SET nome_evento = '$nome_evento',
                        descricao = '$descricao', 
                        ministrante = '$ministrante', 
                        carga_horaria = '$carga_horaria', 
                        local = '$local', 
                        vagas = '$vagas', 
                        data = '$timestamp', 
                        status_evento = '$status_evento',
                        hora = '$hora',
                        observacao = '$observacao'
                  WHERE id_evento = '$id_evento' ";
      $this->open($sqlEvento);

      return 1;
    }

    function encerrarEvento($id_evento)
    {
      $sqlEvento = "UPDATE statusEvento SET status_evento = '0' WHERE id_evento = '$id_evento'";
      $this->open($sqlEvento);

      return 1;
    }

    function excluirEvento($id_evento)
    {
      $sqlDelEvento = "DELETE FROM evento WHERE id_evento = '$id_evento'";
      $this->open($sqlDelEvento);

      return 1;
    }

    function cadastrarAdmin($nome,$cpf,$email_admin,$telefone,$celular,$cargo,$setor,$senha)
    {
      $sqlAdmin = "INSERT INTO usuarioAdmin (nome,cpf,email_admin,telefone,celular,cargo,setor,senha) VALUES ('$nome','$cpf','$email_admin','$telefone','$celular','$cargo','$setor','$senha')";
      $this->open($sqlAdmin);

      return 1;
    }

    function editarAdmin($id_usuario_admin,$email_admin,$telefone,$celular,$cargo,$setor)
    { 
      $sqlAdmin = "UPDATE usuarioAdmin SET email_admin = '$email_admin', telefone = '$telefone', celular = '$celular', cargo = '$cargo', setor = '$setor' WHERE id_usuario_admin = '$id_usuario_admin'";
      $this->open($sqlAdmin);
      
      return 1;
    }

    function editarAdminSenha($id_usuario_admin,$senha) 
    {
      $sqlAdminSenha = "UPDATE usuarioAdmin SET senha = '$senha' WHERE id_usuario_admin = '$id_usuario_admin'";
      $this->open($sqlAdminSenha);

      return 1;
    }

    function inscricaoEvento($id_pessoa,$id_evento)
    {
      $sqlCheckInsc = "SELECT id_evento_inscricao as id FROM eventoInscricao WHERE id_pessoa = '$id_pessoa' AND id_evento = '$id_evento'";
      $this->open($sqlCheckInsc);

      $id_evento_inscricao = $this->gs["ID"][0];

      if(empty($id_evento_inscricao)) {
        $sqlEvento = "INSERT INTO eventoInscricao (id_pessoa,id_evento,status_inscricao) VALUES ('$id_pessoa','$id_evento','1')";
      } else {
        $sqlEvento = "UPDATE eventoInscricao SET status_inscricao = '1' WHERE id_evento_inscricao = '$id_evento_inscricao'";
      }

      $this->open($sqlEvento);

      $selectAtivarUsuario =  "select u.id_usuario as id from pessoa p, usuario u where u.id_pessoa = p.id_pessoa and  p.id_pessoa = '$id_pessoa' "; 
      $this->open( $selectAtivarUsuario );
      $id = $this->gs["ID"][0];

      $this->open("UPDATE statusUsuario SET status_usuario = '1' WHERE id_usuario = '$id' ");
      
      return 1;
    }

    function inscricaoEventoAdmin($id_pessoa,$id_evento)
    {
      
      $sqlcheckUsuario = "SELECT su.status_usuario FROM usuario u
                          LEFT JOIN pessoa p ON u.id_pessoa = p.id_pessoa
                          LEFT JOIN statusUsuario su ON su.id_usuario = u.id_pessoa
                          WHERE u.id_pessoa = '$id_pessoa'";
      $this->open($sqlcheckUsuario);
      $status_usuario = $this->gs["STATUS_USUARIO"][0];

      $sqlCheckInsc = "SELECT id_evento_inscricao as id FROM eventoInscricao WHERE id_pessoa = '$id_pessoa' AND status_inscricao = '1'";
      $this->open($sqlCheckInsc);

      $id_evento_inscricao_check = $this->gs["ID"][0];

      if($status_usuario == 2 || $status_usuario == 3) {
        return 2;
      }else{
        if(empty($id_evento_inscricao_check)) {
          $sqlCheckInscEvento = "SELECT id_evento_inscricao as id FROM eventoInscricao WHERE id_pessoa = '$id_pessoa' AND id_evento = '$id_evento'";
          $this->open($sqlCheckInscEvento);

          $id_evento_inscricao = $this->gs["ID"][0];

          if(empty($id_evento_inscricao)) {
            $sqlEvento = "INSERT INTO eventoInscricao (id_pessoa,id_evento,status_inscricao) VALUES ('$id_pessoa','$id_evento','1')";
          } else {
            $sqlEvento = "UPDATE eventoInscricao SET status_inscricao = '1' WHERE id_evento_inscricao = '$id_evento_inscricao'";
          }

          $this->open($sqlEvento);
          return 1;
        } else {
          return 0;
        }
      }
    }

    function cancelarEvento($id_pessoa,$id_evento_pessoa)
    {
      $sqlcancelaEvento = "UPDATE eventoInscricao SET status_inscricao = '2' WHERE id_pessoa = '$id_pessoa' AND id_evento = '$id_evento_pessoa'";
      $this->open($sqlcancelaEvento);

      return 1;
    }

    function cancelarEventoAdmin($id_pessoa,$id_evento)
    {
      $sqlcancelarEventoAdmin = "UPDATE eventoInscricao SET status_inscricao = '2' WHERE id_pessoa = '$id_pessoa' AND id_evento = '$id_evento'";
      $this->open($sqlcancelarEventoAdmin);

      return 1;
    }

    function incluirTroca($id_pessoa,$data_troca,$quantidade_troca)
    {     

      $sqlTroca = "INSERT INTO minhocario (id_pessoa, data_troca, quantidade_troca) VALUES ('$id_pessoa','$data_troca','$quantidade_troca')";
      $this->open($sqlTroca);
      return 1;
    
    }

    function enviarMensagemUsuario ($id_usuario,$assunto,$mensagem)
    {
      
      $sqlEnviar = "INSERT INTO mensagem (id_usuario,assunto,mensagem,data_envio) VALUES ('$id_usuario','$assunto','$mensagem',now())";
      $this->open($sqlEnviar);

      $sqlMensagem = "SELECT id_mensagem FROM mensagem WHERE id_usuario = '$id_usuario' AND assunto = '$assunto' AND mensagem = '$mensagem'";
      $this->open($sqlMensagem);

      $id_mensagem = $this->gs["ID_MENSAGEM"][0];

      $sqlStatusMensagem = "INSERT INTO statusMensagem (id_mensagem, id_usuario, status_mensagem) VALUES ('$id_mensagem', '$id_usuario', '1')";
      $this->open($sqlStatusMensagem);

      return 1;
    }

    function enviarMensagemAdmin ($id_mensagem,$id_usuario_admin,$resposta)
    {

      $sqlResponder = "UPDATE mensagem SET id_usuario_admin = '$id_usuario_admin', resposta = '$resposta', data_resposta = now() WHERE id_mensagem = '$id_mensagem'";
      $this->open($sqlResponder);

      $sqlStatusMensagem = "UPDATE statusMensagem SET status_mensagem = '2', id_usuario_admin = '$id_usuario_admin' WHERE id_mensagem = '$id_mensagem'";
      $this->open($sqlStatusMensagem);

      return 1;

    }
    
    function buscaInscritosEvento($id_evento)
    {
      $this->open("SELECT COUNT(id_pessoa) AS INSCRITOS FROM eventoInscricao WHERE status_inscricao = '1' AND id_evento = '$id_evento'");
      $inscritos = $this->gs["INSCRITOS"][0];

      $this->open("SELECT e.vagas from evento e WHERE id_evento = '$id_evento'");
      $vaga = $this->gs["VAGAS"][0];

      $total = $vaga - $inscritos;

      if ($inscritos == $vaga){
        $total = 'Vagas esgotadas';
      }
  
      return $total;
    }

    function incluirDocumento($id_pessoa,$doc_rg,$doc_cpf,$doc_residencia)
    {
      $sqlCheckDocumento = "SELECT count(d.id_pessoa) AS C FROM documentoPessoa d WHERE d.id_pessoa = '$id_pessoa'";

      $this->open($sqlCheckDocumento);

      $c_id_pessoa = $this->gs["C"][0];

      if($c_id_pessoa != 1){
        $sqlDocumento = "INSERT INTO documentoPessoa (id_pessoa,doc_rg,doc_cpf,doc_residencia) VALUES ('$id_pessoa','$doc_rg','$doc_cpf','$doc_residencia')";
        $this->open($sqlDocumento);
      } else {
        if($doc_rg != '0') {
          $sqlDocRgUp = "UPDATE documentoPessoa SET doc_rg = '$doc_rg' WHERE id_pessoa = '$id_pessoa'";
          $this->open($sqlDocRgUp);
        }

        if($doc_cpf != '0') {
          $sqlDocCpfUp = "UPDATE documentoPessoa SET doc_cpf = '$doc_cpf' WHERE id_pessoa = '$id_pessoa'";
          $this->open($sqlDocCpfUp);
        }

        if($doc_residencia != '0') {
          $sqlDocResidenciaUp = "UPDATE documentoPessoa SET doc_residencia = '$doc_residencia' WHERE id_pessoa = '$id_pessoa'";
          $this->open($sqlDocResidenciaUp);
        }
      }

    }

    function voltarFila($id_usuario)
    {
      $sqlvoltarFila = "UPDATE statusUsuario SET status_usuario = '3' WHERE id_usuario = '$id_usuario'";
      return $this->open($sqlvoltarFila);
    }

    function cancelarParticipacao($id_usuario)
    {
      $sqlcancelarParticipacao = "UPDATE statusUsuario SET status_usuario = '2' WHERE id_usuario = '$id_usuario'";
      return $this->open($sqlcancelarParticipacao);
    }

    function statusMinhocario($id_pessoa,$status_minhocario)
    {
      $sqlstatusMinhocario = "UPDATE pessoa SET status_minhocario = '$status_minhocario' WHERE id_pessoa = '$id_pessoa'";
      return $this->open($sqlstatusMinhocario);
    }

    function obter_parametros () {
    
      $p = array();
      
      // Verifica se o parâmetro path foi enviado
      if ( isset( $_GET['p'] ) ) {
  
          // Captura o valor de $_GET['p']
          $p = $_GET['p'];
          
          // Limpa os dados
          $p = rtrim($p, '/');
          $p = filter_var($p, FILTER_SANITIZE_URL);
          
          // Cria um array de parâmetros
          $p = explode('/', $p);
      }
      
      return $p;
    }

  } 
  