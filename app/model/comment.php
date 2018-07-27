<?php
namespace app\model;
use myclass\Val;


class comment extends basis {

	public function store($event_id,$user_id) {
		$error = [];

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$comment = mysqli_real_escape_string($this->db, $f_comment);
		

		if(!Val::name($comment)) {
			$error['name'] = "Name cannot be empty!";
		}
	
		if(!$error) {
			// Save comment details
			$this->db->query("INSERT INTO comment (`body`, `event_id`, `user_iduser`) VALUES ('$comment', '$event_id', '$user_id');");
		
		// } elseif (!$error && $id != null) {
		// 	$this->db->query("UPDATE comment SET `name` = '$comment' WHERE `commentId` = '$id';");
		} else {
			return $error;
		}
	}
	
	// Get userid for validation to delete only own comment
	public function commentUser($comment_id) {
		return $this->db->query("SELECT userId FROM comment
			JOIN user ON comment.user_iduser = user.userId
			WHERE commentId = '$comment_id';")->fetch_object();
	}


}