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
      /*
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
			}if ($cabecera == 'id_usu') {
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
			}*/
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

    #$datos= [$discretizacion ,$mediaIns, $mediaUse ,$mediaSec ,$mediaUni,$mediaNota];

    return $discretizacion;
  }

  public static function discre($cabeceras,$cantidad,$discretizacion){
    $mediaIns= 0;
$mediaUse= 0;
$mediaSec= 0;
$mediaUni= 0;
$mediaNota= 0;
      
    foreach ($cabeceras as $cabecera) {
      if ($cabecera == 'id_inst_eva') {
        $sumaIns = 0;
        foreach ($discretizacion as $discretiza) {
          $sumaIns= $sumaIns + $discretiza->id_inst_eva;
        }
        $mediaIns = $sumaIns/$cantidad;
      } 
      if ($cabecera == 'id_usu') {
          $sumaUse = 0;
          foreach ($discretizacion as $discretiza) {
            $sumaUse= $sumaUse + $discretiza->id_usu;
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

    return   ModelMineria::normalizacion($cantidad,$datos,$cabeceras);;
  }
  public static function normalizacion($cantidad,$valores,$cabeceras){

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
            if (sqrt($sumaVarianzaIns/$cantidad) == 0) {
              $normaliza->id_inst_eva = 0;
            }
            else{
              $normaliza->id_inst_eva = number_format(($normaliza->id_inst_eva-$valores[1])/sqrt($sumaVarianzaIns/$cantidad),2,'.','');
              if ($normaliza->id_inst_eva < 0) {
                $normaliza->id_inst_eva = $normaliza->id_inst_eva * (-1);
              }
            }
          }  
        }
        if ($cabecera == 'id_usu'){
          foreach ($valores[0] as $normaliza) {
              #$valorUse=$normaliza->id_usu-$valores[2];
              $sumaVarianzaUse += pow($normaliza->id_usu-$valores[2],2);
          }

          $varianzaUsu=sqrt($sumaVarianzaUse/$cantidad);

          foreach ($valores[0] as $normaliza) {
            if ($varianzaUsu == 0) {
              $normaliza->id_usu = 0;
            }
            else{
             # echo $normaliza->id_usu.'----'.$valores[2].'------'.$varianzaUsu.'=    ';
              $normaliza->id_usu = number_format(($normaliza->id_usu-$valores[2])/$varianzaUsu,2,'.','');
              if ($normaliza->id_usu < 0) {
                $normaliza->id_usu = $normaliza->id_usu * (-1);
              }
              #echo $normaliza->id_usu.'<br>';
            }
          }
          #dd($sumaVarianzaUse);
        }
        if ($cabecera == 'cod_seccion'){
          foreach ($valores[0] as $normaliza) {
            $valorSec=$normaliza->cod_seccion-$valores[3];
            $sumaVarianzaSec = $sumaVarianzaSec +pow($valorSec,2);
          }
          foreach ($valores[0] as $normaliza) {
            if (sqrt($sumaVarianzaSec/$cantidad) == 0) {
              $normaliza->cod_seccion = 0;
            }
            else{
              $normaliza->cod_seccion = number_format(($normaliza->cod_seccion-$valores[3])/sqrt($sumaVarianzaSec/$cantidad),2,'.','');
              if ($normaliza->cod_seccion < 0) {
                $normaliza->cod_seccion = $normaliza->cod_seccion * (-1);
              }
            }
          }
        }
        if ($cabecera == 'cod_unidad'){
          foreach ($valores[0] as $normaliza) {
            $valorUni=$normaliza->cod_unidad-$valores[4];
            $sumaVarianzaUni = $sumaVarianzaUni +pow($valorUni,2);
          }
          foreach ($valores[0] as $normaliza) {
            if (sqrt($sumaVarianzaUni/$cantidad) == 0) {
              $normaliza->cod_unidad = 0;
            }
            else{
              $normaliza->cod_unidad = number_format(($normaliza->cod_unidad-$valores[4])/sqrt($sumaVarianzaUni/$cantidad),2,'.','');
              if ($normaliza->cod_unidad < 0) {
                $normaliza->cod_unidad = $normaliza->cod_unidad * (-1);
              }
            }
          }
        }
        if ($cabecera == 'nota'){
          foreach ($valores[0] as $normaliza) {
    	        $valorNot=$normaliza->nota-$valores[5];
              $sumaVarianzaNot = $sumaVarianzaNot +pow($valorNot,2);
    			}
          foreach ($valores[0] as $normaliza) {
            if (sqrt($sumaVarianzaNot/$cantidad) == 0) {
              $normaliza->nota = 0;
            }
            else{
              $normaliza->nota = number_format(($normaliza->nota-$valores[5])/sqrt($sumaVarianzaNot/$cantidad),2,'.','');
              if ($normaliza->nota < 0) {
                $normaliza->nota = $normaliza->nota * (-1);
              }
            }
          }
        }
		}

    return $valores[0];
  }

