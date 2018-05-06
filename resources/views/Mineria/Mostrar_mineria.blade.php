@extends('layouts.app')
    @section('customcss')
        <link rel="stylesheet" href="{{ url('/datatables/jquery.dataTables.css') }}">

    @endsection

@section('content')
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Mineria de Datos</h4>
                            <p class="category">Tablas de datos para la Mineria</p>
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
                            <div >
                                <label> Tabla Normal</label>
                                <table id="Normal" class="table table-bordered table-responsive">
                                    @if(isset($normal) )

                                        <thead>
                                            <th>id</th>
                                            @foreach($celdas as $c)
                                                <th>{{ $c }}</th>
                                            @endforeach
                                       </thead>
                                        <tbody>
                                            @foreach($normal as $val => $n)
                                                <tr>
                                                    <td>{{ $val }}</td>
                                                    @foreach($celdas as $c)
                                                        @if ($c == 'cod_seccion')
                                                            <td>
                                                                {{ $n-> cod_seccion}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'cod_unidad')
                                                            <td>
                                                                {{ $n-> cod_unidad}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'id_usu')
                                                            <td>
                                                                {{ $n-> id_usu}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'nota')
                                                            <td>
                                                                {{ $n-> nota}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'id_inst_eva')
                                                            <td>
                                                                {{ $n-> id_inst_eva}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table><br>
                                <label> Tabla Discretizada</label>
                                <table id="Discre" class="table table-bordered table-responsive">
                                    @if(isset($discretizacion) )

                                        <thead>
                                            <th>id</th>
                                            @foreach($celdas as $c)
                                                <th>{{ $c }}</th>
                                            @endforeach
                                       </thead>
                                        <tbody>
                                            @foreach($discretizacion as $val => $d)
                                                <tr>
                                                    <td>{{ $val }}</td>
                                                    @foreach($celdas as $c)
                                                        @if ($c == 'cod_seccion')
                                                            <td>
                                                                {{ $d-> cod_seccion}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'cod_unidad')
                                                            <td>
                                                                {{ $d-> cod_unidad}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'id_usu')
                                                            <td>
                                                                {{ $d-> id_usu}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'nota')
                                                            <td>
                                                                {{ $d-> nota}}
                                                            </td>
                                                        @endif
                                                        @if ($c == 'id_inst_eva')
                                                            <td>
                                                                {{ $d-> id_inst_eva}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div><!--card-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--container--> 
        </div><!--content--> 
    </div><!--content--> 
@endsection

@section('customjs')

<script src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
<script>
    $(document).ready(function(){
        var oTable=$('#Discre').DataTable({
        scrollY:        '30vh',
        scrollCollapse: true,
        paging:         false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Buscar Registro:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Docente",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos",
                        "lengthMenu": "Cantidad de Registros _MENU_"
                     },      

        });
        //oTable.fnDestroy();
        var oTable=$('#Normal').DataTable({
        scrollY:        '30vh',
        scrollCollapse: true,
        paging:         false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Buscar Registro:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Docente",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos",
                        "lengthMenu": "Cantidad de Registros _MENU_"
                     },      
        });
    });
</script>
@endsection