<?php
//error_reporting(0);

Class ConnectDB {
    protected $servername = "localhost";
    protected $dbname = "paowifi";
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
			//echo "<b><font color=red>Connection</b> <br>";
			//return true;
        }
        catch(PDOException $e) {
            echo "<b><font color=red>Connection failed: " . $e->getMessage()."</font></b>";
        }
    }
	// ปิดการทำงาน MYSQL //
    public function DisConnectDB() {
        $this->DB = null;
    }

	 // เพิ่มข้อมูล ///
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

    // อัพเดตข้อมูล ///
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


    // ลบข้อมูล //
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

  // หาจำนวนแถว gruoup //
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
	 // เลือกจำนวนข้อมูลมาแสดง1 //
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
    // เลือกจำนวนข้อมูลมาแสดง //
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
    // เลือกจำนวนข้อมูลมาแสดงทั้งหมดคำสั่งเดียว  คืนค่าเป็น Array //
     function select_query_All($sql="sql"){
       //  $this->data_query = $this->DB->query($sql);
          $this->data_query = $this->DB->prepare($sql);
          $this->data_query->execute();

         $fetch =  $this->data_query->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;

    }

    // หาจำนวนจาก แถว  //
    function rows($sql="sql"){
        // $this->data_query = $this->DB->exec($sql);
      if ($res = $sql->rowCount()){
            return $res;
        }else{
          //  $this->_error();
            return false;
        }
    }


    // ดึงค่ามาแสดงทีละแถว ////
    function fetch($sql="sql"){
        $results =  $sql->fetch(PDO::FETCH_ASSOC);
      if ($results){
            return $results;
        }else{
           // $this->_error();
            return false;
        }
    }

    // แสดง Error ///
    function _error(){
      echo ($this->DB->errorInfo());
    }

  // หา id ล่าสุดที่พึงเพิ่มไป //
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
      // หา id ล่าสุดที่พึงเพิ่มไป //
    function new_insert_id(){
        return $this->DB->lastInsertId();
    }
	//หาจำนวน//
function rows_num($sql="sql"){
    $this->data_query=$this->DB->prepare($sql); 
    $this->data_query->execute();
   $count=$this->data_query->rowCount();
   return  $count;
}
}

?>
