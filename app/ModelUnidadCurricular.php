<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelUnidadCurricular extends Model
{
    protected $table = "muni_crrs";
    protected $primaryKey = "cod_uc_pnf";
    public $incrementing = false;

    protected $fillable = ['cod_uc_pnf', 'cod_uc_nac','creditos','nom_uc','trayecto','hta','htt','hte','periodo','cod_pen_uc',  ];

    public function ejes(){
        return $this->belongsToMany('GaneshaSIGE\ModelEje', 'mejes_ucs',  'cod_uc_pnf_euc', 'cod_ejes_euc');
    }

    //de unidades a usuarios
    public function MasterPuente_UniCrr_User(){
        return $this->belongsToMany('GaneshaSIGE\User', 'mpuentemasters',  'cod_unidad', 'id_usu', 'cod_seccion', 'coordinador');
    }

    //de unidades a secc
    public function MasterPuente_UniCrr_Secc(){
        return $this->belongsToMany('GaneshaSIGE\ModelSeccion', 'mpuentemasters',  'cod_unidad', 'cod_seccion', 'id_usu', 'coordinador');
    }

    public function tieneEjes($nom_eje){
        foreach($this->ejes as $ejs)
            if($nom_eje == $ejs->nom_eje)
                return true;
        return false;
    }

    public static function max_uni($max){
        if (count(self::all())<$max) {
            return true;
        }
        else
        {
            return false;
        }
        
    }
}
