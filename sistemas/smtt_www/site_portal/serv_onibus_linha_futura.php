<script type="text/javascript">

function stAba(menu,conteudo){
		this.menu = menu;
		this.conteudo = conteudo;
}

var arAbas = new Array();
arAbas[0] = new stAba('aba_horaida','conteudo_horaida');
arAbas[1] = new stAba('aba_horavolta','conteudo_horavolta');
arAbas[2] = new stAba('aba_itinerario','conteudo_itinerario');


function AlternarAbas(menu,conteudo){
	for (i=0;i<arAbas.length;i++){
		document.getElementById(arAbas[i].menu).className = 'aba_serv';
		document.getElementById(arAbas[i].conteudo).style.display = 'none';
	}
	document.getElementById(menu).className = 'aba_sel';
	document.getElementById(conteudo).style.display = 'inline';
}

</script>

<div class="centro">
     <div id="caminho_migalhas">home &gt; serviços</div>
     <div id="titulo_noticia">
      <h1>Nome da Linha (234)</h1>
      <p>Empresa: Nome da Empresa</p>
     </div>

    
     <div>        
       
     <br>
     
     
     <div id="descricao_linha">
     
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
               <strong>Tarifa Cartão:</strong> R$2,20<br />
           <strong>Tarifa Dinheiro:</strong>  R$2,80<br />

            <strong>Tempo do Percurso:</strong> 00:32<br />
            <strong>Extensão Ida:</strong> 18,5 Km<br />
            <strong>Extensão Volta:</strong> 18,3 Km
    
    </td>
    <td><div align="center"><img src="../layout/imagens/serv_btn_onibus_mudanca.png" align="absmiddle" /> <br>
      <b>a partir de 17/11/2009</b>
    </div></td>
  </tr>
</table>
     
     
     <br><br>
      


     <div class="painel_abas">
     <div id="aba_horaida" class="aba_sel" onClick="AlternarAbas('aba_horaida','conteudo_horaida')"><span>horários ida</span></div>
     <div id="aba_horavolta" class="aba_serv" onClick="AlternarAbas('aba_horavolta','conteudo_horavolta')"><span>horários volta</span></div>
     <div id="aba_itinerario" class="aba_serv" onClick="AlternarAbas('aba_itinerario','conteudo_itinerario')"><span>itinerário</span></div>
     </div><!-- fim painel_abas --> 
     
     
      <div class="conteudo_abas_ext">  
      
      <div id="conteudo_horaida" style="display:inline">
      
         <b><img src="../layout/imagens/serv_marcador.png" width="15" height="16" align="absmiddle" /> Barra Da Lagoa >> TILAG</b><br><br>
 
