<?php

namespace app\lib;

class config{
    private static $inst = NULL;

	private $data = [];
	
	private function __construct(){}
	
	public static function inst(){
		if(self::$inst == NULL){
			self::$inst = new config;
		}
		return self::$inst;
	}
	
	public function __set($key,$value){
		$this->data[$key] = $value;
	}
	
	public function __get($key){
		if( isset($this->data[$key])){
			return  $this->data[$key];
		}
		return false;
	}

}