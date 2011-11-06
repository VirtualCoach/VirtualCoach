<?

require_once("mysql.php");

class CSV_Handler {

	function parse_file($filename, $uid) {
		global $mysqli;

		$fh = fopen(dirname(__FILE__)."/../classes/uploads/".$filename, "r");
		if (!$fh) {
			# file not found
			return false;
		}

		$index_hash = array("secs" => 0, "kph" => 0, "rpm" => 0, "watts" => 0, "hr" => 0);
		$speed_metric = true;
		define("KM_MI_RATIO", 1.609344);

		$line = fgets($fh);
		$cols = preg_split(",", $line);
		for ($i = 0; $i < count($cols); $i++) {
			$col = str_replace("\"", "", $cols[$i]);

			# standardize time labels
			if (in_array($col, array("t", "sec", "time"))) $col = "secs";
		  
			# standardize speed units
			if (strcmp($col, "mph") == 0) {
				$col = "kph";
				$speed_metric = false;
			}
			if (strcmp($col, "speed") == 0) $col = "kph"; # metric by default

			if (array_key_exists($col, $index_hash)) {
				$index_hash[$col] = $i;
			}
		}
		
		$data = array();

		while (($line = fgets($fh)) !== false) {
			$data[] = str_getcsv($line);
		}

		fclose($fh);

		$stmt = $mysqli->prepare("INSERT INTO data (uid, t, rpm, power, speed, hr) VALUES (?, ?, ?, ?, ?, ?)");

		foreach ($data as $entry) {
			$t = $entry[$index_hash["secs"]];
			$speed = $entry[$index_hash["kph"]];
			if (!$speed_metric) $speed *= KM_MI_RATIO;
			$rpm = $entry[$index_hash["rpm"]];
			$power = $entry[$index_hash["power"]];
			$hr = $entry[$index_hash["hr"]];

			$stmt->bind_param('iddddd', $uid, $t, $rpm, $power, $speed, $hr);
			if (!$stmt->execute()) {
				return false;
			}
		}

		return true; # got this far -> success!
	}

	function validate($filename) {

		$fh = fopen(dirname(__FILE__)."/../classes/uploads/".$filename, "r");
		if (!$fh) {
			return "filenotfound";
		}

		$had_data = false;
		while (($line = fgets($fh)) !== false) {
			if ($line != "\n" and $line != "\r\n") {
				break;
			}
		}
		$categories = get_csv($line);
		$num_cols = count($categories);
		$counts = array("secs" => 0, "kph" => 0, "rpm" => 0, "watts" => 0, "hr" => 0);

		# check categoriy validity
		foreach ($categories as $cat) {
			$temp = $cat;
			if (strcmp($temp, "mph") == 0 or strcmp($temp, "speed") == 0) {
				$temp = "kph";
			}
			if (strcmp($temp, "t") == 0 or strcmp($temp, "time") == 0 or strcmp($temp, "sec") == 0) {
				$temp = "secs";
			}
			$counts[$temp]++;
		}
		
		if ($categories["secs"] != 1) return "invalidheader";
		foreach ($counts as $cat_count) {
			if ($cat_count > 1) {
				return "invalidheader";
			}
		}

		while (($line = fgets($fh)) !== false) {
			$had_data = true;

			# avoid final newlines at end of file
			if ($line == "\n" or $line == "\r\n") continue;

			$data = str_getcsv($line);
			foreach ($data as $item) {
				if (!is_numeric($item)) {
					return "invaliddata";
				}
			}
			
			# fail if not all lines have the same number of list elements
			if (count($data) != $num_cols) {
				return "invalidformat";
			}
		}
		fclose($fh);
		return $had_data ? "success" : "unknown"; # make sure we actually read something
	}
}
?>
