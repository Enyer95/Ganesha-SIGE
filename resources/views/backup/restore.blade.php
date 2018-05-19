@extends('layouts.app')
@section('content')
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
    					<i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Seleccione el archivo que contiene el Backup"></i>
                            <h4 class="title">Gestion de  Respaldo</h4>
                            <p class="category">Cargar Respaldo</p>
                        </div><!--fin card header-->
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                Respaldo
                            </li>
                          </ol>

                        </section><hr>
                        <div class="card-content">

							<form method="POST"  action="{{ url('/restore') }}" class="formulario_archivo" enctype="multipart/form-data" >
                        {{ csrf_field() }}
									<input name="import_file"type="file"   class="archivo form-control"  required/><br><br>
						        <div class="box-footer">
			                        <button type="submit" class="btn btn-primary btn-xs pull-right">Cargar Backup</button> 
			                        <a href="{{ url('/alumnos/vista') }}">
										<button type="button" class="btn btn-primary btn-xs"">Cancelar</button>
									</a>
							    </div>
							</form>
                        </div>
                        <!-- /#ion-icons -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </div>


   @endsection
