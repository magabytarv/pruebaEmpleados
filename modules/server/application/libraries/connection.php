<?php 
class Connection
{
	public function change($database)
	{
		$db_settings['hostname'] = 'localhost';
		$db_settings['username'] = 'root';
		$db_settings['password'] = '';
		$db_settings['database'] = $database;
		$db_settings['dbdriver'] = 'mysql';
		$db_settings['dbprefix'] = '';
		$db_settings['pconnect'] = TRUE;
		$db_settings['db_debug'] = TRUE;
		$db_settings['cache_on'] = FALSE;
		$db_settings['cachedir'] = '';
		$db_settings['char_set'] = 'utf8';
		$db_settings['dbcollat'] = 'utf8_general_ci';
		$db_settings['swap_pre'] = '';
		$db_settings['autoinit'] = TRUE;
		$db_settings['stricton'] = FALSE;
		return $db_settings;
	}
}
