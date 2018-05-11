{{-- Modal --}}
        @if(isset($rol) )
                @foreach($rol as $rol)

<div class="modal fade" id="VisualizarRoles_{{$rol->id_rol}}" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Visualizar Datos de la Unidad {{$rol->nom_rol}}</h3>
				</div>
				<div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">

									<div class="row">
							                <label>Nombre Rol:</label><br>
						                    {{$rol->nom_rol}}
							          

								    </div><!--fin col -->
								    <label>Modulos</label>

								    <div class="row">
										    @if(isset($mod) ) <!-- Verifico que existen modulos-->
												@foreach($mod as $modu)<!-- inicio foreach con alias-->
													<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					
														<label><i class="fa fa-check"></i>{{$modu->nom_mod}}</label><!--mando nombre -->

													</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
													 <!--Fin columna Modulos -->
												@endforeach
											@endif
									</div>
						         <!--  fin row-->
							</div>
						     <!-- box-body -->
					 </div>
					<!-- /.box-primary -->
				</div>
				<!-- /.Modalbody -->

				</div>
				<!-- Modalheader -->

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
					</div>
		</div>
		<!-- Modalcontent -->
	</div>
	<!-- Modaldiag -->
</div>
<!-- Modalfade -->

                @endforeach

@endif