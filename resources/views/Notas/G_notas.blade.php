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
    <i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Gestione las notas de las evaluaciones por unidad curricular que tiene a su cargo<br>-Para interactuar con las notas de una evaluacion presione 'Verificar' y sera enviado a ingresar notas si estas no han sido cargadas<br>De ser el caso contrario sera enviado a modificar las misma<br>-Para enviar las notas de la evaluacion precione el boton 'Publicar notas' y estas seran enviadas a los estudiantes que cursan la unidad curricular en esta seccion"></i>
                            <h4 class="title">Gestion de Notas</h4>
                            <p class="category">Lista de Unidades Curriculares por seccion</p>
                        </div><!--fin card header-->

                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li> 
                            <li class="active">
                                Gestion de Notas 
                            </li>
                          </ol>
                        </section><br>
                        
                        <div class="card-content">
                        @include('flash::message')
                            <div class="col-md-offset-11">
                               
                            </div><br><!--fin colcard-->
                            @include('Notas.listarnotassec')
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
@section('customjs')

@endsection
