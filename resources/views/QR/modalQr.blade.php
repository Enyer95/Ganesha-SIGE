{{-- Modal --}}
<div class="modal fade" id="ModalQR" role="dialog">
	<div class="modal-dialogs">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Ingrese Text a codificar</h3>
				</div>
            	<form role="form" method="POST" action="{{ url('/QrGenerador') }}">
                    {{ csrf_field() }}
				    <div class="modal-body">
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">
									<div class="col-md-5">
						                <div class="form-group">
							                <label>Texto a codificar</label>
						                    <input type="text" class="form-control" name="text" maxlength="15" minlength="4" required  style="width: 300px;">
						                </div>
						            </div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="reset" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
		                <button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

