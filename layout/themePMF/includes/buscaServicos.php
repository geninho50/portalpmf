<?php
    if(isset($_GET['term'])){

        session_start();

        require_once($_SERVER['DOCUMENT_ROOT']."/scripts/php/funcoes_bd.php");

        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
            "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
            "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "ѝ", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
            "ь", "ѝ", "ю", "ѝ"
         );
         $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "À", "Ý", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Ý", "Î", "Ý",
            "Ý", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "Н", "Б", "В", "Г", "Д", "Е", "Н", "Ж",
            "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
            "Ь", "Э", "Ю", "Я"
        );

        $convert_from_sql = array (
            "Ý", "Ã", "À", "Â",
            "É", "È", "Ê",
            "Ý", "Ì", "Î",
            "Ó", "Õ", "Ò", "Ô",
            "Ú", "Ù", "Û",
            "á", "ã", "à", "â",
            "é", "è", "ê",
            "í", "ì", "î",
            "ó", "õ", "ò", "ô",
            "ú", "ù", "û",
            "Ç", "ç",
            ";", "-", ",", "/", "+"
        );

        $convert_to_sql = array (
            "a", "a", "a", "a",
            "e", "e", "e",
            "i", "i", "i",
            "o", "o", "o", "o",
            "u", "u", "u",
            "a", "a", "a", "a",
            "e", "e", "e",
            "i", "i", "i",
            "o", "o", "o", "o",
            "u", "u", "u",
            "c", "c",
            " ", " ", " ", " ", " "
        );

        $search = (string)$_GET['term'];
        $term = str_replace($convert_from_sql, $convert_to_sql, $search);

        $drive->conecta();
        $sqlAll = "SELECT * FROM servicos WHERE serv_status <> 'f'";
        $resultAll = $drive->pedido($sqlAll);
        $matchIds = array();
        while($obj = pg_fetch_object($resultAll)) {
          $servName = utf8_encode(str_replace($convert_from_sql, $convert_to_sql, html_entity_decode($obj->serv_nome)));
          $servPalavraChave = utf8_encode(str_replace($convert_from_sql, $convert_to_sql, html_entity_decode($obj->serv_palavra_chave)));
          $servId = utf8_encode(str_replace($convert_from_sql, $convert_to_sql, html_entity_decode($obj->serv_id)));
          if (stripos($servName, $term) !== false || stripos($servPalavraChave, $term) !== false || strrpos($servId, $term) !== false) {
              $matchIds[] = $obj->serv_id;
          }
        }
        $response = array();
        $matchIdsSql = implode(",",$matchIds);
        $sql = " SELECT
        serv_nome AS nome,
        serv_descricao AS descricao,
        serv_id AS id,
        serv_link AS link,
        serv_abrir_interno AS interno,
        serv_acessos
        FROM servicos WHERE serv_status <> 'f'
        AND serv_id in ($matchIdsSql)
        ORDER BY serv_acessos DESC";
        $result = $drive->pedido($sql);
        while($obj = pg_fetch_object($result)) {
          $response[] = (object) array(
            "link" => $obj->link,
            "interno" => $obj->interno,
            "id" => $obj->id,
            "label" => $obj->id." - ". str_replace($convert_from, $convert_to, html_entity_decode($obj->nome))
          );
        }

        header('Content-Type: application/json');
        echo json_encode($response);

      } else {
        $getTwoServices = "SELECT * FROM servicos WHERE servicos.serv_status = 't' AND servicos.serv_acessos <> 0 ORDER BY serv_acessos DESC LIMIT 2";
        $result = $drive->pedido($getTwoServices);
        $obj = pg_fetch_object($result);

        if($obj->serv_abrir_interno == 1){
          $link = "/servicos/index.php?pagina=servpagina&id=$obj->serv_id";
        } else {
          $link = $obj->serv_link;
        }

        $servicos = "<a href=\"$link\">$obj->serv_nome</a> ou ";
        $obj = pg_fetch_object($result);
        
        if($obj->serv_abrir_interno == 1){
          $link = "/servicos/index.php?pagina=servpagina&id=$obj->serv_id";
        } else {
          $link = $obj->serv_link;
        }
        $servicos .= "<a href=\"$link\">$obj->serv_nome</a>";

    if( !isset( $hasColumns ) ){
         $hasColumns = false;
    }

    if($hasColumns) { ?>
        <div class="flex-container column8-lg column8-md">
    <?php } ?>
          <div id="busca-home" class="search-bar <?php echo $class ?> column6-lg column8-sm column8-xs">
            <h1 class="hidden-sm hidden-xs"><?php echo $buscaServicoTitle ?></h1>
            <form method="post" action="/servicos/index.php?pagina=servbusca&menu=2"  class="search-bar__auto-complete">
                <input name="txtbusca" id="autocomplete" type="text" class="busca-home-field" placeholder="Digite o serviço desejado" />
                <button type="submit" name="button" class="btn-lg btn-primary"><span class="hidden-sm hidden-xs">Buscar</span><i class="fa fa-search hidden-lg" aria-hidden="true"></i></button>
            </form>
            <span class="search-bar__footer">Busque pelo nome do serviço, como <?=$servicos?> </a></span>
  
          </div>
        <?php if($hasColumns) { ?>
        </div>
    <?php } ?>

<?php } ?>