<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use BackupManager\Filesystems\Destination;

class controllerrespaldo extends Controller
{
	public function respaldo()
	{
		$manager = require 'bootstrap.php';
		$manager
		    ->makeBackup()
		    ->run('development', [
		        new Destination('local', 'test/backup.sql'),
		        new Destination('s3', 'test/dump.sql')
		    ], 'gzip');
	}
}
