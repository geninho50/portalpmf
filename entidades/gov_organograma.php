
      <div class="centro">
      <div id="caminho_migalhas">home &gt; </div>
      <div id="titulo_pagina">organograma</div>
      <div>
     
         <?php
           
		    $sql = "SELECT * FROM entidades WHERE entidade_id = $IdEntidade";
           
		    $result = $drive->pedido($sql);
           
		    $V_entidade = pg_fetch_object($result);   
			
	      ?>
     
    
     <div class="box_msg_baixo">Para conhecer a estrutura organizacional da <strong><?php echo $NomeEntidade; ?></strong>, clique sobre o link abaixo para fazer o download.</div>   
	        <div >
            
             <?php
			 
            if(isset($V_entidade->entidade_link_pdf) && !empty($V_entidade->entidade_link_pdf)){
				echo "<a href=\"../../arquivos/documentos/$V_entidade->entidade_link_pdf\"> 
				<img src=\"../../layout/imagens/entid_btn_download_grande.png\" border=\"0\"/></a>";
			} else {
			   echo "organograma não disponível";
			
			}
			 
			
		    ?>
           
            
                 
        
      </div>    	
	</div>
   </div><!-- fim coluna_C2 -->            
 
   
          

