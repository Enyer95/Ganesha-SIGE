<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection as Collection;
use GaneshaSIGE\ModelMineria;
class controllermineria extends Controller
{
	public function mineria()
	{
		return view('Mineria/Agregar_mineria');
	}

	public function queryMineria($query)
	{
		$results = \DB::select('SELECT '.$query);
		return count($results);
	}

	public function minaValores(Request $request)
	{
		$cabeceras=explode(',', $request->celdas);
		$cantidad=$request->maximo-$request->minimo;
		
		$results = DB::select('SELECT '.$request->newQuery.' OFFSET '.$request->minimo.' ROWS FETCH NEXT '.$cantidad.' ROWS ONLY;');
		
		$discretizacion = ModelMineria::discretizacion($cabeceras,$cantidad,ModelMineria::arrayCopy($results));
		
		foreach ($discretizacion as $key) {
			$datosDiscretizados[] = $key;
		}
		$datosDiscretizados[0] = ModelMineria::arrayCopy($discretizacion[0]);

		$normalizacion = ModelMineria::normalizacion($cantidad,$datosDiscretizados,$cabeceras);

		foreach ($datosDiscretizados[0] as $key) {
			$dato[]=array_flatten(collect($key)->toArray());
		}

		$centroides=ModelMineria::kMeans($dato, $request->centroides)['centroides'];

		#dd($centroides);

		return view('Mineria/Mostrar_mineria')->with(['discretizacion' => $discretizacion[0],'normal'=>$results,'normalizacion'=>$normalizacion,'celdas'=>$cabeceras,'centroides'=>$centroides]);

	}
}
