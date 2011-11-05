<?php

require_once("util.php");
require_once("mysql.php");

class User {
	
	public function log_in($username, $pword) {
		
		$mysql = new Mysql();
		
		$valid_user = $mysql->validate_user($username, $pword);
		
		if ($valid_user) {
			unset_error();
			$_SESSION['status'] = 'authorized';
			$_SESSION['user'] = $username;
			header("Location: ../dashboard");
		} else {
			set_error("login");
			header("Location: ../");
		}
	}
	
	public function create_user($username, $pword, $email) {
		$mysql = new Mysql();
		
		$user_create = $mysql->new_user($username, $pword, $email);
		
		if($user_create == "success") {
			unset_error();
			$_SESSION['status'] = 'authorized';
			$_SESSION['user'] = $username;
			header("Location: ../dashboard");
		} else if ($user_create == "email") {
			set_error("email");
			header("Location: ../signup");
		} else if ($user_create == "username") {
			set_error("username");
			header("Location: ../signup");
		} else {
			set_error("unknown");
			header("Location: ../signup");
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
		
		header("Location: ../");
	}
	
	public function is_logged_in() {
		return $_SESSION['status'] == 'authorized';
	}
}

?>