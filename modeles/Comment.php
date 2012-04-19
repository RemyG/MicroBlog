<?php

class Comment {

	private $id = null;
	private $dt = null;
	private $usrId = null;
	private $usrName = null;
	private $usrMail = null;
	private $postId = null;
	private $content = null;
	private $user = null;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDt(){
		return $this->dt;
	}

	public function setDt($dt){
		$this->dt = $dt;
	}

	public function getUsrId(){
		return $this->usrId;
	}

	public function setUsrId($usrId){
		$this->usrId = $usrId;
	}
	
	public function getUsrName() {
		return $this->usrName;
	}
	
	public function setUsrName($usrName) {
		$this->usrName = $usrName;
	}
	
	public function getUsrMail() {
		return $this->usrMail;
	}
	
	public function setUsrMail($usrMail) {
		return $this->usrMail;
	}

	public function getPostId(){
		return $this->postId;
	}

	public function setPostId($postId){
		$this->postId = $postId;
	}

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = $content;
	}
	
	public function getUser() {
		return $this->user;
	}
	
	public function setUser($user) {
		$this->user = $user;
	}

	public function __construct($id, $dt, $usrId, $usrName, $usrMail, $postId, $content) {
		$this->id = $id;
		$this->dt = $dt;
		$this->usrId = $usrId;
		$this->usrName = $usrName;
		$this->usrMail = $usrMail;
		$this->postId = $postId;
		$this->content = $content;
	}

	public static function createComment(Comment $comment) {

		$post = Post::getPostById($comment->getPostId());
		
		if(User::getCurrentUser() != null) {
			$usrId = User::getCurrentUser()->getId();
		} else if ($comment->getUsrName() != null) {
			$usrId = null;
		} else {
			return 'No user connected.';
		}
		
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("
			INSERT INTO 
				comments 
			SET
				cmt_dt			= NOW()
				, cmt_usr_id	= :usr_id
				, cmt_usr_name	= :usr_name
				, cmt_usr_mail	= :usr_mail
				, cmt_post_id	= :post_id
				, cmt_content	= :content
			;");

		$requete->bindValue(':usr_id', 		$comment->getUsrId());
		$requete->bindValue(':usr_name', 	$comment->getUsrName());
		$requete->bindValue(':usr_mail', 	$comment->getUsrMail());
		$requete->bindValue(':post_id', 	$comment->getPostId());
		$requete->bindValue(':content', 	$comment->getContent());

		if ($requete->execute()) {

			$ret = $pdo->lastInsertId();
// 			Action::createAction(TABLE_COMMENT, $ret, $post->getTitle(), TAC_CREATE, $usrId);
			return $ret;
				
		}

		return $requete->errorInfo();

	}
	
	public static function getCommentsForPost($post_id) {
		
		$pdo = PDO2::getInstance();
	
		$requete = $pdo->prepare("
			SELECT 
				cmt_id, cmt_dt, cmt_usr_id, cmt_usr_name, cmt_usr_mail, cmt_post_id, cmt_content,
				usr_id, usr_name, usr_password, usr_mail, usr_dt_crea
			FROM
				comments 
			LEFT OUTER JOIN
				users
					ON (cmt_usr_id = usr_id)
			WHERE
				cmt_post_id = :post_id
			ORDER BY
				cmt_dt ASC 
			;");
	
		
		$requete->bindValue(':post_id', 	$post_id);
		
		$requete->execute();
		
		$list_comments = array();
		
		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			
			$comment = new Comment($result['cmt_id'], new Datetime($result['cmt_dt']), $result['cmt_usr_id'], $result['cmt_usr_name'], $result['cmt_usr_mail'], $result['cmt_post_id'], $result['cmt_content']);
			if($result['cmt_usr_id'] != null) {
				$user = new User($result['usr_id'], $result['usr_name'], null, $result['usr_mail'], $result['usr_dt_crea']);
			} else {
				$user = new User(null, $result['cmt_usr_name'], null, $result['cmt_usr_mail'], null);
			}
			$comment->setUser($user);
			
			$list_comments[] = $comment;
			
		}
		
		$requete->closeCursor();
		
		return $list_comments;
		
	}

}

?>