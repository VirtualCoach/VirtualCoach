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

		$line = fgets($fh);
		$data = array();

		while (($line = fgets($fh)) !== false) {
			$data[] = str_getcsv($line);
		}

		fclose($fh);

		$stmt = $mysqli->prepare("INSERT INTO data (uid, t, rpm, power, speed, hr) VALUES (?, ?, ?, ?, ?, ?)");

		foreach ($data as $entry) {
			$t = $entry[0];
			$speed = $entry[1];
			$rpm = $entry[2];
			$power = $entry[3];
			$hr = $entry[4];

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
		$line = fgets($fh);
		$num_cols = count(str_getcsv($line));

		while (($line = fgets($fh)) !== false) {
			$had_data = true;

			# avoid final newlines at end of file
			if ($line == "\n" or $line == "\r\n") continue;

			$data = str_getcsv($line);
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