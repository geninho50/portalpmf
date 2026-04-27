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
    $banco = 'adoteDibea',
    $servidor = '192.168.1.20',
    $usuario = 'root',
    $senha = 'https!@17'
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
    $ds_sql = '',
    $nu_linh = 0,
    $utf8 = 1
  ) {

    if (!$this->conexao_lg) {
      // $this->conexao('formula1');  		   
      $this->conexao('adoteDibea', '192.168.1.20', 'root', 'https!@17');
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
    $this->lg_resl = mysqli_query($this->conexao_lg, $ds_sql);


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

    function vargetpost($chave, $padrao = "")
    {
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
  
    function inserir($nome_animal,$tipo,$sexo,$porte,$sobre,$idade_animal,$temperamento,$sociavel,$vive_bem,$saude,$img_principal,$img_dois,$img_tres,$id_localizacao,$id_local)
    {
      $sqlAnimal = "INSERT INTO animal (nome_animal, tipo, sexo, porte, sobre, idade_animal) VALUES ('$nome_animal', '$tipo', '$sexo', '$porte', '$sobre', '$idade_animal')";
      $this->open($sqlAnimal);
      $this->open("SELECT MAX(id_animal) AS ID FROM animal");
      $idAnimal = $this->gs["ID"][0];

      if(is_array($temperamento)) {
        foreach($temperamento as $temp){
          $sqlTemperamento = "INSERT INTO temperamento_animal (id_animal, id_temperamento) VALUES ('$idAnimal', '$temp')";
          $this->open($sqlTemperamento);
        }
      } else {
        $sqlTemperamento = "INSERT INTO temperamento_animal (id_animal, id_temperamento) VALUES ('$idAnimal', '$temperamento')";
        $this->open($sqlTemperamento);
      }
      
      if(is_array($sociavel)) {
        foreach($sociavel as $soc){
          $sqlSociavel = "INSERT INTO sociavel_animal (id_animal, id_sociavel) VALUES ('$idAnimal', '$soc')";
          $this->open($sqlSociavel);
        }
      } else {
        $sqlSociavel = "INSERT INTO sociavel_animal (id_animal, id_sociavel) VALUES ('$idAnimal', '$sociavel')";
        $this->open($sqlSociavel);
      }
      
      if(is_array($vive_bem)) {
        foreach($vive_bem as $vive){
          $sqlViveBem = "INSERT INTO vive_bem_animal (id_animal, id_vive_bem) VALUES ('$idAnimal', '$vive')";
          $this->open($sqlViveBem);
        }
      } else {
        $sqlViveBem = "INSERT INTO vive_bem_animal (id_animal, id_vive_bem) VALUES ('$idAnimal', '$vive_bem')";
        $this->open($sqlViveBem);
      }

      if(is_array($saude)) {
        foreach($saude as $sau){
          $sqlSaude = "INSERT INTO saude_animal (id_animal, id_saude) VALUES ('$idAnimal', '$sau')";
          $this->open($sqlSaude);
        }
      } else {
        $sqlSaude = "INSERT INTO saude_animal (id_animal, id_saude) VALUES ('$idAnimal', '$saude')";
        $this->open($sqlSaude);
      }

      $sqlGaleria = "INSERT INTO galeria (img_principal, img_dois, img_tres) VALUES ('$img_principal', '$img_dois', '$img_tres')";
      $this->open($sqlGaleria);

      $this->open("SELECT id_galeria FROM galeria WHERE img_principal = '$img_principal' AND img_dois = '$img_dois' AND img_tres = '$img_tres'");
      $idGaleria = $this->gs["ID_GALERIA"][0];

      $sqlGaleriaAnimal = "INSERT INTO galeria_animal (id_animal, id_galeria) VALUES ('$idAnimal', '$idGaleria')";
      $this->open($sqlGaleriaAnimal);

      $sqlLocalizacaoAnimal = "INSERT INTO localizacao_animal(id_animal, id_localizacao) VALUES ('$idAnimal', '$id_localizacao')"; 
      $this->open($sqlLocalizacaoAnimal); 

      $sqlLocalAnimal = "INSERT INTO local_animal(id_animal, id_local) VALUES ('$idAnimal', '$id_local')"; 
      $this->open($sqlLocalAnimal);

      return $idAnimal;
    }

    function editar($idAnimal,$nome_animal,$sobre,$idade_animal,$saude,$sociavel,$temperamento,$vive_bem,$img_principal,$img_dois,$img_tres,$id_localizacao,$id_local)
    {

      $sqlAnimal = "UPDATE animal SET nome_animal = '$nome_animal', sobre = '$sobre', idade_animal = '$idade_animal' WHERE id_animal = '$idAnimal'";
      $this->open($sqlAnimal);


      $sqlTemperamento = "DELETE FROM temperamento_animal WHERE id_animal = '$idAnimal'";
      $this->open($sqlTemperamento);
      foreach($temperamento as $temp){
        $sqlTemperamento = "INSERT INTO temperamento_animal (id_animal, id_temperamento) VALUES ('$idAnimal', '$temp')";
        $this->open($sqlTemperamento);
      }

      $sqlSociavel = "DELETE FROM sociavel_animal WHERE id_animal = '$idAnimal'";
      $this->open($sqlSociavel);
      foreach($sociavel as $soc){
        $sqlSociavel = "INSERT INTO sociavel_animal (id_animal, id_sociavel) VALUES ('$idAnimal', '$soc')";
        $this->open($sqlSociavel);
      }

      $sqlViveBem = "DELETE FROM vive_bem_animal WHERE id_animal = '$idAnimal'";
      $this->open($sqlViveBem);
      foreach($vive_bem as $vive){
        $sqlViveBem = "INSERT INTO vive_bem_animal (id_animal, id_vive_bem) VALUES ('$idAnimal', '$vive')";
        $this->open($sqlViveBem);
      }

      $sqlSaude = "DELETE FROM saude_animal WHERE id_animal = '$idAnimal'";
      $this->open($sqlSaude);
      foreach($saude as $sau){
        $sqlSaude = "INSERT INTO saude_animal (id_animal, id_saude) VALUES ('$idAnimal', '$sau')";
        $this->open($sqlSaude);
      }

      
      if($img_principal != '0' || $img_dois != '0' || $img_tres != '0') {
        $sqlGaleria = "INSERT INTO galeria (img_principal, img_dois, img_tres) VALUES ('$img_principal', '$img_dois', '$img_tres')";
        $this->open($sqlGaleria);
        $this->open("SELECT id_galeria FROM galeria WHERE img_principal = '$img_principal' AND img_dois = '$img_dois' AND img_tres = '$img_tres'");
        $idGaleria = $this->gs["ID_GALERIA"][0];

        $sqlGaleriaAnimal = "UPDATE galeria_animal SET id_galeria = '$idGaleria' WHERE id_animal = '$idAnimal'";
        $this->open($sqlGaleriaAnimal);
      }

     
      $sqlLocalizacaoAnimal = "UPDATE localizacao_animal SET id_localizacao = '$id_localizacao' WHERE id_animal = '$idAnimal'";
      $this->open($sqlLocalizacaoAnimal); 

      $sqlLocalAnimal = "UPDATE local_animal SET id_local = '$id_local' WHERE id_animal = '$idAnimal'";
      $this->open($sqlLocalAnimal);
       
       return 1;
    }

    public function incluirInteresse($idAnimal, $nome_pessoa, $cpf, $telefone, $celular, $email, $cep, $endereco, $bairro, $numero, $complemento,$ip_interessado, $aceite)
    {
      $sqlBuscaInteressado = "SELECT id_interessado FROM adoteDibea.interessado WHERE nome_pessoa = '$nome_pessoa' AND cpf = '$cpf'";

      $this->open($sqlBuscaInteressado);

      if(empty($this->gs["ID_INTERESSADO"][0])) {
        $sqlInteressado = "INSERT INTO adoteDibea.interessado (nome_pessoa, cpf, telefone, celular, email, cep, endereco, numero, complemento, bairro,ip_interessado, data_interessado, aceite) 
                        VALUES ('$nome_pessoa', '$cpf', '$telefone', '$celular', '$email', '$cep', '$endereco', '$numero', '$complemento', '$bairro','$ip_interessado', CURDATE(), '$aceite')";
        $this->open($sqlInteressado);
      } 

      $this->open($sqlBuscaInteressado);

      $id_interessado = $this->gs["ID_INTERESSADO"][0];

      $sqlBuscaInteresse = "SELECT id_animal FROM adoteDibea.interesse WHERE id_animal = $idAnimal AND id_interessado = $id_interessado";

      $this->open($sqlBuscaInteresse);

      if(empty($this->gs["ID_ANIMAL"][0])) {
        $sqlInteresse = "INSERT INTO adoteDibea.interesse (id_animal, id_interessado)
                      VALUES ($idAnimal, $id_interessado)";
        $this->open($sqlInteresse);
      }

      return 1;
    }

    function paginacao( 
      $total_artigos = 0, 
      $artigos_por_pagina = 10, 
      $offset = 5) {

      // Obtém os parâmetros
      global $parametros;
    
      // A URL da nossa home
      $url_site = 'http://www.pmf.sc.gov.br/sistemas/adote/index.php';
    
      // Obtém o número total de página
      $numero_de_paginas = floor( $total_artigos / $artigos_por_pagina );
    
      // Obtém a página atual
      $pagina_atual = 1;
    
      // Atualiza a página atual se tiver o parâmetro pagina/valor
      if ( 
        ( ! empty( $parametros[0] ) && $parametros[0] == 'pagina' ) &&
        ( ! empty( $parametros[1] ) )
      ) {
        $pagina_atual = (int)$parametros[1];
      }
    
      // Vamos preencher essa variável com a paginação
      $paginas = null;
    
      // Primeira página
      $paginas .= " <a href='$url_site/pagina/0'>Home</a> ";
    
      // Faz o loop da paginação
      // $pagina_atual - 1 da a possibilidade do usuário voltar
      for ( $i = ( $pagina_atual - 1 ); $i < ( $pagina_atual - 1 ) + $offset; $i++ ) {
        
        // Eliminamos a primeira página (que seria a home do site)
        if ( $i < $numero_de_paginas && $i > 0 ) {
            // A página atual
            $página = $i;
            
            // O estilo da página atual
            $estilo = null;
            
            // Verifica qual dos números é a página atual
            // E cria um estilo extremamente simples para diferenciar
            if ( $i == @$parametros[1] ) {
                $estilo = ' style="color:red;" ';
            }
            
            // Inclui os links na variável $paginas
            $paginas .= " <a $estilo href='$url_site/pagina/$página'>$página</a> ";
        }
        
      } // for
    
      $paginas .= " <a href='$url_site/pagina/$numero_de_paginas'>Última</a> ";
    
      // Retorna o que foi criado
      return $paginas;
    
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
  