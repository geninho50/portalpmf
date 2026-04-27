<?php
  
	
print 	'<!-- full Title -->
			<div class="full-title6">
				<div class="container">
					<!-- Page Heading/Breadcrumbs -->
					<h1 class="mt-4 mb-3">Contato</h1>
				</div>
			</div>

			<!-- Page Content -->
			<div class="container">
				<hr>
			  <!-- Contact Form -->
			  <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
			  <div class="row">
				<div class="col-lg-8 mb-4 contact-left">
				  <h3>Mande uma mensagem</h3>
				  <form name="sentMessage" id="contactForm" novalidate>
					<div class="control-group form-group">
					  <div class="controls">
						<label>Nome:</label>
						<input type="text" class="form-control" id="name" required data-validation-required-message="Por favor insira seu nome.">
						<p class="help-block"></p>
					  </div>
					</div>
					<div class="control-group form-group">
					  <div class="controls">
						<label>Telefone:</label>
						<input type="tel" class="form-control" id="phone" required data-validation-required-message="Por favor insira seu telefone.">
					  </div>
					</div>
					<div class="control-group form-group">
					  <div class="controls">
						<label>Email:</label>
						<input type="email" class="form-control" id="email" required data-validation-required-message="Por favor insira seu e-mail.">
					  </div>
					</div>
					<div class="control-group form-group">
					  <div class="controls">
						<label>Mensagem:</label>
						<textarea rows="5" cols="100" class="form-control" id="message" required data-validation-required-message="Por favor insira sua mensagem" maxlength="999" style="resize:none"></textarea>
					  </div>
					</div>
					<div id="success"></div>
					<!-- For success/fail messages -->
					<button type="submit" class="btn btn-primary" id="sendMessageButton">Enviar</button>
				  </form>
				</div>

			  </div>
			  <!-- /.row -->

			</div>
			<!-- /.container -->';
?>