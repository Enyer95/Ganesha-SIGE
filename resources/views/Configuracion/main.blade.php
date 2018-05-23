@extends('layouts.Principal')
@section('content')
<!-- Main content --><br><br><br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
    					<i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Ingrese la configuracion para poder usar Ganesha-SIGE"></i>
                            <h4 class="title">Configuracion Inicial</h4>
                        </div><!--fin card header-->
                        <div class="card-content">
                            @if ($status == 'Guardar')
                                @include('Configuracion.Guardar')
                            @endif
                            @if ($status == 'Actualizar')
                                @include('Configuracion.Actualizar')
                            @endif
                            @if ($status == 'No')
                                @include('Configuracion.User')
                            @endif
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