<table border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <th scope="col">2ª a 6ª</th>
    <th scope="col">Sábados</th>
    <th scope="col">Domingos</th>
  </tr>
  <tr>
    <td valign="top">05:14 <br />
      05:55<br />
      06:13 D <br />
      06:30<br />
      06:45 <br />
      06:59 D<br />
      07:11 S <br />
      07:29<br />
      07:53 TS <br />
      07:55 D<br />
      08:19 S <br />
      08:49 D<br />
      09:10 TB <br />
      09:25<br />
      09:55 D <br />
      10:20<br />
      10:52 <br />
      11:17 S<br />
      11:40 <br />
      11:47<br />
      12:03 <br />
      12:11 S<br />
      12:30 <br />
      12:35<br />
      12:55 D <br />
      13:10 TB<br />
      13:20 <br />
      13:23 D<br />
      13:45 <br />
      14:00 TB<br />
      14:17 <br />
      14:40 TB<br />
      14:49 <br />
      15:10 TB<br />
      15:17 <br />
      15:44<br />
      16:12 D <br />
      16:40<br />
      17:08 <br />
      17:36 D<br />
      18:04 <br />
      18:10 TB<br />
      18:25 <br />
      18:37<br />
      19:00 <br />
      19:15<br />
      19:36 D <br />
      20:13<br />
      20:27 <br />
      20:48 D<br />
      20:55 <br />
      21:24<br />
      22:08 <br />
      22:30<br />
      22:55 <br />
      23:14<br />
      23:38 <br />
      00:10</td>
    <td valign="top">
    <p>05:20 <br />
      06:00<br />
      06:24 <br />
      06:46<br />
      07:08 <br />
      07:29<br />
      07:51 <br />
      08:15<br />
      08:35 <br />
      08:57<br />
      09:21 <br />
      09:45<br />
      10:10 <br />
      10:33<br />
      10:57 <br />
      11:21<br />
      11:45 <br />
      12:09<br />
      12:30 <br />
      12:55<br />
      13:19 <br />
      13:43<br />
      14:06 <br />
      14:30<br />
      14:55 <br />
      15:19<br />
      15:44 <br />
      16:07<br />
      16:30 <br />
      16:55<br />
      17:17 <br />
      17:44<br />
      18:07 <br />
      18:30<br />
      18:55 <br />
      19:38<br />
      20:08 <br />
      20:42<br />
      21:10 <br />
      21:50<br />
      22:10 <br />
      23:10<br />
      23:28 <br />
      00:27</p></td>
    <td valign="top">05:20 <br />
      06:00<br />
      06:20 <br />
      06:50<br />
      07:20 <br />
      07:50<br />
      08:20 <br />
      08:50<br />
      09:20 <br />
      09:50<br />
      10:20 <br />
      10:50<br />
      11:20 <br />
      11:50<br />
      12:20 <br />
      12:50<br />
      13:20 <br />
      13:50<br />
      14:20 <br />
      14:50<br />
      15:20 <br />
      15:50<br />
      16:10 <br />
      16:30<br />
      16:50 <br />
      17:20<br />
      17:40 <br />
      18:00<br />
      18:20 <br />
      18:50<br />
      19:15 <br />
      19:45<br />
      20:20 <br />
      20:50<br />
      21:20 <br />
      21:50<br />
      22:30 <br />
      23:20</td>
  </tr>
</table>
      
      </div><!-- fim conteudo_horaida -->
            
            
    <div id="conteudo_horavolta" style="display:none">
      

<b><img src="../layout/imagens/serv_marcador.png" width="15" height="16" align="absmiddle" /> TILAG >> Barra da Lagoa</b><br><br>
 
<table border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <th scope="col">2ª a 6ª</th>
    <th scope="col">Sábados</th>
    <th scope="col">Domingos</th>
  </tr>
  <tr>
    <td valign="top">05:14 <br />
      05:55<br />
      06:13 D <br />
      06:30<br />
      06:45 <br />
      06:59 D<br />
      07:11 S <br />
      07:29<br />
      07:53 TS <br />
      07:55 D<br />
      08:19 S <br />
      08:49 D<br />
      09:10 TB <br />
      09:25<br />
      09:55 D <br />
      10:20<br />
      10:52 <br />
      11:17 S<br />
      11:40 <br />
      11:47<br />
      12:03 <br />
      12:11 S<br />
      12:30 <br />
      12:35<br />
      12:55 D <br />
      13:10 TB<br />
      13:20 <br />
      13:23 D<br />
      13:45 <br />
      14:00 TB<br />
      14:17 <br />
      14:40 TB<br />
      14:49 <br />
      15:10 TB<br />
      15:17 <br />
      15:44<br />
      16:12 D <br />
      16:40<br />
      17:08 <br />
      17:36 D<br />
      18:04 <br />
      18:10 TB<br />
      18:25 <br />
      18:37<br />
      19:00 <br />
      19:15<br />
      19:36 D <br />
      20:13<br />
      20:27 <br />
      20:48 D<br />
      20:55 <br />
      21:24<br />
      22:08 <br />
      22:30<br />
      22:55 <br />
      23:14<br />
      23:38 <br />
      00:10</td>
    <td valign="top">
    <p>05:20 <br />
      06:00<br />
      06:24 <br />
      06:46<br />
      07:08 <br />
      07:29<br />
      07:51 <br />
      08:15<br />
      08:35 <br />
      08:57<br />
      09:21 <br />
      09:45<br />
      10:10 <br />
      10:33<br />
      10:57 <br />
      11:21<br />
      11:45 <br />
      12:09<br />
      12:30 <br />
      12:55<br />
      13:19 <br />
      13:43<br />
      14:06 <br />
      14:30<br />
      14:55 <br />
      15:19<br />
      15:44 <br />
      16:07<br />
      16:30 <br />
      16:55<br />
      17:17 <br />
      17:44<br />
      18:07 <br />
      18:30<br />
      18:55 <br />
      19:38<br />
      20:08 <br />
      20:42<br />
      21:10 <br />
      21:50<br />
      22:10 <br />
      23:10<br />
      23:28 <br />
      00:27</p></td>
    <td valign="top">05:20 <br />
      06:00<br />
      06:20 <br />
      06:50<br />
      07:20 <br />
      07:50<br />
      08:20 <br />
      08:50<br />
      09:20 <br />
      09:50<br />
      10:20 <br />
      10:50<br />
      11:20 <br />
      11:50<br />
      12:20 <br />
      12:50<br />
      13:20 <br />
      13:50<br />
      14:20 <br />
      14:50<br />
      15:20 <br />
      15:50<br />
      16:10 <br />
      16:30<br />
      16:50 <br />
      17:20<br />
      17:40 <br />
      18:00<br />
      18:20 <br />
      18:50<br />
      19:15 <br />
      19:45<br />
      20:20 <br />
      20:50<br />
      21:20 <br />
      21:50<br />
      22:30 <br />
      23:20</td>
  </tr>
