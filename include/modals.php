<!-- Modal Registrar persona-->
<div id="registrar_persona" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Registrar Persona</h3>
  </div>
  <div class="modal-body">

   <form id="registrar_persona_form" name="registrar_persona_form" class="form-horizontal">
    <fieldset>  
      <!-- full-name input-->
      <div class="control-group">
        <label class="control-label">Identificacion</label>
        <div class="controls">
          <input id="documento" name="documento" type="text" placeholder="Numero de identificación"
          class="input-xlarge">
          <p class="help-block"></p>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Tipo de documento</label>
        <div class="controls">
          <select id="tipo_documento" name="tipo_documento" class="input-xlarge">
            <option value="" selected="selected">(Tipo de documento)</option>
            <option value="1">Cedula</option>
            <option value="2">Tarjeta de identidad</option>
            <option value="3">Licencia de conducción</option>
            <option value="4">Carnét Estudiantil</option>                      
          </select>
        </div>
      </div>

      <!-- address-line1 input-->
      <div class="control-group">
        <label class="control-label">Nombre:</label>
        <div class="controls">
          <input id="nombre" name="nombre" type="text" placeholder="Nombre"
          class="input-xlarge">
        </div>
      </div>
      <!-- address-line2 input-->
      <div class="control-group">
        <label class="control-label">Telefono:</label>
        <div class="controls">
          <input id="telefono" name="telefono" type="text" placeholder="telefono"
          class="input-xlarge">
        </div>
      </div>
      <!-- city input-->
      <div class="control-group">
        <label class="control-label">Email</label>
        <div class="controls">
          <input id="email" name="email" type="email" placeholder="email" class="input-xlarge">
          <p class="help-block"></p>
        </div>
      </div>           


    </fieldset>
  </form>


</div>
<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  <button data-flisol="registrarPersona" class="btn btn-primary">Registrar</button>
</div>
</div>




 <!-- Modal Enviar Equipo-->
<div id="enviar_equipo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Enviar Equipo</h3>
  </div>
  <div class="modal-body">
      <form id="enviar_equipo_form" name="registrar_equipo_form" class="form-horizontal">
            <fieldset>  


              <!-- address-line2 input-->
              <div class="control-group">
                <label class="control-label">Equipo:</label>
                <div class="controls">
                  <input type="hidden" name="equipo" id="e11" style="width:300px"/>
                </div>  
              </div>

                   <div class="control-group">
                <label class="control-label">Transportador:</label>
                <div class="controls">
                  <input type="hidden" name="transportador" id="e12" style="width:300px"/>
                </div>  
              </div>

            </fieldset>
          </form>   
  </div>
  <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
      <button class="btn btn-primary">Enviar</button>
  </div>
</div>

 <!-- Modal Entregar Equipo-->
<div id="entregar_equipo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Entregar Equipo</h3>
  </div>
  <div class="modal-body">
      <p>One fine body…</p>
  </div>
  <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
      <button class="btn btn-primary">Entregar</button>
  </div>
</div>