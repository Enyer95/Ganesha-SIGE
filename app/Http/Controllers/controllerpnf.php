<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use GaneshaSIGE\ModelPnf;
class controllerpnf extends Controller
{
    public function Config(Request $request){
    	$pnf = ModelPnf::find(1);
    	$pnf->cant_secc = $request->secciones+1;
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

    public function configUpdate($value='')#get
    {
        return view('Configuracion.main')->with(['status'=> 'Actualizar', 'pnf' => ModelPnf::find(1)]);
    }

    public function configupdates(Request $request)#post
    {
        $pnf = ModelPnf::find(1);
        $pnf->cant_secc = $request->secciones-1;
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
