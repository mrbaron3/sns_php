<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }

    // get users info
    $userModel = new \MyApp\Model\User();
    $this->setValues('users',$userModel->findAll());
  }


}



// namespace MyApp\Controller;

// class Index extends \MyApp\Controller {

//   public function run() {
//     if (!$this->isLoggedIn()) {
//       // login
//       header('Location: ' . SITE_URL . '/login.php');
//       exit;
//     }

//     // get users info
//   }

// }
//OwCnA5j7qJz7FujQnCnR7v1qt3171z
//http://click.poikore.jp/id/zmOJUinhcsPW1hYqRYKj7v1qt3171z100000.html
//http://click.poikore.jp/id/Ubw360IabDnUnFrgwrbY7v1qt3171z100000.html