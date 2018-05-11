<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use BackupManager\Manager;

class controllerrespaldo extends Controller
{

	public function respaldo()
	{
		$manager = App::make(\BackupManager\Manager::class);

		$manager
		    ->makeBackup()
		    ->run('development', [
		        new Destination('local', 'test/backup.sql'),
		        new Destination('s3', 'test/dump.sql')
		    ], 'gzip');
	}
}
