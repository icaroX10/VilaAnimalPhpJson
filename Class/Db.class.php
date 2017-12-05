<?php

	require_once('config.php');
	class Db{
		private static $instance;
		function __construct(){
			$this->getInstance();
		}
		public static function getInstance(){
			if(!isset(self::$instance)){
				try{
					self::$instance = new PDO('mysql:host='.HOST.';dbname='.BASE,USER,PASS);
					self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
			return self::$instance;
		}
		public static function prepare($sql){
			return self::getInstance()->prepare($sql);
		}

		public static function lastId(){
			return self::$instance->lastInsertId();
		}
	}

?>