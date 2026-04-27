function validar()
{
    var msg="";
     
    var tudo_ok=true;
     
    $("[obrigatorio=sim]").each(function(){
         
        msg="";     
         
        if( $(this).attr("type") == "radio"  )
        {
             
            if( $("input[name="+$(this).attr("name")+"]:checked")
            .length == 0 )
            {               
                msg = "O campo " + $(this).attr("rotulo") + " 
                é obrigatório";
            }
        }
        else
        if( $(this).attr("type") == "checkbox"  )
        {
             
            if( $("input[grupock="+$(this).attr("grupock")+"]
            :checked").length < $(this).attr("qde_min") )
            {               
                msg = "Pelo menos "+$(this).attr("qde_min")+" 
                opção(ões) do campo(s) " + $(this).attr("rotulo") 
                + " deve(m) ser marcado(s)!";
            }
        }
        else       
        if( $(this).val() == '' )
        {
            msg = 'O campo '+ $(this).attr("rotulo")+' é obrigatório !';        
        }
        else
        if( $(this).attr("tipo_dado") == "cpf" && 
        !validaCPF($(this).val()) )
        {
            msg = 'O campo '+ $(this).attr("rotulo")+' 
            deve ser válido !';     
        }       
        else
        if( $(this).attr("tipo_dado") == "data" && 
        !verificaData($(this).val()) )
        {
            msg = 'O campo '+ $(this).attr("rotulo")+' 
            deve ser uma data válida !';        
        }       
        else
        if( $(this).attr("tipo_dado") == "inteiro" && 
        !numInteiro($(this).val()) )
        {
            msg = 'O campo '+ $(this).attr("rotulo")+' 
            deve ser um numero inteiro válido !';       
        }       
        else
        if( $(this).attr("tipo_dado") == "real" && 
        !numReal($(this).val()) )
        {
            msg = 'O campo '+ $(this).attr("rotulo")+' 
            deve ser um numero real válido !';      
        }   
        else
        if( $(this).attr("tipo_dado") == "email" && 
        !ValidaEmail($(this).val()) )
        {
            msg = 'O campo '+ $(this).attr("rotulo")+' 
            deve ser um email válido !';        
        }   
 
        if( msg != '' )
        {
            tudo_ok = false;
        }
 
 
        if( $('#div_error_'+$(this).attr("name")) )
        {
            $('#div_error_'+$(this).attr("name")).html(msg);
        }
 
    }); 
     
    return tudo_ok;
     
}