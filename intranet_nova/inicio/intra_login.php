<div>
	<div id="caminho_migalhas">intranet</div>
	<div id="titulo_pagina">identifica&ccedil;&atilde;o do usu&aacute;rio</div>
	<div id="margem_direita">
	    <div class="box">
      		<form method="post">
					<input type="hidden"  name="btConn_x" id="btConn_x" value="open" />
                <div class="input-wrapper">
                    <label>Matricula:</label>
                    <input placeholder="Matrícula" name="login" id="login" type="text" />
                    <script type="text/javascript">
                        var login= new LiveValidation('login');
                        login.add(Validate.Presence, {failureMessage: "Obrigatorio"});
                    </script>
                </div>
                <div class="input-wrapper">
                    <label>Senha: </label>
                    <input placeholder="Senha" name="senha" id="senha" type="password" />
                    <script type="text/javascript">
                        var senha= new LiveValidation('senha');
                        senha.add(Validate.Presence, {failureMessage: "Obrigatorio"});
                    </script>
                </div>
                <div class="input-wrapper">
                <div class="g-recaptcha" data-sitekey="6Lf0zBsaAAAAAPaI0ZpJj9u79TjRkLJuOl_d8kr5"></div>
                </div>
                <div class="input-wrapper">
					<button type="submit" class="btn btn-sm btn-primary" name="button">ENTRAR</button>
                </div>
      		</form>
    	</div>
	</div>
</div>
<!--<script src='https://www.google.com/recaptcha/api.js' async defer></script>-->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer> </script>