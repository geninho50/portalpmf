</li>
<!-- Hotjar Tracking Code for www.pmf.sc.gov.br -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:499772,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<script>

  /*
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');
*/

</script>
<script src="/layout/themePMF/js/slick.min.js"></script>

<?php
  $minJs = "/layout/themePMF/js/main.min.js";
  if (file_exists(CAMINHO_SITE.$minJs)){
    echo "<script src=\"$minJs\"></script>";
  }
 ?>

<div id="rodape">
  <div class="info">
    <div class="info-column">
      <div class="info-block">
        <h4>Notícias</h4>
        <ul>
        <li><a href="https://www.pmf.sc.gov.br/governo/index.php?pagina=govdiariooficial">Diário oficial</a></li>          
          <li><a href="https://<?php echo($urlHost);?>/noticias/index.php">Todas as notícias</a></li>
          <li><a href="https://<?php echo($urlHost);?>/midia/index.php">Mídia</a></li>
		  <li><a href="https://www.pmf.sc.gov.br/radio/" target="_blank" alt="Facebook">Rádio</a>
		</li>
        </ul>
      </div>
      <div class="info-block">
        <h4>Servidor</h4>
        <ul>
          <li><a href="https://<?php echo($urlHost);?>/sites/portaldoservidor">Portal do servidor</a></li>
          <li><a href="https://<?php echo($urlHost);?>/intranet/index.php">Intranet</a></li>
          <li><a href="https://www.pmf.sc.gov.br/email.html" target="_blank">Webmail</a></li>
          <!-- <li><a href="https://webmail.pmf.sc.gov.br/" target="_blank">Webmail</a></li> -->
          
        </ul>
      </div>
    </div>

    <div class="info-column">
      <div class="info-block">
        <h4>Sobre a PMF</h4>
        <ul>
          <li><a href="https://<?php echo($urlHost);?>/governo/index.php?pagina=govestrutura">Estrutura organizacional</a></li>
          <li><a href="https://contatos.pmf.sc.gov.br/">Contatos</a></li>
          <li><a href="https://<?php echo($urlHost);?>/entidades/smg/index.php?cms=pro+cidadao&menu=0">Pró-cidadão</a></li>
          <li><a href="https://www.leismunicipais.com.br/prefeitura/sc/florianopolis/">Leis municipais</a></li>
          <li><a href="https://transparencia.e-publica.net/epublica-portal/#/florianopolis/portal?entidade=2002">Transparência</a></li>
          <li><a href="https://<?php echo($urlHost);?>/ouvidoria/index.php">Ouvidoria PMF</a></li>
          <li><a href="https://<?php echo($urlHost);?>/ouvidoria/index.php?pagina=ouv_encarregadoDados&menu=1">Encarregado de Dados</a></li>
          <li><a href="https://<?php echo($urlHost);?>/governo/index.php?pagina=goveditais">Editais</a></li>
        </ul>
      </div>
      <div class="info-block">
        <ul>
       <!--   <li><a href="https://<?php echo($urlHost);?>">Pol&Iacute;tica de privacidade  </a></li> -->
          <li><a href="https://<?php echo($urlHost);?>/mapa.php">Mapa de Navega&ccedil;&atilde;o  </a></li>
        </ul>
      </div>
    </div>

    <div class="info-column">
      <div class="info-block">
        <h4>Serviços</h4>
        <ul>
          <li><a href="https://<?php echo($urlHost);?>/servicos/index.php?pagina=servonline">Todos os serviços</a></li>
          <!-- <li><a href="/servicos/index.php?pagina=servpagina&acao=open&id=3770">Processos eletrônicos</a></li> -->
          <li><a href="http://geo.pmf.sc.gov.br/">Geoprocessamento</a></li>
          <li><a href="https://<?php echo($urlHost);?>/servicos/index.php?pagina=servpagina&id=260">Coleta de lixo</a></li>
          <li><a href="https://<?php echo($urlHost);?>/servicos/index.php?pagina=onibus">Horário de ônibus</a></li>
          <li><a href="https://pmf.pergamum.com.br">Biblioteca SME</a></li>
          <li><a href="https://www.pmf.sc.gov.br/entidades/turismo/index.php?cms=calendario+de+eventos+em+florianopolis+2021&menu=0">Calendário Oficial</a></li>
          
        </ul>
      </div>
      <hr class="visible-sm">
      <div class="info-block">
        <h4>Siga-nos</h4>
        <a href="https://www.facebook.com/prefeituradeflorianopolis/" target="_blank"><i class="fa fa-facebook-official"></i></a>
        <a href="https://www.instagram.com/prefflorianopolis/" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU" target="_blank"><i class="fa fa-youtube-play"></i></a>
        <a href="https://twitter.com/scflorianopolis" target="_blank" alt="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
      </div>
    </div>
</div>

  </div>