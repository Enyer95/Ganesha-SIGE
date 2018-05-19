<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;
use BackupManager\Manager;
use BackupManager\Filesystems\Destination;
use Carbon\Carbon;

class ModelRespaldo extends Model
{
	public static function respaldo()
	{
		$manager = \App::make(\BackupManager\Manager::class);
		$manager->makeBackup()->run('pgsql', [new Destination('backup', 'backup'.Carbon::now().'.sql')], 'gzip');
		
	}
	public static function restore($nombre)
	{
		$manager = \App::make(\BackupManager\Manager::class);
		$manager->makeRestore()->run('backup', $nombre, 'pgsql', 'gzip');
		
	}
}
