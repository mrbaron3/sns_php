<?php 

 namespace MyApp;

 class Controller{

 	private $_errors;
 	private $_values;
 	protected $email;
 	protected $password,
 	protected $linkpass;

 	public function __construct(){
 		if(!isset($_SESSION['token'])){
 			$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
 		}
 		$this->_errors 	= new \stdClass();
 		$this->_values 	= new \stdClass();
 		$this->email   	= $_POST['email'];
 		$this->password = $_POST['password'];
 		$this->linkpass = $_SESSION['token'];
 	}

 	protected function setValues($key,$value){
 		$this->_values->$key = $value;
 	}
 	public function getValues(){
 		return $this->_values;
 	}

 	protected function setErrors($key,$error){
 		$this->_errors->$key = $error;
 	}
 	public function getErrors($key){
 		return isset($this->_errors->$key) ? $this->_errors->$key : '';
 	}
 	protected function hasErrors(){
 		return !empty(get_object_vars($this->_errors));
 	}

 	protected function isLoggedIn(){
 		//$_SESSION['me']
 		return isset($_SESSION['me']) && !empty($_SESSION['me']);
 	}

 	public function me(){
 		return $this->isLoggedIn() ? $_SESSION['me']: null;
 	}
 }
