<?php

namespace myclass;


class Val {


	public static function name($value) {
		if( isset($value) && !empty($value) ) {
			return true;
		}
	}

	public static function emailValid($value) {
		if ( filter_var($value, FILTER_VALIDATE_EMAIL) ) {
			return true;
		}
	}

	public static function emailExist($email) {
		if( count($email) == 0 ) {
			return true;
		}
	}


	public static function date($value) {
		if( self::name($value) ) {
			if( is_object(\DateTime::createFromFormat('Y-m-d',$value)) ) {
				return true;
			}
		}
	}

	public static function password($value) {
		if( self::name($value) ) {
			if( strlen($value) > 5 ){
				return true;
			}
		}
	}

	public static function time($value) {
		if(self::name($value)) {
			if( is_object(\DateTime::createFromFormat('H:i',$value)) ) {
				return true;
			}
		}
	}
}