<html>
<head>
    <meta charset="utf-8">
    <meta lang="pt-BR">
    <title> Calendário</title>
    
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script src='fullcalendar/lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
  
    <script type="text/javascript" src="beckend/calendario.js"></script>
    
    <!-- script de tradução -->
    <script src='fullcalendar/lang/pt-br.js'></script>
        
    <script>
    

      $(document).ready(function() {	
           	
            //CARREGA CALENDÁRIO E EVENTOS DO BANCO
            $('#calendario').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                eventLimit: true, 
                listDayFormat: false,
                navLinks: true,
                events: 'eventos.php',           
                eventColor: '#4169E1'
            });	
            


            //CADASTRA NOVO EVENTO
            $('#novo_evento').submit(function(){
                //serialize() junta todos os dados do form e deixa pronto pra ser enviado pelo ajax
                var dados = jQuery(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "cadastrar_evento.php",
                    data: dados,
                    success: function(data)
                    {   
                        if(data == "1"){
                            alert("Cadastrado com sucesso! ");
                            //atualiza a página!
                            location.reload();
                        }else{
                            alert("Houve algum problema.. ");
                        }
                    }
                });                
                return false;
            });	
	   }); 

                
    </script>
    
    <style>
        #calendario{
            position: relative;
            width: 70%;
            margin: 0px auto;
        }        
    </style>
    
</head>
<body>    
    <div id='calendario'>
        <br/>

          

        <form id="novo_evento" action="" method="post">
            Titulo: <input type="text" name="nome" required/><br/><br/>  
            Data da Reunião: <input type="date" name="start" placeholder="2017/01/20" required/><br/><br/>  
            Horário começo: <input type="datetime" name="hora" placeholder="00:00:00" required/><br/><br/>          
            Horário fim: <input type="datetime" name="hora2" placeholder="00:00:00" required/><br/><br/>   
            <button type="submit"> Reservar Horário </button>
        </form>



    </div>
</body>

<script>
$('#data').mask("2017/01/20");
$('#hora').mask("99:99:99");
</script>

</html>