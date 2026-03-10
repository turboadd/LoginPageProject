
<?php
error_reporting(0);
@session_start();
Class ConnectDB {
    protected $servername = "localhost";
    protected $dbname = "mikrotik4";
    protected $username = "root";
    protected $password = "channarong2499";
    public $DB = null;

    function ConnectDB() {
        try {
            $this->DB = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //echo "Connected successfully"; 
        }
        catch(PDOException $e) {
            echo "<b><font color=red>Connection failed: " . $e->getMessage()."</font></b>";
        }
    }

    public function CloseConnectDB() {
        $this->DB = null;
    }
}
