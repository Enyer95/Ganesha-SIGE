<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;
use \Auth as Auth;
use Crypt;
use GaneshaSIGE\User;

class ModelPnf extends Model
{
    protected $table = "mpnfs";
    protected $primaryKey = "cod_pnf";
    protected $fillable = [
      'nom_pnf','cant_secc','cant_uni','tiempo_respaldo','fecha_final','enabled'	
    ];
    public static function MaxUni(){
		return self::where('cod_pnf', 1)->value('cant_uni');
    }
}