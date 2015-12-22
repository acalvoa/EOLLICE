<div class="modal fade" id="login">
  <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
  <div class="modal-dialog" style="width:400px; margin-top:70px;" id="logincap">
    <div class="modal-content">
      <div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Ingresa a Eollice</h3>
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" role="form">
		        <fieldset>
		    	  	<div class="form-group">
		    		    <input class="form-control" placeholder="E-mail" name="email" type="text" id="email-data">
		    		</div>
		    		<div class="form-group">
		    			<input class="form-control" placeholder="Contraseña" name="password" type="password" value="" id="password-data" >
		    		</div>
		    		<div class="checkbox" style="margin-bottom:20px;">
		    	    	<label>
		    	    		<input name="remember" type="checkbox" value="true" id="remember-data"> Recuerdame
		    	    	</label>
		    	    </div>
		    		<input class="btn btn-lg btn-success btn-block" type="button" value="Ingresar" style="margin-bottom:20px;" id="btn-login-final" data-loading-text="Cargando...">
		    		<h6 class="recover-password-btn" style="cursor:pointer;">¿Olvidaste tu contraseña?</h6>
		    	</fieldset>
		    		<hr>
		    		<h6><b>¿No tienes una cuenta aún?</b></h6>
		    		<input class="btn btn-lg btn-primary btn-block" type="button" value="Registrarse" style="margin-top:20px;" id="btn-registro">
		      	</form>
		    </div>
		</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <div class="modal-dialog" style="width:500px; margin-top:70px; display:none;" id="regcap">
    <div class="modal-content">
      <div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Regístrate en Eollice</h3>
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" role="form">
		        <fieldset>
		        	<div class="form-group">
		    		    <input class="form-control" placeholder="Nombre" name="name" type="text" id="name-reg-data">
		    		</div>
		    	  	<div class="form-group">
		    		    <input class="form-control" placeholder="E-mail" name="email" type="text" id="email-reg-data">
		    		</div>
		    		<div class="form-group">
		    			<input class="form-control" placeholder="Contraseña" name="repeatpassword" type="password" value="" id="password-reg-data">
		    		</div>
		    		<div class="form-group">
		    			<input class="form-control" placeholder="Repite tu Contraseña" name="password" type="password" value="" id="repeat-password-reg-data">
		    		</div>
		    		<input class="btn btn-lg btn-primary btn-block" type="button" value="Registrate en Eollice" style="margin-top:20px;" id="btn-registro-final" data-loading-text="Cargando...">
		    	</fieldset>
		    		<hr>
		    		<h6><b>¿Ya tienes una cuenta?</b></h6>
		    		<input class="btn btn-lg btn-success btn-block" type="button" value="Ingresar" style="margin-top:20px;" id="btn-login">
		      	</form>
		    </div>
		</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <div class="modal-dialog" style="width:450px; margin-top:70px; display:none;" id="recoverpasscap">
    <div class="modal-content">
      <div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Recupera tu contraseña</h3>
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" role="form">
		        <fieldset>
		        	<h6 style="margin-bottom:25px;"><b>Ingresa la direccion de E-Mail con la que te registraste.</b></h6>
		    	  	<div class="form-group">
		    		    <input class="form-control" placeholder="E-mail" name="email" type="text" id="email-forgot-data">
		    		</div>
		    		<input class="btn btn-lg btn-success btn-block" type="button" value="Recuperar Contraseña" style="margin-top:20px;" id="btn-forgot-final" data-loading-text="Cargando...">
		    	</fieldset>
		    		<hr>
		    		<h6><b>¿No tienes una cuenta aun?</b></h6>
		    		<input class="btn btn-lg btn-primary btn-block" type="button" value="Registrarse" style="margin-top:20px;" id="btn-registro-recover">
		      	</form>
		    </div>
		</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <div class="modal-dialog" style="width:450px; margin-top:100px; display:none;" id="recover-final-cap">
    <div class="modal-content">
      <div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Recupera tu contraseña</h3>
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" role="form">
		        <fieldset>
		        	<h6 style="margin-bottom:25px;"><b>Ingresa tu nueva contraseña..</b></h6>
		    	  	<div class="form-group">
		    		    <input class="form-control" placeholder="Contraseña" name="password" type="password" id="password-forgot-data">
		    		</div>
		    		<div class="form-group">
		    		    <input class="form-control" placeholder="Repetir Contraseña" name="password" type="password" id="repeat-password-forgot-data">
		    		</div>
		    		<input class="btn btn-lg btn-success btn-block" type="button" value="Recuperar Contraseña" style="margin-top:20px;" id="btn-recover-final" data-loading-text="Cargando...">
		    	</fieldset>
		      	</form>
		    </div>
		</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div>
</div><!-- /.modal -->