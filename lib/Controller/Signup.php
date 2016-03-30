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
  	$this->setValues('email',$this->email);

  	if($this->hasErrors()){
  		return;
  	}else{
     echo '登録頂いたアドレスにメールをお送りしました。' . '\n' .'まだ登録は完了しておりません。';
    	//redirect to login
    	header('Location:'. SITE_URL . '/login.php');
      exit;
  	}
  }

  private function _validate(){
  	if(!isset($_POST['token']) || !$_POST['token'] == $_SESSION['token']){
  		echo "invalid token";
  		exit;
  	}

  	if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
  		throw new \MyApp\Exception\InvaildEmail();
  	}

  	if(!preg_match('/\A[a-zA-Z0-9]+\z/', $this->password)){
  		throw new \MyApp\Exception\InvaildPassword();
  	}
  }
}
