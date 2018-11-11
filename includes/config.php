<?php
ob_start();
session_start();

//database credentials
// define('DBHOST','localhost');
// define('DBUSER','root');
// define('DBPASS','');
// define('DBNAME','db.sql');

try {
 
	 $db = new PDO("mysql:host=localhost;dbname=blogdb;charset=utf8", "root", "",
	 array(
	 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	 ));
} catch ( PDOException $e ){
     print $e->getMessage();
}



//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
spl_autoload_register(function ($class) {
   
   $class = strtolower($class);

	//if call from within assets adjust the path
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 	
	
	//if call from within admin adjust the path
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
	
	//if call from within admin adjust the path
   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
	 
});

$user = new User($db); 
?>
