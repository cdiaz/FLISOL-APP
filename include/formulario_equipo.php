<div id="formulario_equipo">
	<div class="widget">
		<div class="widget-header">
			<i class="icon-desktop"></i>
			<h3>Registrar Equipo</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content">

			<div class="row">

				<div class="span5">

					<form id="registrar_equipo_form" name="registrar_equipo_form" class="form-horizontal">
						<fieldset>  


							<!-- address-line2 input-->
							<div class="control-group">
								<label class="control-label">Propietario:</label>
								<div class="controls">
									<input type="hidden" name="persona" id="e10" style="width:300px"/>
								</div> 	
							</div>

							<!-- full-name input-->
							<div class="control-group">
								<label class="control-label">Tipo</label>
								<div class="controls">
									<select id="tipo_equipo" name="tipo" class="input-xlarge">
										<option value="" selected="selected">(Tipo de Equipo)</option>
										<option value="1">Escritorio</option>
										<option value="2">Portatil</option>                  
									</select>
									<p class="help-block"></p>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Marca</label>
								<div class="controls">
									<input id="marca" name="marca" type="text" placeholder="Marca" class="input-xlarge">
								</div>
							</div>

							<!-- address-line1 input-->
							<div class="control-group">
								<label class="control-label">Modelo:</label>
								<div class="controls">
									<input id="modelo" name="modelo" type="text" placeholder="Modelo" class="input-xlarge">
								</div>
							</div>
						</fieldset>
					</form>					
				</div> <!-- /widget-content -->



				<div class="span5">
					<ul class="messages_layout" id="comentarios_registro">						

					</ul>
					<input id="comentario_registro"/>
				</div> <!-- /span6 -->
			</div> <!-- /span6 -->
			<button data-flisol="registrarEquipo" class="btn btn-primary">Registrar</button>

		</div>
	</div>
</div>