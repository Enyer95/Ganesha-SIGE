

<form role="form" method="POST" action="{{ url('/config') }}">
    {{ csrf_field() }}

        <div class="col-md-9">
            El sistema no esta listo para usarse, por favor Ingrese los datos para la configuracion inicial del sistema
              <!-- /.form-group -->
        </div>
 	<div class="row">
		<div class="col-md-9">
            <div class="form-group">
             	<label>Cantidad máxima de secciones</label>
                <input type="number" min="4" name="secciones"  placeholder="4" class="form-control"  required autofocus>
                @if($errors->has('secciones'))
					<span style="color:red;">{{ $errors->first('secciones') }}</span>
				@endif
            </div>
            <div class="form-group">
             	<label>Cantidad máxima de unidades curriculares</label>
                <input type="number" min="4" name="unidades"  placeholder="4" class="form-control"  required autofocus>
                @if($errors->has('unidades'))
					<span style="color:red;">{{ $errors->first('unidades') }}</span>
				@endif
            </div>
            <div class="form-group">
             	<label>Periodo de tiempo para respaldos (meses)</label>
                <input type="number" min="1" max="3" name="respaldos"  placeholder="4" class="form-control"  required autofocus>
                @if($errors->has('respaldos'))
					<span style="color:red;">{{ $errors->first('respaldos') }}</span>
				@endif
            </div>
            <div class="form-group">
             	<label>Fecha de Culminación</label>
                <input type="date" placeholder="4" name="date" class="form-control date" required autofocus>
                @if($errors->has('secciones'))
					<span style="color:red;">{{ $errors->first('secciones') }}</span>
				@endif
            </div>
	          <!-- /.form-group -->
		</div>
		    <!-- /.form-group -->
        <!-- /.col -->
	</div><button type="submit" class="btn btn-primary">Guardar</button>
	</form>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">


              {{ csrf_field() }}
             <button type="submit" class="btn btn-primary"><i class="fa fa-power-off" ></i> Salir</button>

    </form>