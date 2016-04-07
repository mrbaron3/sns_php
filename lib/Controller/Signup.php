<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL);
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    	$this->postProcess();

    }
  }

  //If does not login
  private function postProcess(){
	// validate
	try {
		$this->_validate();
	} catch (\MyApp\Exception\InvaildEmail $e) {
		$this->setErrors('email',$e->getMessage());
	}catch (\MyApp\Exception\InvaildPassword $e) {
		$this->setErrors('password',$e->getMessage());
	}

  //Keep email address for from
	$this->setValues('email',$_POST['email']);

	if($this->hasErrors()){
		return;
	}else{
    //create link_pass
    $link_pass = bin2hex(openssl_random_pseudo_bytes(10));
  	//regist preuser
    try {
      $preuser_model = new \MyApp\Model\PreUsers();
      $preuser_model->create([
        'email' => $_POST['email'],
        'password' => $_POST['password']
        'link_pass' => $link_pass,
      ]);
   	}catch (\MyApp\Exception\DuplicateEmail $e) {
          $this->setErrors('email', $e->getMessage());
          return;
    }
  	//redirect to login		
  	header('Location:'. SITE_URL . '/login.php');
	}

  	
  }

  private function _validate(){
  	if(!isset($_POST['token']) || !$_POST['token'] == $_SESSION['token']){
  		echo "invalid token";
  		exit;
  	}

  	if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  		throw new \MyApp\Exception\InvaildEmail();
  	}

  	if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])){
  		throw new \MyApp\Exception\InvaildPassword();
  	}
  }

}
