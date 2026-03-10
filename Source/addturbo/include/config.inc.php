<?php
//error_reporting(0);

$menu_hotspot = 1;
$hotspot_script = 0;
$menu_pppoe = 0;
$pppoe_script = 0;
$menu_money = 0;
$hotspot_userman = 0;


$_SESSION['hotspot_cus'] = $menu_hotspot;
$_SESSION['hotspot_script'] = $hotspot_script;
$_SESSION['pppoe_cus'] = $menu_pppoe;
$_SESSION['pppoe_script'] = $pppoe_script;
$_SESSION['money_cus'] = $menu_money;
$_SESSION['hotspot_userman'] = $hotspot_userman;


Class ConnectDB {
    protected $servername = "localhost";
    protected $dbname = "addturbo";
    protected $username = "root";
    protected $password = "CNT6201authen@01";
    public $DB = null;
	
    function ConnectDB() {
        try {
            $this->DB = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //echo "Connected successfully";
			date_default_timezone_set('Asia/Bangkok');
			@session_start();
        }
        catch(PDOException $e) {
            echo "<b><font color=red>Connection failed: " . $e->getMessage()."</font></b>";
        }
    }
	// �Դ��÷ӧҹ MYSQL //
    public function DisConnectDB() {
        $this->DB = null;
    }

	 // ���������� ///
    function add_db($table="table", $data="data"){
        $key = array_keys($data);
        $value = array_values($data);
        $sumdata = count($key);
        for ($i=0;$i<$sumdata;$i++)
        {
            if (empty($add)){
                $add="(";
            }else{
                $add=$add.",";
            }
            if (empty($val)){
                $val="(";
            }else{
                $val=$val.",";
            }
            $add=$add.$key[$i];
            $val=$val."'".$value[$i]."'";
        }
        $add=$add.")";
        $val=$val.")";

        $sql="INSERT INTO ".$table." ".$add." VALUES ".$val;
        $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();

       // echo $sql;
        if ($this->data_query){
            return true;
        }else{
            $this->_error();
            return false;
        }
    }

    // �Ѿവ������ ///
    function update_db($table="table",$data="data",$where="where"){
        $key = array_keys($data);
        $value = array_values($data);
        $sumdata = count($key);
        $set="";
        for ($i=0;$i<$sumdata;$i++)
        {
            if (!empty($set)){
                $set=$set.",";
            }
            $set=$set.$key[$i]."='".$value[$i]."'";
        }
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where;

       // $this->data_query = $this->DB->exec($sql);
         $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();

        if ($this->data_query){
            return true;
        }else{
            $this->_error();
            return false;
        }
    }


    // ź������ //
    function del($table="table",$where="where"){
        $sql="DELETE FROM ".$table." WHERE ".$where;

      //  $this->data_query = $this->DB->exec($sql);

        $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();

        if ($this->data_query){
            return true;
        }else{
            $this->_error();
            return false;
        }
    }

  // �Ҩӹǹ�� gruoup //
    function num_rows($table="table",$field="field",$where="where") {
        if ($where=="") {
            $where = "";
        } else {
            $where = " WHERE ".$where;
        }
        $sql = "SELECT ".$field." FROM ".$table.$where;
     //   $this->data_query = $this->DB->query($sql);

         $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();

        if($this->data_query){
            return $this->data_query->rowCount();
        }else{
            $this->_error();
            return false;
        }
    }
	 // ���͡�ӹǹ���������ʴ�1 //
    function selectquery($sql="sql"){
       //  $this->data_query = $this->DB->query($sql);
          $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();

        if ($this->data_query){
            return $this->data_query->fetch( PDO::FETCH_ASSOC );
        }else{
            $this->_error();
            return false;
        }
    }
    // ���͡�ӹǹ���������ʴ� //
    function select_query($sql="sql"){
       //  $this->data_query = $this->DB->query($sql);
          $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();

        if ($this->data_query){
            return $this->data_query;
        }else{
            $this->_error();
            return false;
        }
    }
    // ���͡�ӹǹ���������ʴ����������������  �׹����� Array //
     function select_query_All($sql="sql"){
       //  $this->data_query = $this->DB->query($sql);
          $this->data_query = $this->DB->prepare($sql);
          $this->data_query->execute();

         $fetch =  $this->data_query->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;

    }

    // �Ҩӹǹ�ҡ ��  //
    function rows($sql="sql"){
        // $this->data_query = $this->DB->exec($sql);
      if ($res = $sql->rowCount()){
            return $res;
        }else{
          //  $this->_error();
            return false;
        }
    }


    // �֧������ʴ������� ////
    function fetch($sql="sql"){
        $results =  $sql->fetch(PDO::FETCH_ASSOC);
      if ($results){
            return $results;
        }else{
           // $this->_error();
            return false;
        }
    }

    // �ʴ� Error ///
    function _error(){
      echo ($this->DB->errorInfo());
    }

  // �� id ����ش���֧����� //
    function lastinsertId($filed="field",$table="table",$where=""){
        $sql = "SELECT ".$filed." FROM ".$table." ";
        if($where!=""){
                $sql .= " WHERE ".$where;
            }
            $sql .= " ORDER BY ".$filed." DESC LIMIT 1";
        $this->data_query = $this->DB->prepare($sql);
        $this->data_query->execute();
        $results =  $this->data_query->fetch(PDO::FETCH_ASSOC);
        return   $results[$filed];

    }
      // �� id ����ش���֧����� //
    function new_insert_id(){
        return $this->DB->lastInsertId();
    }
	//�Ҩӹǹ//
function rows_num($sql="sql"){
    $this->data_query=$this->DB->prepare($sql); 
    $this->data_query->execute();
   $count=$this->data_query->rowCount();
   return  $count;
}
}

?>
