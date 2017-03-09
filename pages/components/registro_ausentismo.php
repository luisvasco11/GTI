
<form method="post" action="">
	<div class="row">
		<div class="col-md-12">

			<div class="box box-danger">
				<div class="box-header">
					<br>
					<h3 class="box-title">Registro de Ausentismo</h3>
					<br>
					<br>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Tipo de ausentismo</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-list-alt"></i>
							</div>
							<select id="ausentismo" name="ausentismo"
								class="form-control select2" style="width: 100%;" required>
								<option value="0"></option>
								<option value="1">Vacaciones</option>
								<option value="2">Permiso</option>
								<option value="3">Incapacidad</option>
								<option value="4">Evento corporativo</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Fecha y hora inicio</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input id="fecha_inicio" name="fecha_inicio" required value=""
								type="datetime-local" class="form-control" required>
						</div>
					</div>


					<div class="form-group">
						<label>Fecha y hora fin</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input id="fecha_fin" name="fecha_fin" type="datetime-local"
								class="form-control" required>
						</div>
					</div>

					<div class="form-group">
						<label>Comentario</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-commenting"></i>
							</div>
							<textarea id="comentario" name="comentario" class="form-control"
								required></textarea>
						</div>
					</div>
					<br>

					<button type="submit" class="btn btn-success" style="width: 150px;">Guardar</button>

					<a href="#"><button type="button" class="btn btn-danger"
							style="width: 150px;">Cancelar</button></a>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</form>