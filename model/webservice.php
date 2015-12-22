<?php
class webservice{
	function returnData($data){
		$auxiliar = array();
		foreach ($data as $key => $value) {
			if(is_array($value))
			{
				$auxiliar[utf8_encode($key)] = $value;
			}
			else
			{
				$auxiliar[utf8_encode($key)] = utf8_encode($value);
			}
		}
		echo json_encode((object)$auxiliar);
	}
	function getToken($table,$campo,$uc=TRUE,$n=TRUE,$sc=TRUE)
	{
		$db = new db_core();
	    $source = 'abcdefghijklmnopqrstuvwxyz';
	    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    if($n==1) $source .= '1234567890';
	    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
	    $rstr = "";
    	while(true)
    	{
	        $rstr = "";
	        $source = str_split($source,1);
	        for($i=1; $i<=15; $i++){
	            mt_srand((double)microtime() * 1000000);
	            $num = mt_rand(1,count($source));
	            $rstr .= $source[$num-1];
	        }
	        if(!$db->isExists($table,$campo,$rstr))
	        {
	        	break;
	        }
    	}
	    return sha1($rstr);
	}
	function get_admin_id(){
		$db = new db_core();
		$consulta = $db->reg_one("SELECT * FROM admin_log INNER JOIN users_admin ON admin_log.admin_log_id = users_admin.id_user WHERE admin_log.token='".$_SESSION['token_admin']."'");
		return $consulta[0];
	}
}
?>