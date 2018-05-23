<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use GaneshaSIGE\ModelPnf;
class controllerpnf extends Controller
{
    public function Config(Request $request){
    	$pnf = ModelPnf::find(1);
    	$pnf->cant_secc = $request->secciones;
    	$pnf->cant_uni = $request->unidades;
    	$pnf->tiempo_respaldo = $request->respaldos;
    	$pnf->fecha_final = $request->date;
    	$pnf->enabled = true;

    	if ($pnf->save()) {
    		return redirect('home');		
    	}
    	else{
    		return redirect('home');		
    	}
    }
}
