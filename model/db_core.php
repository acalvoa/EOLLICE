<?php
if(!class_exists('db_config'))
{
	require_once('config.php');
}
class db_core extends db_config
{
	function db_core()
	{
		$this->con = mysql_connect($this->host, $this->user, $this->pass);
		if(!$this->con)
		{
			die("Imposible ejecutar conexion con el servidor mysql, por favor revise los parametros de conexion");
		}
		else
		{
			$sele = mysql_select_db($this->db,$this->con);
			if(!$sele)
			{
				die("Imposible seleccionar la base de datos, revise su configuracion");
			}
		}
	}
	private function use_db($db){
		$sele = mysql_select_db($db,$this->con);
	}
	function db_query($consulta, $db = "*")
	{
		if($db == "*")
		{
			$db = $this->db;
		}
		$this->use_db($db);
		$action = $this->query($consulta);
		if(!$action)
		{
			die("Imposible ejecutar consulta : ".$consulta."<br>".mysql_error($this->con)." en la linea ".mysql_errno($this->con));
		}
		else
		{
			return $action;
		}
	}
	private function query($consulta)
	{
		$action = mysql_query($consulta, $this->con);
		if(!$action)
		{
			die("Imposible ejecutar consulta : ".$consulta."<br>".mysql_error($this->con)." en la linea ".mysql_errno($this->con));
		}
		else
		{
			return $action;
		}
	}
	function select($table,$value,$factor = "", $where = "/", $db = "*"){
		if($db == "*")
		{
			$db = $this->db;
		}
		$cadena = "SELECT  ".$value." FROM ".mysql_real_escape_string($table)." ";
		if($where != "/"){
			$cadena .= " WHERE ";
			foreach($where as $key => $vector){
				$cadena .= mysql_real_escape_string($table).".".mysql_real_escape_string($key)."='".mysql_real_escape_string($vector)."' AND ";
			}
			$cadena = substr($cadena, 0, -5);
		}
		$cadena .= $factor;
		$retorno = $this->db_query($cadena,$db);
		if($retorno)
		{
			return $retorno;
		}
		else
		{
			return false;
		}
	}
	function reg_one($consulta, $db = "*")
	{
		if($db == "*")
		{
			$db = $this->db;
		}
		$action = $this->db_query($consulta, $db);
		if(!$action)
		{
			die("Imposible ejecutar consulta : ".$consulta);
		}
		else
		{
			$result = mysql_fetch_array($action, MYSQL_BOTH);
			return $result;
		}
	}
	function reg_one_assoc($consulta, $db = "*")
	{
		if($db == "*")
		{
			$db = $this->db;
		}
		$action = $this->db_query($consulta, $db);
		if(!$action)
		{
			die("Imposible ejecutar consulta : ".$consulta);
		}
		else
		{
			$result = mysql_fetch_array($action, MYSQL_ASSOC);
			return $result;
		}
	}
	function num_one($consulta, $db = "*")
	{
		if($db == "*")
		{
			$db = $this->db;
		}
		$action = $this->db_query($consulta,$db);
		if(!$action)
		{
			die("Imposible ejecutar consulta : ".$consulta);
		}
		else
		{
			$result = mysql_num_rows($action);
			return $result;
		}
	}
	function insert($table,$value, $db = "*"){
		if($db == "*")
		{
			$db = $this->db;
		}
		$cadena = "INSERT INTO ".mysql_real_escape_string($table)." (";
		foreach($value as $key => $vector){
			$cadena .= "`".mysql_real_escape_string($key)."`,";
		}
		$cadena = substr($cadena, 0, -1);
		$cadena .=") VALUES (";
		foreach($value as $key => $vector){
			$cadena .= "'".mysql_real_escape_string($vector)."',";
		}
		$cadena = substr($cadena, 0, -1);
		$cadena .= ");";
		if($this->db_query($cadena,$db))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function update($table,$value, $where, $db = "*"){
		if($db == "*")
		{
			$db = $this->db;
		}
		$cadena = "UPDATE ".mysql_real_escape_string($table)." SET ";
		foreach($value as $key => $vector){
			$cadena .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($vector)."',";
		}
		$cadena = substr($cadena, 0, -1);
		$cadena .= " WHERE ";
		foreach($where as $key => $vector){
			$cadena .= mysql_real_escape_string($table).".".mysql_real_escape_string($key)."='".mysql_real_escape_string($vector)."' AND ";
		}
		$cadena = substr($cadena, 0, -5);
		if($this->db_query($cadena,$db))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function arithmetic_update($table,$value, $where, $db = "*"){
		if($db == "*")
		{
			$db = $this->db;
		}
		$cadena = "UPDATE ".mysql_real_escape_string($table)." SET ";
		foreach($value as $key => $vector){
			if(intval(mysql_real_escape_string($vector)) < 0)
			{
				$cadena .= "`".mysql_real_escape_string($key)."`=(`".mysql_real_escape_string($key)."`-".abs(intval(mysql_real_escape_string($vector)))."),";
			}
			else
			{
				$cadena .= "`".mysql_real_escape_string($key)."`=(`".mysql_real_escape_string($key)."`+".abs(intval(mysql_real_escape_string($vector)))."),";
			}
		}
		$cadena = substr($cadena, 0, -1);
		$cadena .= " WHERE ";
		foreach($where as $key => $vector){
			$cadena .= mysql_real_escape_string($table).".".mysql_real_escape_string($key)."='".mysql_real_escape_string($vector)."' AND ";
		}
		$cadena = substr($cadena, 0, -5);
		if($this->db_query($cadena,$db))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function isExists($table, $campo, $value, $db = "*"){
		if($db == "*")
		{
			$db = $this->db;
		}
		$consulta = $this->db_query("SELECT * FROM ".mysql_real_escape_string($table)." as t WHERE t.".mysql_real_escape_string($campo)."='".mysql_real_escape_string($value)."'", $db);
		if(mysql_num_rows($consulta) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function isExists_multi($table, $values, $db = "*"){
		if($db == "*")
		{
			$db = $this->db;
		}
		$cadena = "SELECT * FROM ".mysql_real_escape_string($table)." as t WHERE ";
		foreach ($values as $key => $valus) {
			$cadena .= "t.".mysql_real_escape_string($key)."='".mysql_real_escape_string($valus)."' AND ";
		}
		$cadena = substr($cadena, 0, -5);
		$consulta = $this->db_query($cadena, $db);
		if(mysql_num_rows($consulta) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete($table, $campo, $valor, $db = "*")
	{
		if($db == "*")
		{
			$db = $this->db;
		}
		if($this->db_query("DELETE FROM ".mysql_real_escape_string($table)." WHERE ".mysql_real_escape_string($campo)."='".mysql_real_escape_string($valor)."'", $db))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function last_id(){
		return mysql_insert_id($this->con);
	}
}
?>