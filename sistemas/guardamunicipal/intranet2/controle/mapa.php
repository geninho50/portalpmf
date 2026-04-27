<? 
$txtEndereco = $_GET['rua'];
$rua = $txtEndereco;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SIGA - Sistema de Gerenciamento Administrativo</title>

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />
        <link href="google/estilo.css" type="text/css" rel="stylesheet" />

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="google/jquery.min.js"></script>
        <script type="text/javascript" src="google/mapa.js"></script>
        <script type="text/javascript" src="google/jquery-ui.custom.min.js"></script>

    </head>
    
    <body>

        <div id="apresentacao">
            <form method="post" action="mapa.php">    
                <fieldset>

                    <legend>Google Maps API v3: Busca de endereço e Autocomplete - Demo</legend>    
            
                    <div class="campos">
                        <label for="txtEndereco">Endereco:</label>
                        <input type="text" id="txtEndereco" name="txtEndereco" value="<? echo $rua;?>" />
                        <input type="button" id="btnEndereco" name="btnEndereco" value="Mostrar no mapa" />
                    </div>

                    <div id="mapa"></div>

                </fieldset>
            </form>
        </div>
    
    </body>
</html>
