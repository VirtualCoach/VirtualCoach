<?
// This is the API.

require_once("mysql.php");

class API {
	
	private $uid;
	
	public function __construct($uid) {
		$this->uid = $uid;
		
		// possibly load all of the customer's data
	}
	
	public function getSingleMetric($colname, $points) {
		global $mysqli;
		
		$data = array();
		$stmt = $mysqli->prepare("SELECT ".$colname." FROM data WHERE uid = ?");
		$stmt->bind_param("i", $this->uid);
		$stmt->execute();
		$stmt->store_result();
		$mod_val = $stmt->num_rows / $points;
		$stmt->bind_result($br);
		
		$i = 1;
		$cur = 0;
		while ($stmt->fetch()) {
			$cur += $br;
			if ($i % $mod_val == 0) {
				$data[] = round($cur/$mod_val, 3);
				$cur = 0;
			}
			$i++;
		}
		$stmt->close();

		return json_encode($data);
	}
	
	public function getMetricOverMetric($top, $bottom, $points) {
		global $mysqli;
		$data = array();
		
		$query = "SELECT ".$top.",".$bottom." FROM data WHERE uid = ".$this->uid;
		$result = $mysqli->query($query);
		
		$mod_val = $result->num_rows / $points;
		
		$i = 1;
		$cur = 0;
		while($row = $result->fetch_array(MYSQLI_NUM)) {
			if ($row[1] == 0) continue;
			$cur += $row[0]/$row[1];
			if ($i % $mod_val == 0) {
				$data[] = round($cur / $mod_val, 3);
				$cur = 0;
			}
			$i++;
		}

		return json_encode($data);
	}
	
	public function getPowerCol($colname, $points) {
		global $mysqli;
		
		$data = array();
		$stmt = $mysqli->prepare("SELECT ".$colname." FROM rider_power_profile WHERE uid = ?");
		$stmt->bind_param("i", $this->uid);
		$stmt->execute();
		$stmt->store_result();
		$mod_val = $stmt->num_rows / $points;
		$stmt->bind_result($br);
		
		$i = 1;
		$cur = 0;
		while ($stmt->fetch()) {
			$cur += $br;
			if ($i % $mod_val == 0) {
				$data[] = round($cur/$mod_val, 3);
				$cur = 0;
			}
			$i++;
		}
		$stmt->close();

		return json_encode($data);
	}
}

?>