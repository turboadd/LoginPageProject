<?php
class DB{
    // เชื่อมต่อฐานข้อมูล //
    var $host  ;
    var $database ;
    var $connect_db ;
    var $selectdb ;
    var $db ;
    var $sql ;
    var $table ;
    var $where;
    var $data_query;

    // ติดต่อฐานข้อมูล //
    function connectdb($host="host",$db_name="database",$user="username",$pwd="password"){
	  try {
		$this->host = $host;
        $this->database = $db_name;
        $this->username = $user;
        $this->password = $pwd;
    $this->connect_db = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset=utf8', $this->username, $this->password);
        $this->connect_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $this->connect_db->exec("set names utf8");

        if($this->connect_db) return true;
	  }
      catch(PDOException $e) {
            echo "<b><font color=red>Connection failed: " . $e->getMessage()."</font></b>";
        }
    }

     // ปิดการทำงาน MYSQL //
    function closedb( ){
        $this->connect_db =null;
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
        $this->data_query = $this->connect_db->prepare($sql);
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

       // $this->data_query = $this->connect_db->exec($sql);
         $this->data_query = $this->connect_db->prepare($sql);
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

      //  $this->data_query = $this->connect_db->exec($sql);

        $this->data_query = $this->connect_db->prepare($sql);
        $this->data_query->execute();

        if ($this->data_query){
            return true;
        }else{
            $this->_error();
            return false;
        }
    }

  // หาจำนวนแถว //
    function num_rows($table="table",$field="field",$where="where") {
        if ($where=="") {
            $where = "";
        } else {
            $where = " WHERE ".$where;
        }
        $sql = "SELECT ".$field." FROM ".$table.$where;
     //   $this->data_query = $this->connect_db->query($sql);

         $this->data_query = $this->connect_db->prepare($sql);
        $this->data_query->execute();

        if($this->data_query){
            return $this->data_query->rowCount();
        }else{
            $this->_error();
            return false;
        }
    }

    // เลือกจำนวนข้อมูลมาแสดง //
    function select_query($sql="sql"){
       //  $this->data_query = $this->connect_db->query($sql);
          $this->data_query = $this->connect_db->prepare($sql);
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
       //  $this->data_query = $this->connect_db->query($sql);
          $this->data_query = $this->connect_db->prepare($sql);
          $this->data_query->execute();

         $fetch =  $this->data_query->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;

    }

    // หาจำนวนจาก แถว  //
    function rows($sql="sql"){
        // $this->data_query = $this->connect_db->exec($sql);
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
      echo ($this->connect_db->errorInfo());
    }

  // หา id ล่าสุดที่พึงเพิ่มไป //
    function lastinsertId($filed="field",$table="table",$where=""){
        $sql = "SELECT ".$filed." FROM ".$table." ";
        if($where!=""){
                $sql .= " WHERE ".$where;
            }
            $sql .= " ORDER BY ".$filed." DESC LIMIT 1";
        $this->data_query = $this->connect_db->prepare($sql);
        $this->data_query->execute();
        $results =  $this->data_query->fetch(PDO::FETCH_ASSOC);
        return   $results[$filed];

    }
      // หา id ล่าสุดที่พึงเพิ่มไป //
    function new_insert_id(){
        return $this->connect_db->lastInsertId();
    }

}

?>
