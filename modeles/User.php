<?php

class User {
	
	public $id;
	public $name;
	public $password;
	public $mail;
	public $dt_crea;
	public $list_rights;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getMail() {
		return $this->mail;
	}
	
	public function setMail($mail) {
		$this->mail = $mail;
	}
	
	public function getDtCrea() {
		return $this->dt_crea;
	}
	
	public function setDtCrea($dt_crea) {
		$this->dt_crea = $dt_crea;
	}
	
	public function getListRights() {
		return $this->list_rights;
	}
	
	public function setListRights($list_rights) {
		$this->list_rights = $list_rights;
	}
	
	public function __construct($id, $name, $password, $mail, $dt_crea) {
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->mail = $mail;
		$this->dt_crea = $dt_crea;
	}
	
	public static function createUser(User $user) {
		
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("
			INSERT INTO 
				users 
			SET
				usr_name 			= :usr_name
				, usr_password 		= :usr_password
				, usr_mail			= :usr_mail
				, usr_dt_crea		= NOW()
			;");
	
		$requete->bindValue(':usr_name', 		$user->getName());
		$requete->bindValue(':usr_password',	$user->getPassword());
		$requete->bindValue(':usr_mail', 		$user->getMail());
		
		if ($requete->execute()) {
			
			return $pdo->lastInsertId();
			
		}
		
		return $requete->errorInfo();
		
	}
	
	public static function getUserByName($usr_name) {
	
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				usr_id, usr_name, usr_password, usr_mail, usr_dt_crea
			FROM
				users
			WHERE
				usr_name = :usr_name
			;");
	
		$requete->bindValue(':usr_name', 	$usr_name);
		
		$requete->execute();
		
		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
		
			return new User($result['usr_id'], $result['usr_name'], $result['usr_password'], $result['usr_mail'], $result['usr_dt_crea']);
			
		}
			
		return null;
		
	}
	
	public static function getUserById($usr_id) {
	
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				usr_id, usr_name, usr_password, usr_mail, usr_dt_crea
			FROM
				users
			WHERE
				usr_id = :usr_id
			;");
	
		$requete->bindValue(':usr_id', 	$usr_id);
		
		$requete->execute();
		
		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
		
			return new User($result['usr_id'], $result['usr_name'], $result['usr_password'], $result['usr_mail'], $result['usr_dt_crea']);
			
		}
			
		return null;
		
	}
	
	public static function isCurrentUserConnected() {
		
		if(cleanGlobal($_SESSION, 'current_user') != null && cleanGlobal($_SESSION, 'connected') == 1) {
			return true;			
		} else {
			return false;
		}
		
	}
	
	public static function hasCurrentUserRight($right_cd) {
		
		if(cleanGlobal($_SESSION, 'current_user') == null) {
			
			return false;
			
		} else {
			
			$current_user = unserialize(cleanGlobal($_SESSION, 'current_user', false));
			
			if($current_user->getListRights() != null) {
			
				foreach($current_user->getListRights() as $right) {
					
					if($right->getCd() == $right_cd) {
						
						return true;
						
					}
					
				}
			
			}
			
			return false;
			
		}
		
	}
	
	public static function getCurrentUser() {
		
		if(cleanGlobal($_SESSION, 'current_user') == null) {
			
			return null;
			
		} else {
			
			return unserialize(cleanGlobal($_SESSION, 'current_user', false));
			
		}
		
	}
	
}

?>