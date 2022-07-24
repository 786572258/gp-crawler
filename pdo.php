<?php

class MysqlPdo {
	public static $dsn;
	public static $user;
	public static $password;
	public static $charset = '';
	public static $stmt = null;
	public static $DB = null;
	public static $connect = true;
	public static $debug = false;
	private static $parms = array ();
	private static $sql_debug;	//当前执行的一条sql语句 

	public function __construct($dsn,$user,$password) {
		self::$connect = true;
		self::$charset = 'UTF8';
		try {
			self::$DB = new PDO ($dsn, $user, $password);
		} catch ( PDOException $e ) {
			die ( "Connect Error Infomation:" . $e->getMessage () );
		}
		self::$DB->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
		self::$DB->setAttribute ( PDO::ATTR_EMULATE_PREPARES, true );
		self::execute ( 'SET NAMES ' . self::$charset );
	}
	
	public function __destruct() {
		self::close ();
	}
	
	public function close() {
		self::$DB = null;
	}
	
	public function quote($str) {
		return self::$DB->quote ( $str );
	}
	
	public function getFields($table) {
		self::$stmt = self::$DB->query ( "DESCRIBE $table" );
		$result = self::$stmt->fetchAll ( PDO::FETCH_ASSOC );
		self::$stmt = null;
		return $result;
	}
	
	public function getLastId() {
		return self::$DB->lastInsertId ();
	}
	
	public function execute($sql) {
		self::getPDOError ( $sql );
		//错误返回false(php要用$??===false 来判断！！), 没有行数受到影响返回0
        $r = self::$DB->exec ( $sql );
        if (self::$DB->errorCode() != "0000000000" && self::$DB->errorCode() != "00000" && self::$DB->errorCode() != "") {
            throw new Exception(json_encode(self::$DB->errorInfo()));
        }
        return $r;
	}
	
	private function getCode($table, $args) {
		$code = '';
		if (is_array ( $args )) {
			foreach ( $args as $k => $v ) {
				if ($v == '') {
					 continue;
				}
				$code .= "`$k`='$v',";
			}
		}
		$code = substr ( $code, 0, - 1 );
		return $code;
	}
	
	
	public function optimizeTable($table) {
		$sql = "OPTIMIZE TABLE $table";
		self::execute ( $sql );
	}
	
	private function _fetch($sql, $type) {
		$result = array ();
		self::$stmt = self::$DB->query ( $sql );
		self::getPDOError ( $sql );
		self::$stmt->setFetchMode ( PDO::FETCH_ASSOC );
		switch ($type) {
			case '0' :
			$result = self::$stmt->fetch ();
		break;
			case '1' :
			$result = self::$stmt->fetchAll ();
		break;
		case '2' :
			$result = self::$stmt->rowCount ();
			break;
		}
		self::$stmt = null;
		return $result;
	}
	
	/**
	* 參数:$db->insert('$table',array('title'=>'Zxsv'))
	*/
	public function insert($table, $args,$debug=0) {
		$sql = "INSERT INTO `$table` SET ";
		$code = self::getCode ( $table, $args );
		$sql .= $code;
		//echo $sql;
		if(!$debug){
            return self::execute ( $sql );
        }else{
			return	self::sqlError ("","", $sql );
		}
	}
	
	public function update($table, $args, $where) {
		if(is_array($where)){
            $where = implode(' and ', $where);
        }
		$sql = "UPDATE `$table` SET ";
		if(is_array($args)){
			$code = self::getCode ( $table, $args );
		}else{
			$code = $args;	
		}
		$sql .= $code;
		$sql .= " Where $where";
		//echo "SQL:".$sql;exit;
		$this -> sql_debug = "<font color='blue'>更新(UPDATE): </font>".$sql; //调试
		return self::execute ( $sql );
	}
	
	public function delete($table, $where) {
		$sql = "DELETE FROM `$table` Where $where";
//		$this -> sql_debug = "<font color='red'>删除(delete): </font>".$sql; //调试
		return self::execute ( $sql );
	}
	
