<!-- Modal -->
<div class="modal fade" id="user-data-modal" data-backdrop="static">
  <div class="modal-dialog" style="width:800px;">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title modal-confirm-title">Completa tu Perfil</h4>
      </div>
      <div class="modal-body modal-message-user">
        Para continuar con las operaciones de inversión es necesario que completes tu perfil de usuario. Esta información será utilizada en las operaciones de facturación.<br><br>
        <div class="form-group has-feedback no-padding-top">
          <label class="control-label" for="namecompleto-data-input">Nombre Completo</label>
          <input type="text" class="form-control user-complete-data" placeholder="Nombre Completo" id="namecompleto-data-input">
        </div>
        <div class="row visible-lg visible-md">
          <div class="col-md-6 col-lg-6">
            <div class="form-group user-data-input has-feedback no-padding-top">
            <label class="control-label" for="father_name-data-input">Apellido Paterno</label>
              <input type="text" class="form-control user-complete-data" placeholder="Apellido" id="father_name-data-input">
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="form-group user-data-input has-feedback no-padding-top">
            <label class="control-label" for="mother_name-data-input">Apellido Materno</label>
              <input type="text" class="form-control user-complete-data" placeholder="Apellido" id="mother_name-data-input">
            </div>
          </div>
        </div>
        <div class="form-group user-data-input has-feedback no-padding-top">
        <label class="control-label" for="rut-data-input">Rut</label>
          <input type="text" class="form-control user-complete-data" placeholder="Rut" id="rut-data-input">
        </div>
        <div class="form-group user-data-input has-feedback no-padding-top">
          <label class="control-label" for="telefono-data-input">Telefono de Contacto</label>
          <input type="text" class="form-control user-complete-data" placeholder="Telefono" id="telefono-data-input">
        </div>
        <div class="row visible-lg visible-md">
          <div class="col-md-6 col-lg-8">
            <div class="form-group user-data-input has-feedback no-padding-top">
              <label class="control-label" for="domicilio-data-input">Calle de Domicilio</label>
              <input type="text" class="form-control user-complete-data" placeholder="Calle" id="domicilio-data-input">
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="form-group user-data-input has-feedback no-padding-top">
            <label class="control-label" for="numero-data-input">Número</label>
              <input type="text" class="form-control user-complete-data" placeholder="Numero Domicilio" id="numero-data-input">
            </div>
          </div>
        </div>
        <div class="row visible-lg visible-md">
          <div class="col-md-6 col-lg-6">
            <div class="form-group user-data-input has-feedback no-padding-top">
              <label class="control-label" for="depto-data-input">Depto.</label>
              <input type="text" class="form-control user-complete-data" placeholder="Numero de Depto." id="depto-data-input">
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="form-group user-data-input has-feedback no-padding-top">
            <label class="control-label" for="edificio-data-input">Edificio/Condominio</label>
              <input type="text" class="form-control user-complete-data" placeholder="Nombre Edificio/Condominio" id="edificio-data-input">
            </div>
          </div>
        </div>
        <div class="row visible-lg visible-md">
          <div class="col-md-6 col-lg-6">
            <div class="form-group user-data-input has-feedback no-padding-top">
              <label class="control-label" for="comuna-data-input">Comuna de Domicilio</label>
              <input type="text" class="form-control user-complete-data" placeholder="Comuna" id="comuna-data-input">
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="form-group user-data-input has-feedback no-padding-top">
              <label class="control-label" for="domicilio-data-input">Ciudad de Domicilio</label>
              <input type="text" class="form-control user-complete-data" placeholder="Ciudad" id="ciudad-data-input">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer confirm-footer">
        <button type="button" id="modal-confirm-user-btn" class="btn btn-success">Confirmar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="bank-data-modal">
  <div class="modal-dialog" style="width:800px;">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title modal-confirm-title-bank">Agregar Cuenta Bancaria</h4>
      </div>
      <div class="modal-body modal-message-bank"> 
        En estas cuentas recibiras el pago de tus inversiones.<br><br>
        <div class="form-group has-feedback">
          <label class="control-label" for="banco-data-input">Banco</label>
          <select class="form-control bank-complete-data" id="banco-data-input">
            <option value="default">Elegir Banco</option>
          <?php 
              $db = new db_core();
              $consulta[0] = $db->select("listado_bancos","*");
              while($consulta[1] = mysql_fetch_array($consulta[0])){
                echo '<option value="'.utf8_encode($consulta[1]['id_banco']).'">'.utf8_encode($consulta[1]['nombre']).'</option>';
              }
          ?>
          </select>
        </div>
        <div class="form-group user-data-input has-feedback ">
          <label class="control-label" for="tipo-bank-data-input">Tipo de Cuenta</label>
          <select class="form-control bank-complete-data" id="tipo-bank-data-input">
            <option value="Cuenta Corriente">Cuenta Corriente</option>
            <option value="Cuenta Vista">Cuenta Vista</option>
          </select>
        </div>
        <div class="form-group user-data-input has-feedback">
          <label class="control-label" for="numero-bank-data-input">Numero de Cuenta</label>
          <input type="text" class="form-control bank-complete-data" placeholder="N° Cuenta" id="numero-bank-data-input">
        </div>
      </div>
      <div class="modal-footer confirm-footer">
        <input type="hidden" class="form-control" id="mod-data-bank" value="false">
        <button type="button" id="modal-confirm-bank-btn" class="btn btn-success">Confirmar</button>
        <button type="button" id="modal-confirm-close" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->