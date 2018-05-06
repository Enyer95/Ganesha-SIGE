<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;
use \Auth as Auth;
use Crypt;

class ModelPnf extends Model
{
    protected $table = "mpnfs";
    protected $primaryKey = "cod_pnf";
    protected $fillable = [
      'nom_pnf','statuspass'	];
}
