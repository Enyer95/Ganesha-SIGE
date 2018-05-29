{{-- Modal --}}
<div class="modal fade" id="ModalClaves" role="dialog">
	<div class="modal-dialogs">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal">x</button>
				<div class="box-header with-border">
    			<i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Ingrese la Clave espacial que fue enviada a su correo para poder interactuar con el proceso deseado"></i>
					<h3 class="box-title">Ingrese su Clave</h3>
				</div>

            	<form role="form" method="POST" action="{{ url('/ScanQr') }}">
                    {{ csrf_field() }}

				    <div class="modal-body">
			         	<div class="row">
							<div class="col-md-12">
				                <div class="form-group">
									<center>
						                <label>Por favor Ingrese su Clave de GaneshaSIGE <br>para poder interactuar en el proceso de notas:
						                </label><br>

					                    <input type="text" class="form-control" name="pass" maxlength="15" minlength="4" required  style="width: 300px; border: 1px solid #c0c0c0; text-align: center;">

					                    <input type="text" id="route" class="hide" name="route">
					                    <label>Esta sera comparo con su codigo Qr el cual es el Siguiente:</label>
					                    <img  src='{{ url('/qr_image/'.Auth::User()->ci_usu.'.png') }}'>
									</center>
				                </div>
				            </div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="reset" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
		                <button type="submit" class="btn btn-primary">Verificar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

