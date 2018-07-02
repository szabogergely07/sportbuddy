<?php

namespace myclass;




class Val {


	public static function valName($value) {
		if( isset($value) && !empty($value) ) {
			return true;
		}
	}

	public static function valEmailValid($value) {
			if ( filter_var($value, FILTER_VALIDATE_EMAIL) ) {
				return true;
			}
	}

	public static function valEmailExist($value) {
		//$sql = R::getAll("SELECT email from user WHERE email = '$value'");
		$db = new \mysqli('localhost', 'root', '', 'mydb');
        $sql = $db->query("SELECT email from user WHERE email = '$value'")->fetch_all();
           
		if( count($sql) == 0 ) {
			return true;
		}
		$db->close();
	}


	public static function valDate($value) {
		if( self::valName($value) ) {
			if( is_object(\DateTime::createFromFormat('Y-m-d',$value)) ) {
				return true;
			}
		}
	}

	public static function valPassword($value) {
		if( self::valName($value) ) {
			if( strlen($value) > 5 ){
				return true;
			}
		}
	}
}

?>