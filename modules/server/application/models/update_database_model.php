<?php
class Update_database_model extends CI_Model {
	
    function __construct()
	{
		parent::__construct();
		$this->load->library('Connection');
	}

    function execute_script_all_databases($output = true)
    {
        $connection = new Connection();
        $this->load->database();
        $this->load->dbutil();

        $this->db->select('nombre_completo, path as name_database');
        $bases = $this->db->get(INFOSAC_DB.'.empresa')->result();
        $resultado = array();

        foreach ($bases as $key => $object) {
            try {
//                if($object->name_database != 'provpac') {
                    $db_settings = $connection->change($object->name_database);
                    $this->db = $this->load->database($db_settings, true);
                    $this->run_sql_file('./database/update_database.sql');
                    
					if ($output) {
						
						//DESCOMENTAR PARA DESARROLLO
                        echo '<br><br>'.$object->name_database.'.... Done <br><br><br><br>';
                        echo '--------------------------------------------------------<br>';
						//HASTA AQUI
						
						//COMENTAR PARA DESARROLLO
#                        echo $object->name_database.'.... Done <br/>';
                    }
//                }
            }
            catch(Exception $e)
            {
                echo '<br>error:'.$e;
            }
        }
    }

    function run_sql_file($location)
	{
	    $commands = file_get_contents($location);

	    $lines = explode("\n", $commands);
	    $commands = '';
        
	    foreach ($lines as $line) {
	        $line = trim($line);
	        if ( $line && !$this->startsWith($line,'--') ) {
	            $commands .= $line . "\n";
	        }
	    }

	    $commands = explode(";", $commands);

	    $total = $success = 0;
		
		//DESCOMENTADO PARA DESARROLLO
        $ultimo_sql_ejecutado = '';
        $sql_no_ejecutados = '';
        $numero_de_sql_no_ejecutado = 0;
		//echo 'SENTECIAS SQL A EJECUTAR: '.count($commands).'<br><br>';
		//HASTA AQUI
		
	    foreach ($commands as $command) {
            
	        if (trim($command)) {
				//COMENTAR PARA DESARROLLO
#	            $success += ($this->db->simple_query($command)==false ? 0 : 1);
#	            $total += 1;
				
				//DESCOMENTADO PARA DESARROLLO
                if ($this->db->simple_query($command)) {
                    $success += 1;
                    $ultimo_sql_ejecutado = $command;
                }
                else {
                    $numero_de_sql_no_ejecutado += 1;
                    $sql_no_ejecutado = $numero_de_sql_no_ejecutado.'.- '.$command.'<br>';
                    $sql_no_ejecutados = $sql_no_ejecutados.$sql_no_ejecutado;
                }
                $total += 1;
				//HASTA QUI
	        }
	    }
		
		//DESCOMENTADO PARA DESARROLLO
        echo 'SENTECIAS NO EJECUTADAS: <br><br>'.$sql_no_ejecutados.'<br>';
        echo 'ULTIMA SENTENCIA EJECUTADA: <br><br>'.$ultimo_sql_ejecutado.'<br><br>';
        echo 'SENTECIAS SQL EJECUTADAS: '.$success;
		//HASTA AQUI
		
	    return array(
	        "success" => $success,
	        "total" => $total
	    );
	}

	function startsWith($haystack, $needle){
	    $length = strlen($needle);
	    return (substr($haystack, 0, $length) === $needle);
	}
}
?>