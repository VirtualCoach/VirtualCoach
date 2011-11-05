<?
require_once 'DataSource.php';

class CSV_Handler {

  private $db_conn;

  function __construct($dbhost, $dbname, $dbuser, $dbpass) {
    # create the database connection
    $this->db_conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    # handle connection failure
    if (mysqli_connect_errno()) {
      $db_conn = null;
      die("Connect failed: ". mysqli_connect_error());
    }
  }
  
  function __destruct() {
    # close the database connection
    $db_conn->close();
  }
  
  function parse_file($filename, $uid) {
  
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
      
      $stmt->execute();
    }
  }
}
?>

