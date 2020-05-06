<form id="form_pago" class="was-validated">
	<div id="modal_pago" class="modal hidden-print " role="dialog" >
		
		<div class="modal-dialog ">
			<!-- Modal content -->
			<div class="modal-content">
				<!-- "Modal Header" -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Datos de Pago</h4>
				</div>
				
				<!-- "Modal Body" -->
				<div class="modal-body">
					
					<div class="row">
						<div class="col-sm-6 text-right">
							<label class="lead"> Forma de Pago:</label>
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="forma_pago" name="forma_pago" >
								<option value="efectivo">Efectivo</option>
								<option value="tarjeta">Tarjeta</option>
								<option value="mixto">Mixto</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 text-right">
							<label class="lead"> Total Venta:</label>
						</div>
						<div class="col-sm-4">
							<input readonly id="subtotal" value="0" type="number" class="form-control lead text-right" name="subtotal">
						</div>
					</div>
					
					
					<div class="well" id="div_efectivo">
						<div class="row">
							<div class="col-sm-6 text-right">
								<label class="lead"> <i class="fas fa-cash"></i> Efectivo:</label>
							</div>
							<div class="col-sm-4">
								<input readonly id="efectivo" min="0" value="0" type="number" class="lead form-control text-right" name="efectivo">
							</div>
						</div>
						<div class="row text-right">
							<div class="col-sm-6">
								<label class="lead">Se Recibe: </label>
							</div>
							<div class="col-sm-4">
								<input id="pago" step=".5" type="number" class="valor form-control text-right" name="pago">
							</div>
						</div>
						<div class="cambio row text-right">
							<div class="col-sm-6">
								<label class="lead">Cambio: </label>
							</div>
							<div class="col-sm-4">
								<input readonly id="cambio" value="0" min="0" type="number" class="form-control text-right" name="cambio">
							</div>
						</div>
					</div>
					
					
					<div class="well hidden"  id="div_tarjeta">
						<div class="row">
							<div class="col-sm-6 text-right">
								<label class="lead"> Tipo de Tarjeta:</label>
							</div>
							<div class="col-sm-6">
								<div class="radios_tarjeta ">
									<div class="form-check form-check-inline">
										<input required checked class="form-check-input tipo_tarjeta" value=".025" type="radio" name="tipo_tarjeta" id="debito">
										<label class="form-check-label"  for="debito">Débito</label>
									</div>
									<div class="form-check form-check-inline">
										<input required class="form-check-input tipo_tarjeta"  value=".03" type="radio" name="tipo_tarjeta" id="credito">
										<label class="form-check-label" for="credito">Crédito</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row  text-right">
							<div class="col-sm-6">
								<label class="lead">Comisión: </label>
							</div>
							<div class="col-sm-4">
								<input readonly id="comision" value="0" type="number" class="valor form-control" name="comision">
							</div>
						</div>
						
						<div class="row  text-right">
							<div class="col-sm-6">
								<label class="lead">Cobrar en Terminal: </label>
							</div>
							<div class="col-sm-4">
								<input readonly id="tarjeta" value="0" type="number" class="valor form-control" name="tarjeta" min="0">
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- "Modal Footer" -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cancelar
					</button>
					<button type="button" id="imprimir" class="btn btn-info">
						<i class="fa fa-print"></i> Cobrar e Imprimir
					</button>
					<button type="submit" id="cobrar" class="btn btn-success">
						<i class="fa fa-dollar-sign"></i> Solo Cobrar
					</button>
				</div>
			</div>
		</div>
		
	</div>
</div>
</form>					