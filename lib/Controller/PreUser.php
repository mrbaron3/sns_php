<?php

namespace MyApp\Controller;



class PreUser extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }

    if(isset($_GET['linkpass']) && /*isset($_GET['username'])*/){
      $this->user_registProsess();
      exit;
    }else{
      echo "URLが無効です。";
    }
  }

  public function user_registProsess(){
     //regist preuser
     $values = array(
        'email' => $this->email,
        'password' => $this->passowrd,
        'link_pass' => $this->linkpass
      );

      try {
        $preuser_model = new \MyApp\Model\PreUsers();
        $preuser_model->create($values);
      }catch (\MyApp\Exception\DuplicateEmail $e) {
          /*  既に登録されていたらエラー表示 */
          $this->setErrors('email', $e->getMessage());
           return;
      }
      try {
        $userdata = $preuser_model->check_premember($values);
      }catch (\MyApp\Exception\DuplicateEmail $e) {
          /*  既に登録されていたらエラー表示 */
          $this->setErrors('email', $e->getMessage());
          return;
      }
      if(isset($userdata) && count($userdata) >= 1){
        try {
          $preuser_model->Delet_preuser_and_create_user($userdata);
        }catch (\MyApp\Exception\DuplicateEmail $e) {
            /*  既に登録されていたらエラー表示 */
            $this->setErrors('email', $e->getMessage());
            return;
        }

      }







}
