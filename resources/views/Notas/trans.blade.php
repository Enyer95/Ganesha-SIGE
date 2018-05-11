@extends('layouts.app')
@section('customcss')
  <link rel="stylesheet" href="{{ url('/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ url('/datatables/extensions/Buttons-1.3.1/css/buttons.dataTables.min.css') }}">

@endsection
@section('content')
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
    <i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Seleccione el Formato por el cual desea exportar las notas"></i>
  
                            <h4 class="title">Transcribir Notas</h4>
                            <p class="category">Lista Estudiantes</p>
                        </div><!--fin card header-->
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li> 
                            <li>
                                <a href="{{ url('/Notas/Transcripcion') }}"><i class="fa fa-dashboard"></i>
                                    Transcribir Notas
                                </a>
                            </li>
                          </ol>
                        </section><br>
                        <div class="card-content table-responsive">
                            <br>
                            @include('Notas.datatabletranscripcion')
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

<script src="{{ url('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('/datatables/extensions/Buttons-1.3.1/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/datatables/extensions/Buttons-1.3.1/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ url('/datatables/extensions/Buttons-1.3.1/js/buttons.flash.min.js') }}"></script>
<script src="{{ url('/datatables/extensions/Buttons-1.3.1/js/buttons.html5.js') }}"></script>
<script src="{{ url('/datatables/extensions/Buttons-1.3.1/js/buttons.print.min.js') }}"></script>
<script>



    $(document).ready(function(){
        $('#Notas').DataTable({
                    "paging": false,

            dom: 'Bfrtip',
        buttons: [
            'excel', 'copy', 'csv',  'pdf', 'print'
        ]    
        });
    });

    $(window).load(function hola(){
@if($a == 0)
        alert('No tiene notas agregadas a esta Evaluacion');
          window.location="/Notas/Transcripcion";

    @endif
    });
</script>    
@endsection