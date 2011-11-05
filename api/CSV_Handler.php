<?
require_once 'DataSource.php';

class CSV_Handler {

  private $db_conn;

  function __construct() {
    # probably only want to instantiate this class to call validate in this case
    $this->db_conn = null;
  }

  function __construct($dbhost, $dbname, $dbuser, $dbpass) {
    # create the database connection
    $this->db_conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    # handle connection failure
    if (mysqli_connect_errno()) {
      $db_conn = null;
      return -1;
    }
    
    return 0;
  }
  
  function __destruct() {
    # close the database connection
    $db_conn->close();
  }
  
  function parse_file($filename, $uid) {
  
    # make sure the db connection was initialized
    if ($this->db_conn == null) {
      return -1;
    }
  
    $csv = new File_CSV_DataSource;
    $csv->load($filename);
    $data = var_export($csv->connect());
    
    $stmt = mysqli_prepare("INSERT INTO data (uid, t, rpm, power, speed, hr)
                            VALUES ('".$uid."', ?, ?, ?, ?, ?)");
    $stmt->bind_param('idddd', $t, $rpm, $power, $speed, $hr);
    
    foreach ($data as $entry) {
      $t = $data["secs"];
      $rpm = $data["rpm"];
      $power = $data["watts"];
      $speed = $data["kph"];
      $hr = $data["hr"];
      
      # return -1 if the sql query fails
      if (!$stmt->execute()) {
        return -1;
      }
    }
    
    return 0; # got this far -> success!
  }
  
  function validate($filename) {
    
    $fh = fopen($filename, "r");
    if (!$fh) {
      # file not found
      return false;
    }
    
    $had_data = false;
    $line = fgets($fh);
    $num_cols = count(preg_split(',', $line));
        
    while (($line = fgets($fh)) !== false) {
      $had_data = true;
      $data = preg_split(',', $line);
      
      # fail if not all lines have the same number of list elements
      if (count($data) != $num_cols) {
        return false;
      }
      
      foreach (preg_split(',', $line) as $entry) {
        if (!is_numeric($entry)) {
          return false;
        }
      }
    }
    
    fclose($fh);
    return $had_data; # make sure we actually read something
  }
}
?>

