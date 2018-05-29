<?php

namespace GaneshaSIGE\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;


class VerificarPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       #dd(\Request::route()->getName());
      

        if (\Auth::user()->status == TRUE) {

            foreach (\Auth::user()->roles as $rol) {
            
                if($rol->tieneModulo(\Request::route()->getName())){
                    return $next($request);
                }

                else{

                    return back()->with(['tipoMsj'=>'error','msj'=> '<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>','titulo'=> 'Acceso Negado']);;
                }
            }
        }
        else{

          
                    return redirect('edit/perfil/')->with(['tipoMsj'=>'error','msj'=> 'Para usar el sistema, debes actualizar tu contraseña. Por favor actualiza tu perfil','titulo'=> 'Acceso Negado']);

        }

    }
}
