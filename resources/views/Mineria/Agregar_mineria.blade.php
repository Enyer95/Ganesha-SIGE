@extends('layouts.app')
    @section('customcss')

    @endsection

@section('content')
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Mineria de Datos</h4>
                            <p class="category">Seleccionar datos para la Mineria</p>
                        </div> <!--Fin card header-->
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                Crear Mineria
                            </li>
                          </ol>
                        </section><br><hr>

                        <div class="card-content">

                          <form action="{{ url('/minaValores') }}" method="POST" role="form" class="form-horizontal form-simple">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-10" id="divFiltrado">
                                        <input type="hidden" name="newQuery" id="newQuery">
                                        <input type="hidden" name="celdas" id="celdas">
                                        <label> Candidad de Registros seleccionados <div id="divCantidad"></div></label>
                                        <div class="form-group col-md-12">
                                            <label for="TipoEvaluacion">
                                              Tipo de Evaluacion
                                            </label>
                                            <input type="checkbox" id="mevaluacions" onClick="query(this)" name="evaluacion" value="mevaluacions.id_inst_eva"><!--mando id -->
                                            <br>
                                            <label for="Nota">
                                              Nota
                                            </label>
                                            <input type="checkbox" id="mnotas" onClick="query(this)" name="nota" value="mnotas.nota"><!--mando id -->
                                            <br>
                                            <label for="Docente">
                                              Docente
                                            </label>
                                            <input type="checkbox" id="mpuentemasters" onClick="query(this)" name="docente" value="mpuentemasters.id_usu"><!--mando id -->
                                            <br>
                                            <label for="Seccion">
                                              Seccion
                                            </label>
                                            <input type="checkbox" id="mpuentemasters" onClick="query(this)" name="seccion" value="mpuentemasters.cod_seccion"><!--mando id -->
                                            <br>
                                            <label for="uni_crr">
                                              Unidad curricular
                                            </label>
                                            <input type="checkbox" id="mpuentemasters" onClick="query(this)" name="uni_crr" value="mpuentemasters.cod_unidad">
                                            <br>
                                            <label for="uni_crr">
                                              Inserte Rango
                                            </label> <br>
                                            <input type="number" min="0" id="minimo" name="minimo" required>
                                                hasta
                                            <input type="number" min="0" id="maximo" name="maximo" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions ">
                                <button type="submit" class="btn btn-primary offset-md-10">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div>
                        </form>
                        </div><!--card-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--container-->
        </div><!--content-->
    </div><!--content-->
@endsection

@section('customjs')
    @include('Mineria.js')

@endsection
