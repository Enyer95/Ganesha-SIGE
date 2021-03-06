@extends('layouts.app')
    @section('customcss')
  <link rel="stylesheet" href="{{ url('/datatables/jquery.dataTables.css') }}">

    @endsection
@section('content')

<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                            <div class="card-header" data-background-color="blue">
    <i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Gestion de estudiantes. Para ello tiene 2 opciones para ingresar los estudiantes, de forma manual o por listado<br>Para la segunda opcion descarge la plantilla y carge los estudiantes en ella.<br>para la Primera opcion Seleccione manual y comiense la carga"></i>
                                <h4 class="title">Gestion de Alumnos</h4>
                                <p class="category">Seleccion Secciones</p>
                            </div> <!--Fin card header-->
                            <br>
                            <div>
                            <ul>
                    <li><a target="_blank" href="{{ url('../docs/PLANTILLA_LISTADO.xlsx') }}">DESCARGAR PLANTILLA DE ALUMNOS</a></li>
                    </ul>
                              
                            </div>
                            @if(isset($validate))
                                @if($validate =='true')
                                {{-- Voy a actualizar --}}
                                  @if($tipo == 'Listado')
                                  {{-- Por listado --}}
                                    @include('Alumnos.Seleccion_unidades')
                                    @include('Alumnos.ActualizarListados')
                                  @else
                                  {{-- Manual --}}
                                    <section class="content-header">
                                      <ol class="breadcrumb">
                                        <li>
                                            <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                                Home
                                            </a>
                                        </li> 
                                        <li>
                                            <a href="{{ url('/alumnos/vista') }}"><i class="fa fa-dashboard"></i>
                                                Gestion de Alumnos
                                            </a>
                                        </li>
                                        <li class="active">
                                            Actualizar Alumnos 
                                        </li>
                                      </ol>
                                    </section><br>
                                    <div class="card-content table-responsive">
                        @include('flash::message')

                                    @include('Alumnos.ActualizarManual')
                                  @endif

                                @else
                                {{-- Voy a Agregar --}}
                                  @if($tipo == 'Listado')
                                  {{-- Por Listaddo --}}
                                    @include('Alumnos.Seleccion_unidades')
                                    @include('Alumnos.AgregarListados')
                                  @else
                                  {{-- Manual --}}
                                    <section class="content-header">
                                      <ol class="breadcrumb">
                                        <li>
                                            <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                                Home
                                            </a>
                                        </li> 
                                        <li>
                                            <a href="{{ url('/alumnos/vista') }}"><i class="fa fa-dashboard"></i>
                                                Gestion de Alumnos
                                            </a>
                                        </li>
                                        <li class="active">
                                            Agregar Alumnos 
                                        </li>
                                      </ol>
                                    </section><br>
                                    <div class="card-content table-responsive">
                        @include('flash::message')
                                    

                                    @include('Alumnos.Agregar_Manual')
                                  @endif
                                
                                @endif
                            

                                <!--fin col-->
                                
                            @else
                              <section class="content-header">
                                <ol class="breadcrumb">
                                  <li>
                                      <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                          Home
                                      </a>
                                  </li> 
                                  <li class="active">
                                      Gestion de Alumnos  
                                  </li>
                                </ol>
                              </section><br>
                              <div class="card-content table-responsive">
                        @include('flash::message')
                              
                            @include('Alumnos.Seleccion_unidades')
                            @endif
                   </div><!--card-->
                </div><!--col-->
            </div><!--row-->
        </div><!--container--> 
    </div><!--content--> 
</div><!--content--> 
@endsection
@section('customjs')

  <script>
var estuden;

//Activar modar a entrar a la pagina
    $(window).load(function(){
      @if(isset($validate))
        @if($validate =='true')
          $('#ActualizarListado{{$master2}}').modal('show');
        @else
          $('#AgregarListado{{$master2}}').modal('show');
        @endif
        
      @endif
    });
    </script>
@endsection