</table>
      
      </div><!-- fim conteudo_horavolta --> 
      
      
      <div id="conteudo_itinerario" style="display:none">
 
            <b><img src="../layout/imagens/serv_marcador.png" width="15" height="16" align="absmiddle" /> IDA:  Barra da Lagoa >> TILAG</b><br>                                           
           <div class="result_busca_servicos_onibus">
                TISAN
           </div>
           <div class="result_busca_servicos_onibus">
                RUA PE. LOURENÇO RODRIGUES DE ANDRADE
           </div>
           <div class="result_busca_servicos_onibus">
                RUA CÔNEGA SERPA
           </div>
           <div class="result_busca_servicos_onibus">
                RUA PROF. ALCIDES GOULART
           </div>
           <div class="result_busca_servicos_onibus">
                RUA QUINZE DE NOVEMBRO
           </div>
           <div class="result_busca_servicos_onibus">
                RUA PROF. OSNI BARBATO
           </div>
           <div class="result_busca_servicos_onibus">
                EST. CAMINHO DOS AÇORES
           </div>
           <div class="result_busca_servicos_onibus">
                EST. HAROLDO SOAES GLAVAN
           </div>
           <div class="result_busca_servicos_onibus">
                SC 401
           </div>
           <div class="result_busca_servicos_onibus">
                AV. DA SAUDADE
           </div>
           <div class="result_busca_servicos_onibus">
                AV. PROF. HENRIQUE AS SILVA FONTES
           </div>
           <div class="result_busca_servicos_onibus">
                TITRI
           </div>
           
           <BR><BR>
          <b><img src="../layout/imagens/serv_marcador.png" width="15" height="16" align="absmiddle" /> VOLTA: TILAG >> Barra da Lagoa</b><br>            
           
           <div class="result_busca_servicos_onibus">
              TITRI  
           </div>
           <div class="result_busca_servicos_onibus">
              AV. PROF. HENRIQUE DA SILVA FONTES  
           </div>
           <div class="result_busca_servicos_onibus">
              AV. DA SAUDADE  
           </div>
           <div class="result_busca_servicos_onibus">
              SC 401  
           </div>
           <div class="result_busca_servicos_onibus">
              EST. HAROLDO SOARES GLAVAN  
           </div>
           <div class="result_busca_servicos_onibus">
              EST. CAMINHO DOS AÇORES  
           </div>
           <div class="result_busca_servicos_onibus">
              RUA CÔNEGO SERPA  
           </div>
           <div class="result_busca_servicos_onibus">
              RUA PE. LOURENÇO RODRIGUES DE ANDRADE  
           </div>
           <div class="result_busca_servicos_onibus">
              TISAN  
           </div>
           
                 
      
      </div><!-- fim conteudo_itinerario --> 

      
      </div><!-- fim conteudo_abas_ext -->     
          
 
         
         
       
          
  </div>
   </div><!-- fim coluna_C2 -->   
   