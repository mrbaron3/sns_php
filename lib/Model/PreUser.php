<?php

namespace MyApp\Model;

class PreUser extends \MyApp\Model{

	public function create($values){

		$stmt = $this->db->prepare('INSERT  INTO preusers(email,password,link_pass,created,modified) VALUES(:email,:password,linl_pass,now(),now());');
		$res = $stmt->execute([
			':email' => $values['email'],
			':password' => password_hash($values['password'],PASSWORD_DEFAULT),
			':linl_pass' => $values['linl_pass'],
		]);


		if($res === false){
			throw new \MyApp\Exception\DuplicateEmail();
		}
	}

    //----------------------------------------------------
    // 登録確認のメールで送られたリンクをクリックしてアクセスしたときの処理
    //----------------------------------------------------
    public function check_premember($values){
        $data = [];
            $sql= "SELECT * FROM preusers WHERE email = :email AND link_pass = :linkpass limit 1 ";
            $stmh = $this->db->prepare($sql);
            $stmh->bindValue(':email',  $values['email'],  PDO::PARAM_STR );
            $stmh->bindValue(':linkpass', $values['linkpass'], PDO::PARAM_STR );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);

		if($data === false){
			throw new \MyApp\Exception\DuplicateEmail();
		}
        return $data;
    }

    //----------------------------------------------------
    // 仮登録会員の削除
    //----------------------------------------------------
  public function Delet_preuser_and_create_user ($userdata){
        $this->db->beginTransaction();
        $sql = "DELETE FROM preusers WHERE id = :id";
        $stmh = $this->db->prepare($sql);
        $stmh->bindValue(':id', $userdata['id'], PDO::PARAM_INT );
        $stmh->execute();
        $sql = "INSERT  INTO member (email, password, created )
        VALUES (:email, :password, now() )";
        $stmh = $this->db->prepare($sql);
        $stmh->bindValue(':email',   $userdata['email'],   PDO::PARAM_STR );
        $stmh->bindValue(':password',  $userdata['password'],  PDO::PARAM_STR );
        $stmh->execute();
        $this->db->commit();
        if($data === false){
			throw new \MyApp\Exception\DuplicateEmail();
		}
  }

}
