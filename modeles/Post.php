<?php

class Post {
	
	public $id;
	public $crea_usr_id;
	public $title;
	public $title_url;
	public $content;
	public $dt_crea;
	public $dt_modif;
	
	private $crea_user;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getCreaUsrId() {
		return $this->crea_usr_id;
	}
	
	public function setCreaUsrId($crea_usr_id) {
		$this->crea_usr_id = $crea_usr_id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getTitleUrl() {
		return $this->title_url;
	}
	
	public function setTitleUrl($title_url) {
		$this->title_url = $title_url;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getDtCrea() {
		return $this->dt_crea;
	}
	
	public function setDtCrea($dt_crea) {
		$this->dt_crea = $dt_crea;
	}
	
	public function getDtModif() {
		return $this->dt_modif;
	}
	
	public function setDtModif($dt_modif) {
		$this->dt_modif = $dt_modif;
	}
	
	public function getCreaUser() {
		return $this->crea_user;
	}
	
	public function setCreaUser($crea_user) {
		$this->crea_user = $crea_user;
	}
	
	
	public function __construct($id, $crea_usr_id, $title, $title_url, $content, $dt_crea, $dt_modif) {
		$this->id = $id;
		$this->crea_usr_id = $crea_usr_id;
		$this->title = $title;
		$this->title_url = $title_url;
		$this->content = $content;
		$this->dt_crea = $dt_crea;
		$this->dt_modif = $dt_modif;
	}
	
	
	public static function createPost(Post $post) {
		
		if(User::getCurrentUser() != null) {
			$usrId = User::getCurrentUser()->getId();
		} else {
			return 'No user connected.';
		}
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			INSERT INTO 
				posts 
			SET
				post_crea_usr_id	= :post_crea_usr_id
				, post_title 		= :post_title
				, post_title_url	= :post_title_url
				, post_content 		= :post_content
				, post_dt_crea 		= NOW()");
		
		$requete->bindValue(':post_crea_usr_id', 	$post->getCreaUsrId());
		$requete->bindValue(':post_title', 			$post->getTitle());
		$requete->bindValue(':post_title_url',		$post->getTitleUrl());
		$requete->bindValue(':post_content',    	$post->getContent());
	
		if ($requete->execute()) {
		
			$ret = $pdo->lastInsertId();
// 			Action::createAction(TABLE_POST, $ret, $post->getTitle(), TAC_CREATE, $usrId);
			return $ret;
			
		}
		
		return $requete->errorInfo();
		
	}
	
	public static function updatePost(Post $post) {
		
		if(User::getCurrentUser() != null) {
			$usrId = User::getCurrentUser()->getId();
		} else {
			return 'No user connected.';
		}
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			UPDATE
				posts 
			SET
				post_title 			= :post_title
				, post_title_url	= :post_title_url
				, post_content 		= :post_content
				, post_dt_modif		= NOW()
			WHERE
				post_id				= :post_id");
		
		$requete->bindValue(':post_id', 		$post->getId());
		$requete->bindValue(':post_title', 		$post->getTitle());
		$requete->bindValue(':post_title_url',	$post->getTitleUrl());
		$requete->bindValue(':post_content',    $post->getContent());
	
		if ($requete->execute()) {
		
// 			Action::createAction(TABLE_POST, $post->getId(), $post->getTitle(), TAC_UPDATE, $usrId);
			return $requete->rowCount();
			
		}
		
		return $requete->errorInfo();
		
	}
	
	
	public static function deletePost($post_id) {
		
		if(User::getCurrentUser() != null) {
			$post = Post::getPostById($post_id);
			$usrId = User::getCurrentUser()->getId();
		} else {
			return 'No user connected.';
		}
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			DELETE FROM
				posts 
			WHERE
				post_id			= :post_id");
		
		$requete->bindValue(':post_id', 	(int)$post_id);
	
		if ($requete->execute()) {
		
// 			Action::createAction(TABLE_POST, $post->getId(), $post->getTitle(), TAC_DELETE, $usrId);
			return $requete->rowCount();
			
		}
		
		return $requete->errorInfo();
		
	}
	
	public static function getAllPosts() {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				post_id, post_crea_usr_id, post_title, post_title_url, post_content, post_dt_crea, post_dt_modif
			FROM
				posts 
			;");
	
		$requete->execute();
		
		$list_posts = array();
		
		$results = $requete->fetchAll(PDO::FETCH_ASSOC);
		
		$requete->closeCursor();
		
		foreach($results as $result) {
		
			$post = new Post($result['post_id'], $result['post_crea_usr_id'], $result['post_title'], $result['post_title_url'], $result['post_content'], new Datetime($result['post_dt_crea']), ($result['post_dt_modif'] != null ? new Datetime($result['post_dt_modif']) : null));
			$post->setCreaUser(User::getUserById($result['post_crea_usr_id']));
		
			$list_posts[] = $post;
			
		}
		
		return $list_posts;
		
	}
	
	
	public static function getPosts($page, $nb_posts) {
		
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare("
			SELECT 
				post_id, post_crea_usr_id, post_title, post_title_url, post_content, post_dt_crea, post_dt_modif
			FROM
				posts
			ORDER BY
				post_dt_crea DESC 
			LIMIT :first, :number
			;");
	
		$first = ($page - 1 ) * $nb_posts; 
		
		$requete->bindValue(':first', 	(int)$first, PDO::PARAM_INT);
		$requete->bindValue(':number',  (int)$nb_posts, PDO::PARAM_INT);
		
		$requete->execute();
		$list_posts = array();
		
		$results = $requete->fetchAll(PDO::FETCH_ASSOC);
		
		$requete->closeCursor();
		
		foreach($results as $result) {
		
			$post = new Post($result['post_id'], $result['post_crea_usr_id'], $result['post_title'], $result['post_title_url'], $result['post_content'], new Datetime($result['post_dt_crea']), ($result['post_dt_modif'] != null ? new Datetime($result['post_dt_modif']) : null));
			$post->setCreaUser(User::getUserById($result['post_crea_usr_id']));
		
			$list_posts[] = $post;
			
		}
		
		
		return $list_posts;
		
	}
	
	
	public static function getPostsNbPages() {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				COUNT(post_id) as nb_pages
			FROM
				posts
			;");
	
		$requete->execute();
		
		$list_posts = array();
		
		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			
			$nb_pages = round(($result['nb_pages'] / NB_POST_PER_PAGE) + 0.4) ; 
			
			return $nb_pages;
			
		}
		
		return 0;
		
	}
	
	
	public static function getPostById($post_id) {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				post_id, post_crea_usr_id, post_title, post_title_url, post_content, post_dt_crea, post_dt_modif
			FROM
				posts
			WHERE
				post_id = :post_id
			;");
	
		$requete->bindValue(':post_id', $post_id);
		
		$requete->execute();
		
		$results = $requete->fetchAll(PDO::FETCH_ASSOC);
		
		$requete->closeCursor();
		
		if(sizeof($results == 1)) {
			
			$result = $results[0];
		
			$post = new Post($result['post_id'], $result['post_crea_usr_id'], $result['post_title'], $result['post_title_url'], $result['post_content'], new Datetime($result['post_dt_crea']), ($result['post_dt_modif'] != null ? new Datetime($result['post_dt_modif']) : null));
			$post->setCreaUser(User::getUserById($result['post_crea_usr_id']));
		
			return $post;
			
		}
		
		return false;
		
	}
	
	
	public static function getPostByTitleUrl($post_title_url) {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				post_id, post_crea_usr_id, post_title, post_title_url, post_content, post_dt_crea, post_dt_modif
			FROM
				posts
			WHERE
				post_title_url = :post_title_url
			;");
	
		$requete->bindValue(':post_title_url', $post_title_url);
		
		$requete->execute();
		
		$results = $requete->fetchAll(PDO::FETCH_ASSOC);
		
		$requete->closeCursor();
		
		if(sizeof($results == 1)) {
			
			$result = $results[0];
		
			$post = new Post($result['post_id'], $result['post_crea_usr_id'], $result['post_title'], $result['post_title_url'], $result['post_content'], new Datetime($result['post_dt_crea']), ($result['post_dt_modif'] != null ? new Datetime($result['post_dt_modif']) : null));
			$post->setCreaUser(User::getUserById($result['post_crea_usr_id']));
		
			return $post;
			
		}
		
		return false;
		
	}
	
	
	public static function getPostsMonths() {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT DISTINCT
				DATE_FORMAT(post_dt_crea, '%m-%b-%Y') as month
			FROM
				posts
			ORDER BY
				post_dt_crea DESC
			;");
	
		$requete->execute();
		
		$list_months = array();
		
		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			
			$a_month = explode("-", $result['month']);			
		
			$list_months[] = array("s_month"=>$a_month[1].". ".$a_month[2],
									"v_month"=>$a_month[0].$a_month[2]);
			
		}
		
		$requete->closeCursor();
		
		return $list_months;
		
	}
	
	
	public static function getPostsByMonth($month, $page, $nb_posts) {
		
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare("
			SELECT 
				post_id, post_crea_usr_id, post_title, post_title_url, post_content, post_dt_crea, post_dt_modif
			FROM
				posts
			WHERE
				DATE_FORMAT(post_dt_crea, '%m%Y') = :month
			ORDER BY
				post_dt_crea DESC 
			LIMIT :first, :number
			;");
	
		$first = ($page - 1 ) * $nb_posts; 
		
		$requete->bindValue(':first', 	(int)	$first, 		PDO::PARAM_INT);
		$requete->bindValue(':number',  (int)	$nb_posts, 		PDO::PARAM_INT);
		$requete->bindValue(':month', 			$month);
		
		$requete->execute();
		$list_posts = array();
		
		$results = $requete->fetchAll(PDO::FETCH_ASSOC);
		
		$requete->closeCursor();
		
		foreach($results as $result) {
		
			$post = new Post($result['post_id'], $result['post_crea_usr_id'], $result['post_title'], $result['post_title_url'], $result['post_content'], new Datetime($result['post_dt_crea']), ($result['post_dt_modif'] != null ? new Datetime($result['post_dt_modif']) : null));
			$post->setCreaUser(User::getUserById($result['post_crea_usr_id']));
		
			$list_posts[] = $post;
			
		}
			
		return $list_posts;
		
	}
	
	
	public static function getPostsNbPagesByMonth($month) {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				COUNT(post_id) as nb_pages
			FROM
				posts
			WHERE
				DATE_FORMAT(post_dt_crea, '%m%Y') = :month
			;");
	
		$requete->bindValue(':month', 	$month);
		
		$requete->execute();
		
		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
		
			$nb_pages = round(($result['nb_pages'] / NB_POST_PER_PAGE) + 0.4) ; 
			
			return $nb_pages;
			
		}
		
		return 0;
		
	}
	
}





?>