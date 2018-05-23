
<form id="logout-form" action="{{ route('logout') }}" method="POST">

 	<div class="row">
		<div class="col-md-9">
            El sistema no esta listo para usarse, por favor comuniquese con su administrador
	          <!-- /.form-group -->
		</div>

              {{ csrf_field() }}
             <button type="submit" class="btn btn-primary"><i class="fa fa-power-off" ></i> Salir</button>
        <!-- /.col -->
	</div>
</form>
