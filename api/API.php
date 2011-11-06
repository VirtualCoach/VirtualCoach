<?
// This is the API.

require_once("mysql.php");

class API {
	
	private $uid;
	private $mysql;
	
	public function __construct($uid) {
		global $mysqli;
		$this->uid = $uid;
		$this->mysql = $mysqli;
		
		// possibly load all of the customer's data
	}
	
	public function getSingleMetric($colname) {
		$data = array();
		$stmt = $this->mysql->prepare("SELECT ? FROM data WHERE uid = ? LIMIT 40");
		$stmt->bind_param("si", $colname, $this->uid);
		$stmt->execute();
		$stmt->bind_result($p);

		while ($stmt->fetch()) { 
			$data[] = $p;
		}
		$stmt->close();

		return json_encode($data);
	}
	
	public function getMetricOverMetric($top, $bottom) {
		$data = array();
		$stmt = $this->mysql->prepare("SELECT ?, ? FROM data WHERE uid = ? LIMIT 40");
		$stmt->bind_param("ssi", $top, $bottom, $this->uid);
		$stmt->execute();
		$stmt->bind_result($p, $q);

		while ($stmt->fetch()) { 
			$data[] = $p/$q;
		}
		$stmt->close();

		return json_encode($data);
	}
}

?>