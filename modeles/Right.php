<?php

class Right {

	private $id = null;
	private $cd = null;
	private $name = null;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getCd(){
		return $this->cd;
	}

	public function setCd($cd){
		$this->cd = $cd;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}
	
	public function __construct($id, $cd, $name) {
		$this->id = $id;
		$this->cd = $cd;
		$this->name = $name;
	}

	public static function getRightsForUser($usr_id) {
		
	$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				rights.rgt_id, rights.rgt_cd, rights.rgt_name
			FROM
				rights
			INNER JOIN
				user_rights
					ON (rights.rgt_id = user_rights.rgt_id)
			WHERE
				user_rights.usr_id = :usr_id
			;");
	
		
		$requete->bindValue(':usr_id', 	$usr_id);
		
		$requete->execute();
		
		$list_rights = array();
		
		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			
			$right = new Right($result['rgt_id'], $result['rgt_cd'], $result['rgt_name']);
			
			$list_rights[] = $right;
			
		}
		
		$requete->closeCursor();
		
		return $list_rights;
		
	}

}

?>