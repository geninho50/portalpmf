<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- ESSENCIAL PARA MOBILE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <title>Prefeitura Municipal de Florianópolis</title>
    <link rel="stylesheet" href="../../css/estilo_internet.css" type="text/css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

    <!-- Ajustes Responsivos para o Modal -->
    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #ffffff;
            box-sizing: border-box;
        }

        .modal-noticia-container {
            padding: 20px;
            max-width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        /* Imagem Destaque Responsiva */
        .caixa-imagem-destaque {
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .caixa-imagem-destaque img {
            width: 100% !important;
            height: auto !important;
            display: block;
            border-radius: 6px;
        }

        .caixa-imagem-rodape {
            font-size: 12px;
            color: #666;
            margin-top: 6px;
            word-break: break-word;
        }

        /* Títulos e Conteúdo */
        #titulo_pagina {
            font-size: 22px;
            line-height: 1.3;
            word-break: break-word;
        }

        #chamada_noticia {
            font-size: 15px;
            line-height: 1.4;
            color: #555;
            margin-bottom: 15px;
            word-break: break-word;
        }

        #conteudo_pagina p {
            font-size: 14px;
            line-height: 1.6;
            word-break: break-word;
        }

        /* Galerias e Listas */
        .secao-adicional ul {
            padding-left: 20px;
        }

        .secao-adicional li {
            margin-bottom: 10px;
            word-break: break-word;
        }

        /* Midia (Vídeos / Áudios / Embeds) */
        embed, object, iframe {
            max-width: 100% !important;
        }

        /* Ajustes específicos para telas até 768px (Mobile) */
        @media (max-width: 768px) {
            .modal-noticia-container {
                padding: 12px;
            }

            #titulo_pagina {
                font-size: 18px;
            }

            #chamada_noticia {
                font-size: 14px;
            }

            #conteudo_pagina p {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<div class="modal-noticia-container">
    <?php
    require_once("../../../scripts/php/funcoes.php");
    require_once("../../../scripts/php/funcoes_bd.php");
    $drive->conecta();

    if(isset($_GET['n'])){
        $TnoticiaId = (int)$_GET['n'];
        
        $sqlIdNoticia = "SELECT noti_entidade_id FROM noticias WHERE noti_id = " . $TnoticiaId;
        $rIdnoticia = $drive->pedido($sqlIdNoticia);
        $objIdNoticia = pg_fetch_object($rIdnoticia);
        $TentidadeId = $objIdNoticia->noti_entidade_id;

        $sqlNoticia = "SELECT * FROM noticias WHERE noti_id = " . $TnoticiaId . " AND noti_entidade_id = " . $TentidadeId;
        $sqlImagens = "SELECT IMG.*, NIMG.* FROM imagens AS IMG JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.nimg_img_id WHERE NIMG.nimg_noti_id = " . $TnoticiaId . " ORDER BY IMG.img_id DESC";
        $sqlArquivos = "SELECT ARQ.*, NARQ.* FROM arquivos AS ARQ JOIN noticias_arquivos AS NARQ ON ARQ.arq_id = NARQ.narq_arq_id WHERE NARQ.narq_noti_id = " . $TnoticiaId . " ORDER BY ARQ.arq_nome ASC";
        $sqlVideos = "SELECT MID.*, NMID.* FROM midia AS MID JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id WHERE NMID.nmidia_noti_id = " . $TnoticiaId . " AND NMID.nmidia_tipo = 0";
        $sqlAudios = "SELECT MID.*, NMID.* FROM midia AS MID JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id WHERE NMID.nmidia_noti_id = " . $TnoticiaId . " AND NMID.nmidia_tipo = 1";

        $resNoticia = $drive->pedido($sqlNoticia);
        $resImagem  = $drive->pedido($sqlImagens);
        $resArquivo = $drive->pedido($sqlArquivos);
        $resVideos  = $drive->pedido($sqlVideos);
        $resAudios  = $drive->pedido($sqlAudios);

        // Arrays para debug
        $debugImagens  = [];
        $debugArquivos = [];
        $debugVideos   = [];
        $debugAudios   = [];

        while($obj = pg_fetch_object($resNoticia)){
            $Ttexto  = $obj->noti_texto;
            $Ttitulo = $obj->noti_titulo;
            $Topoio  = $obj->noti_manchete;
        }

        // --- DEFINIÇÃO DA IMAGEM DE DESTAQUE ---
        $imgEscolhida = null;
        $primeiraEncontrada = null;

        while($obj = pg_fetch_object($resImagem)){
            if($primeiraEncontrada === null){
                $primeiraEncontrada = $obj;
            }
            if($obj->nimg_principal == 't'){
                $imgEscolhida = $obj;
            }
        }

        if($imgEscolhida === null){
            $imgEscolhida = $primeiraEncontrada;
        }

        if($imgEscolhida !== null){
            $caminhoFisico = "../../" . $imgEscolhida->img_link_v_media;
            if(!file_exists($caminhoFisico)){
                $caminhoFisico = $imgEscolhida->img_link_v_media;
            }

            $urlImagem = (!empty($imgEscolhida->img_link_v_media) && file_exists($caminhoFisico)) ? $caminhoFisico : "https://placehold.co/1140x500/f4f6f9/00a3e0?text=PMF";
            $legendaTexto = strip_tags($imgEscolhida->img_legenda);
            $autorTexto = !empty($imgEscolhida->img_autor) ? "<span class='caixa-imagem-autor'>/Foto: " . strip_tags($imgEscolhida->img_autor) . "</span>" : "";

            $TimgPrinc = '<div class="caixa-imagem-destaque"><img src="' . $urlImagem . '" alt="' . htmlspecialchars($legendaTexto) . '"/><div class="caixa-imagem-rodape">' . $legendaTexto . $autorTexto . '</div></div>';
        } else {
            $TimgPrinc = '<div class="caixa-imagem-destaque"><img src="https://placehold.co/1140x500/f4f6f9/00a3e0?text=PMF" alt="Prefeitura Municipal de Florianópolis"/><div class="caixa-imagem-rodape">Imagem institucional de divulgação.<span class="caixa-imagem-autor">/Foto: Ascom PMF</span></div></div>';
        }
        // --- FIM DO BLOCO DE IMAGEM ---

        $TgaleriaDoc = "";
        while($obj = pg_fetch_object($resArquivo)){
            $debugArquivos[] = $obj;
            $TgaleriaDoc .= "<li><a href='../../../" . $obj->arq_link . "'>" . $obj->narq_legenda . "</a></li>";
        }

        $width  = "100%";
        $height = "117";
        $player = "../../../scripts/php/videoPlayer";
        $TgaleriaVid = "";

        while($obj = pg_fetch_object($resVideos)){
            $debugVideos[] = $obj;
            $video = "http://portal.pmf.sc.gov.br/" . $obj->midia_link;
            $retorno = videoPlayer($video, $width, $height, $player);
            $TgaleriaVid .= "<li>" . $retorno . "<br/><div class='legenda-imagem'>" . strip_tags($obj->midia_legenda) . "</div></li>";
        }

        $width  = "100%";
        $height = "24";
        $player = "../../../scripts/php/audioPlayer";
        $TgaleriaAud = "";

        while($obj = pg_fetch_object($resAudios)){
            $debugAudios[] = $obj;
            $video = "http://portal.pmf.sc.gov.br/" . $obj->midia_link;
            $retorno = audioPlayer($video, $width, $height, $player);
            $TgaleriaAud .= "<li><strong>" . strip_tags($obj->midia_legenda) . "</strong><br/>" . $retorno . "</li>";
        }
    ?>

        <!-- BLOCO DE LOG NO NAVEGADOR -->
        <script type="text/javascript">
            console.log("=== DADOS DA NOTÍCIA ===");
            console.log("ID da Notícia:", <?= json_encode($TnoticiaId) ?>);
            console.log("Título:", <?= json_encode($Ttitulo) ?>);
            console.log("Imagens retornadas do Banco:", <?= json_encode($debugImagens) ?>);
            console.log("Imagem Destaque Escolhida:", <?= json_encode($imgEscolhida) ?>);
            console.log("Arquivos:", <?= json_encode($debugArquivos) ?>);
            console.log("Vídeos:", <?= json_encode($debugVideos) ?>);
            console.log("Áudios:", <?= json_encode($debugAudios) ?>);
            console.log("========================");
        </script>

        <div class="categoria-noticia">Notícias</div>
        <div id="caminho_migalhas">home &gt; notícias</div>
        <h1 id="titulo_pagina"><?= html_entity_decode($Ttitulo) ?></h1>
        <div id="chamada_noticia"><?= html_entity_decode($Topoio) ?></div>

        <div id="conteudo_pagina">
            <?php
                echo $TimgPrinc;
                echo "<p>" . nl2br($Ttexto) . "</p>";
            ?>

            <?php if(!empty($TgaleriaDoc)): ?>
                <div id="arquivos" class="secao-adicional">
                    <h1>Arquivos para Download</h1>
                    <ul><?= $TgaleriaDoc ?></ul>
                </div>
            <?php endif; ?>

            <?php if(!empty($TgaleriaVid)): ?>
                <div id="videos" class="secao-adicional">
                    <h1>Galeria de Vídeos</h1>
                    <ul><?= $TgaleriaVid ?></ul>
                </div>
            <?php endif; ?>

            <?php if(!empty($TgaleriaAud)): ?>
                <div id="audios" class="secao-adicional">
                    <h1>Relação de Áudios</h1>
                    <ul><?= $TgaleriaAud ?></ul>
                </div>
            <?php endif; ?>
        </div>

    <?php } ?>
</div>

</body>
</html>