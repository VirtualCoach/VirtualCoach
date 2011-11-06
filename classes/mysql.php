<?php

error_reporting(E_ALL ^ E_NOTICE);

$db_host = 'localhost';
$db_user = 'devtest';
$db_pass = 'devtest';
$db_name = 'virtual_coach';

@$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
	die('<h1>Could not connect to the database</h1><h2>Please try again after a few moments.</h2>');
}

$mysqli->set_charset("utf8");

class Mysql {
	
	private function hash_pass($pass) {
		$salt = "7AG4gspttPLsalty";
		return hash('sha512', $pass.$salt);
	}
	
	public function get_user_id($username) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($rid);
		$stmt->fetch();
		$stmt->close();
		return $rid;
	}
	
	public function validate_user($username, $pword) {
		global $mysqli;
		$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? AND password = ? LIMIT 1");
		$stmt->bind_param("ss", $username, $this->hash_pass($pword));
		$stmt->execute();
		$stmt->store_result();
		$res = $stmt->num_rows >= 1;
		$stmt->close();
		return $res;
	}
	
	public function new_user($username, $pword, $email) {
		global $mysqli;
		$stmt = $mysqli->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $email, $username, $this->hash_pass($pword));
		$stmt->execute();
		$res = "success";
		if($stmt->affected_rows != 1) {
			$stmt2 = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
			$stmt2->bind_param("s", $email);
			$stmt2->execute();
			$stmt2->store_result();
			$res = $stmt2->num_rows == 1 ? "email" : "username";
			$stmt2->close();
		}
		$stmt->close();
		//$this->updateActivity("New user added: <a href='../#!/profile/".$id."'>".$name."</a>");
		return $res;
	}
	
	public function add_info($uid, $age, $weight, $height, $years) {
		global $mysqli;
		$stmt = $mysqli->prepare("UPDATE users SET age = ?, weight = ?, height = ?, years = ? WHERE id = ?");
		$stmt->bind_param("iddii", $age, $weight, $height, $years, $uid);
		$stmt->execute();
		$res = "success";
		if($stmt->affected_rows != 1) {
			$stmt2 = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
			$stmt2->bind_param("s", $email);
			$stmt2->execute();
			$stmt2->store_result();
			$res = $stmt2->num_rows == 1 ? "uid" : "unknown";
			$stmt2->close();
		}
		$stmt->close();
		//$this->updateActivity("New user added: <a href='../#!/profile/".$id."'>".$name."</a>");
		return $res;
	}
}

?>