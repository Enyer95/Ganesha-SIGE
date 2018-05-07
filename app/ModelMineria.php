<?php

namespace GaneshaSIGE;

use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelInstrumento;
use GaneshaSIGE\ModelNota;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelSeccion;
use Illuminate\Database\Eloquent\Model;

class ModelMineria extends Model
{
  public static function discretizacion($cabeceras,$cantidad,$discretizacion){
		foreach ($cabeceras as $cabecera) {
			if ($cabecera == 'id_inst_eva') {
				$counIns = 1;
        $sumaIns = 0;

				foreach (ModelInstrumento::all() as $instrumento) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->id_inst_eva == $instrumento->id_inst) {
							$discretiza->id_inst_eva = $counIns;
              $sumaIns= $sumaIns + $discretiza->id_inst_eva;
						}
					}
					$counIns++;
				}
        $mediaIns = $sumaIns/$cantidad;
			}
			if ($cabecera == 'id_usu') {
				$counUse = 1;
        $sumaUse = 0;

				foreach (User::all() as $user) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->id_usu == $user->id) {
							$discretiza->id_usu = $counUse;
              $sumaUse= $sumaUse + $discretiza->id_usu;
						}
					}
					$counUse++;
				}
        $mediaUse = $sumaUse/$cantidad;
			}
			if ($cabecera == 'cod_seccion') {
				$counSec = 1;
        $sumaSec = 0;
				foreach (ModelSeccion::all() as $seccion) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->cod_seccion == $seccion->cod_sec) {
							$discretiza->cod_seccion = $counSec;
              $sumaSec= $sumaSec + $discretiza->cod_seccion;
						}
					}

          $counSec++;
				}
        $mediaSec = $sumaSec/$cantidad;
			}
			if ($cabecera == 'cod_unidad') {
        $sumaUni = 0;
				$counUni = 1;
				foreach (ModelUnidadCurricular::all() as $unidad) {
					foreach ($discretizacion as $discretiza) {
						if ($discretiza->cod_unidad == $unidad->cod_uc_pnf){
							$discretiza->cod_unidad = $counUni;
              $sumaUni= $sumaUni + $discretiza->cod_unidad;
						}
					}
					$counUni++;
				}
        $mediaUni = $sumaUni/$cantidad;
			}
      if ($cabecera == 'nota') {
        $sumaNot = 0;
          foreach ($discretizacion as $discretiza) {
              $sumaNot= $sumaNot + $discretiza->nota;
          }
        $mediaNota = $sumaNot/$cantidad;
      }
    }

    $datos= [$discretizacion ,$mediaIns, $mediaUse ,$mediaSec ,$mediaUni,$mediaNota];

    return $datos;
  }

  public static function normalizacion($cantidad,$valores,$cabeceras){
    $n=$cantidad-1;
    $sumaVarianzaUse = 0;
    $sumaVarianzaSec = 0;
    $sumaVarianzaIns = 0;
    $sumaVarianzaUni = 0;
    $sumaVarianzaNot = 0;
$valorIns=0;
      $valorUse=0;

      $valorSec=0;

      $valorUni=0;
$valorNot=0;
    foreach ($cabeceras as $cabecera) {
        if ($cabecera == 'id_inst_eva'){
          foreach ($valores[0] as $normaliza) {
               $valorIns=$normaliza->id_inst_eva-$valores[1];
               $sumaVarianzaIns = $sumaVarianzaIns +pow($valorIns,2);
             }
             foreach ($valores[0] as $normaliza) {
            $normaliza->id_inst_eva = $normaliza->id_inst_eva/sqrt($sumaVarianzaIns/$n);
        }  }
        if ($cabecera == 'id_usu'){
          foreach ($valores[0] as $normaliza) {
              $valorUse=$normaliza->id_usu-$valores[2];
              $sumaVarianzaUse = $sumaVarianzaUse +pow($valorUse,2);
          }
          foreach ($valores[0] as $normaliza) {
            $normaliza->id_usu = $normaliza->id_usu/sqrt($sumaVarianzaUse/$n);
          }
        }
        if ($cabecera == 'cod_seccion'){
            foreach ($valores[0] as $normaliza) {
                $valorSec=$normaliza->cod_seccion-$valores[3];
                $sumaVarianzaSec = $sumaVarianzaSec +pow($valorSec,2);
              }
              foreach ($valores[0] as $normaliza) {
            $normaliza->cod_seccion = $normaliza->cod_seccion/sqrt($sumaVarianzaSec/$n);
        }}
        if ($cabecera == 'cod_unidad'){
          foreach ($valores[0] as $normaliza) {
            $valorUni=$normaliza->cod_unidad-$valores[4];
            $sumaVarianzaUni = $sumaVarianzaUni +pow($valorUni,2);
          }
          foreach ($valores[0] as $normaliza) {
          $normaliza->cod_unidad = $normaliza->cod_unidad/sqrt($sumaVarianzaUni/$n);
          }
        }
        if ($cabecera == 'nota'){
          foreach ($valores[0] as $normaliza) {
    	        $valorNot=$normaliza->nota-$valores[5];
              $sumaVarianzaNot = $sumaVarianzaNot +pow($valorNot,2);
    			}
          foreach ($valores[0] as $normaliza) {
            $normaliza->nota = $normaliza->nota/sqrt($sumaVarianzaNot/$n);
          }
        }
		}

    return $valores[0];
  }
}