// Lets normalise the input data
/*foreach($data as $key => $d) {
  $data[$key] = normaliseValue($d, number_format(sqrt($d[0]*$d[0] + $d[1] * $d[1]), 2, '.', ''));
}

var_dump(kMeans($data, 3));
*/
public static function initialiseCentroids(array $data, $k) {
  $dimensions = count($data[0]);
  $centroids = array();
  $dimmax = array();
  $dimmin = array(); 
  foreach($data as $document) {
    foreach($document as $dim => $val) {
      if(!isset($dimmax[$dim]) || $val > $dimmax[$dim]) {
        $dimmax[$dim] = $val;
      }
      if(!isset($dimmin[$dim]) || $val < $dimmin[$dim]) {
        $dimmin[$dim] = $val;
      }
    }
  }
  for($i = 0; $i < $k; $i++) {
    $centroids[$i] = ModelMineria::initialiseCentroid($dimensions, $dimmax, $dimmin);
  }
  return $centroids;
}

public static function initialiseCentroid($dimensions, $dimmax, $dimmin) {
  $total = 0;
  $centroid = array();
  for($j = 0; $j < $dimensions; $j++) {
    $centroid[$j] = (rand($dimmin[$j] * 1000, $dimmax[$j] * 1000));
    $total += $centroid[$j] * $centroid[$j];
  }
  $centroid = ModelMineria::normaliseValue($centroid, sqrt($total));
  return $centroid;
}

public static function kMeans($data, $k) {
  $centroids = ModelMineria::initialiseCentroids($data, $k);
  $mapping = array();

  while(true) {
    $new_mapping = ModelMineria::assignCentroids($data, $centroids);
    $changed = false;
    foreach($new_mapping as $documentID => $centroidID) {
      if(!isset($mapping[$documentID]) || $centroidID != $mapping[$documentID]) {
        $mapping = $new_mapping;
        $changed = true;
        break;
      }
    }
    if(!$changed){
      return ModelMineria::formatResults($mapping, $data, $centroids); 
    }
    $centroids  = ModelMineria::updateCentroids($mapping, $data, $k); 
  }
}

public static function formatResults($mapping, $data, $centroids) {
  $result  = array();
  $result['centroides'] = $centroids;
  foreach($mapping as $documentID => $centroidID) {
    $result[$centroidID][] = implode(', ', $data[$documentID]);
  }
  return $result;
}

public static function assignCentroids($data, $centroids) {
  $mapping = array();

  foreach($data as $documentID => $document) {
    $minDist = 100;
    $minCentroid = null;
    foreach($centroids as $centroidID => $centroid) {
      $dist = 0;
      foreach($centroid as $dim => $value) {
        $dist += abs($value - $document[$dim]);
      }
      if($dist < $minDist) {
        $minDist = $dist;
        $minCentroid = $centroidID;
      }
    }
    $mapping[$documentID] = $minCentroid;
  }

  return $mapping;
}

public static function updateCentroids($mapping, $data, $k) {
  $centroids = array();
  $counts = array_count_values($mapping);

  foreach($mapping as $documentID => $centroidID) {
    foreach($data[$documentID] as $dim => $value) {
      if(!isset($cenntroids[$centroidID][$dim])) {
        $centroids[$centroidID][$dim] = 0;
      }
      $centroids[$centroidID][$dim] += ($value/$counts[$centroidID]); 
    }
  }

  if(count($centroids) < $k) {
    $centroids = array_merge($centroids, ModelMineria::initialiseCentroids($data, $k - count($centroids)));
  }

  return $centroids;
}

public static function normaliseValue(array $vector, $total) {
  foreach($vector as &$value) {
    $value = $value/$total;
  }
  return $vector;
}
}
