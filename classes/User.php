<?php

require_once("util.php");
require_once("mysql.php");

class User {
	
	public function set_error($e) {
		$_SESSION['e'] = $e;
	}

	public function unset_error() {
		unset($_SESSION['e']);
	}
	
	public function log_in($username, $pword) {
		
		$mysql = new Mysql();
		
		$valid_user = $mysql->validate_user($username, $pword);
		
		if ($valid_user) {
			$this->unset_error();
			$this->get_uid($username);
			$_SESSION['status'] = 'authorized';
			$_SESSION['user'] = $username;
			header("Location: ../dashboard");
		} else {
			$this->set_error("login");
			header("Location: ../");
		}
	}
	
	public function create_user($username, $pword, $email) {
		$mysql = new Mysql();
		
		$user_create = $mysql->new_user($username, $pword, $email);
		
		if($user_create == "success") {
			$this->unset_error();
			$this->get_uid($username);
			$_SESSION['status'] = 'authorized';
			$_SESSION['user'] = $username;
			header("Location: ../information");
		} else if ($user_create == "email") {
			$this->set_error("email");
			header("Location: ../signup");
		} else if ($user_create == "username") {
			$this->set_error("username");
			header("Location: ../signup");
		} else {
			set_error("unknown");
			header("Location: ../signup");
		}
	}
	
	public function add_user_info($age, $weight, $height, $years) {
		$mysql = new Mysql();
		
		$user_info = $mysql->add_info($_SESSION['uid'], $age, $weight, $height, $years);
		
		if ($user_info == "success") {
			$this->unset_error();
			return true;
		} else {
			$this->set_error($user_info);
			return false;
		}
		
	}
	
	public function log_out() {
		if(isset($_SESSION['status'])) {
			unset($_SESSION['status']);
			
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 1000);
				session_destroy();
			}
		}
		if(isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		if(isset($_SESSION['uid'])) {
			unset($_SESSION['uid']);
		}
		
		header("Location: ../");
	}
	
	public function get_uid($username) {
		$mysql = new Mysql();
		
		$uid = $mysql->get_user_id($username);
		$_SESSION['uid'] = $uid;
		return $uid;
	}
	
	public function is_logged_in() {
		return $_SESSION['status'] == 'authorized';
	}
	
	public function require_login() {
		if (!$this->is_logged_in()) header("Location: ./");
	}
}

?>