	public function fetOne($table, $field = '*', $where = false) {
		if(is_array($where)){
            $where = implode(' and ', $where);
        }
		$sql = "SELECT {$field} FROM `{$table}`";
		$sql .= ($where) ? " WHERE $where " : '';
		
		$this -> sql_debug = "<font color='yellow'>查询(fetOne): </font>".$sql; //调试
		return self::_fetch ( $sql, $type = '0' );
	}
	
	public function fetAll($table, $field = '*', $orderby = false, $where = false,$limit = false) {
		if(is_array($where)){
            $where = implode(' and ', $where);
        }
		$sql = "SELECT {$field} FROM `{$table}`";
		$sql .= ($where) ? " WHERE $where" : '';
		$sql .= ($orderby) ? " ORDER BY $orderby" : '';
		$sql .= ($limit) ? " LIMIT $limit" : '';
		return self::_fetch ( $sql, $type = '1' );
	}
	
	public function getOne($sql) {
		$this -> sql_debug = "<font color='pink'>查询(getOne): </font>".$sql; //调试
		return self::_fetch ( $sql, $type = '0' );
		
	}
	
	public function getRow($sql) {
		$this -> sql_debug = "<font color='pink'>查询(getOne): </font>".$sql; //调试
		return self::_fetch ( $sql, $type = '0' );
	}
	
	public function getAll($sql) {
		$this -> sql_debug = "<font color='gray'>查询(getAll): </font>".$sql; //调试
		return self::_fetch ( $sql, $type = '1' );
	}
	
	public function scalar($sql, $fieldname) {
		$row = self::_fetch ( $sql, $type = '0' );
		return $row [$fieldname];
	}
	
	public function fetRowCount($table, $field = '*', $where = false) {
		$sql = "SELECT COUNT({$field}) AS num FROM $table";
		$sql .= ($where) ? " WHERE $where" : '';
		return self::_fetch ( $sql, $type = '0' );
	}
	
	public function getRowCount($sql) {
		return self::_fetch ( $sql, $type = '2' );
	}
	
	//增删改
	public function query($sql) {
		//echo $sql;
		$res = self::execute($sql);
		/*if($res=='') {
			self::getPDOError($sql);
		}*/
		$this -> sql_debug = "<font color='blue'>query(增删改): </font>".$sql; //调试
		return $res;
	}
	
	//获取当前执行的sql语句
	public function getSql() {
		return $this -> sql_debug . "<br />";
	}
	
	public function setDebugMode($mode = true) {
		return ($mode == true) ? self::$debug = true : self::$debug = false;
	}
	
	private function getPDOError($sql) {
		self::$debug ? self::errorfile ( $sql ) : '';
		if (self::$DB->errorCode () != '00000') {
			$info = (self::$stmt) ? self::$stmt->errorInfo () : self::$DB->errorInfo ();
			echo (self::sqlError ( 'mySQL Query Error', $info [2], $sql ));
			exit ();
		}
	}
	
	private function getSTMTError($sql) {
		self::$debug ? self::errorfile ( $sql ) : '';
		if (self::$stmt->errorCode () != '00000') {
			$info = (self::$stmt) ? self::$stmt->errorInfo () : self::$DB->errorInfo ();
			echo (self::sqlError ( 'mySQL Query Error', $info [2], $sql ));
			exit ();
		}
	}
	
	private function errorfile($sql) {
		echo $sql . '<br />';
		$errorfile = PATH . './dberrorlog.log';
		$sql = str_replace ( array (
			"\n",
			"\r",
			"\t",
			"  ",
			"  ",
			"  "
		), array (
			" ",
			" ",
			" ",
			" ",
			" ",
			" "
		), $sql );
		if (! file_exists ( $errorfile )) {
			$fp = file_put_contents ( $errorfile, "<?PHP exit('Access Denied'); ?>\n" . $sql );
		} else {
			$fp = file_put_contents ( $errorfile, "\n" . $sql, FILE_APPEND );
		}
	}
	
	private function sqlError($message = '', $info = '', $sql = '') {
		$html = '';
		if ($message) {
			$html .=  $message .'------------';
		}
		if ($info) {
			$html .= 'SQLID: ' . $info .'------------';
		}
		if ($sql) {
			$html .= 'ErrorSQL: ' . $sql .'------------';
		}
		throw new Exception($html);
	}
	
}
?>