<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection as Collection;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelInstrumento;
use GaneshaSIGE\ModelNota;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelSeccion;

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
		$inicia = $request->minimo;
		$cantidad=$request->maximo-$inicia;
		$results = DB::select('SELECT '.$request->newQuery.' OFFSET '.$inicia.' ROWS FETCH NEXT '.$cantidad.' ROWS ONLY;');

		$discretizacion = DB::select('SELECT '.$request->newQuery.' OFFSET '.$inicia.' ROWS FETCH NEXT '.$cantidad.' ROWS ONLY;');
		$cantidadCabeceras = count($cabeceras);
		foreach ($cabeceras as $cabecera) {
			if ($cabecera == 'id_inst_eva') {
				$instrumentos = ModelInstrumento::all();
				$counIns = 1;
				foreach ($instrumentos as $instrumento) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->id_inst_eva == $instrumento->id_inst) {
							$discretiza->id_inst_eva = $counIns;
						}
					}
					$counIns=$counIns+1;	
				}
			}
			if ($cabecera == 'id_usu') {
				$counUse = 1;
				$users = User::all();
				foreach ($users as $user) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->id_usu == $user->id) {
							$discretiza->id_usu = $counUse;
						}
					}
					$counUse=$counUse+1;
				}
			}
			if ($cabecera == 'cod_seccion') {
				$counSec = 1;
				$secciones = ModelSeccion::all();
				foreach ($secciones as $seccione) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->cod_seccion == $seccione->cod_sec) {
							$discretiza->cod_seccion = $counSec;
						}
					}
					$counSec=$counSec+1;
				}
			}
			if ($cabecera == 'cod_unidad') {
				$counUni = 1;
				$unidades = ModelUnidadCurricular::all();
				foreach ($unidades as $unidad) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->cod_unidad == $unidad->cod_uc_pnf){
							$discretiza->cod_unidad = $counUni;
						}
					}
					$counUni=$counUni+1;
				}
			} 
		}
        return view('Mineria/Mostrar_mineria')->with(['discretizacion' => $discretizacion,'normal'=>$results,'celdas'=>$cabeceras]);

	}
}
