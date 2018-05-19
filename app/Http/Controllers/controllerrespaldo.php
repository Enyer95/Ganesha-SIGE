<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use BackupManager\Manager;
use GaneshaSIGE\ModelRespaldo;

class controllerrespaldo extends Controller
{

    public function viewRestore()
    {  
        return view('backup.restore');
    }
	public function respaldo()
	{
		if(ModelRespaldo::respaldo() != null){
            return redirect('/home')->with(['tipoMsj'=>'error','msj'=> 'Ocurrio un error en general el Backup, Comuniquese con el Administrador','titulo'=> 'Error']);
        }
        else {
        	return redirect('/home')->with(['tipoMsj'=>'success','msj'=> 'Su respaldo fue realizado con exito','titulo'=> 'Backup Generado']);
        
        }

	}
	public function restore(Request $request)
	{
		if(ModelRespaldo::restore($request->file('import_file')->getClientOriginalName())){
            return redirect('/home')->with(['tipoMsj'=>'error','msj'=> 'Ocurrio un error al restaurar el sistema, Comuniquese con el Administrador','titulo'=> 'Error']);
        }
        else {
        	return redirect('/home')->with(['tipoMsj'=>'success','msj'=> 'Respaldo realizado con exito','titulo'=> 'Backup Generado']);
        }
	}
}
