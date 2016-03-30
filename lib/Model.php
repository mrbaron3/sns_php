<?php

namespace MyApp;

class Model{

	protected $db;

    public function __construct(){
  		try {
			$this->db = new \PDO(DNS,DB_USERNAME,DB_PASSWORD);
		
		} catch (\PDOException $e) {
			echo $e->getMessage();
			exit;
		}
	}   	
}
