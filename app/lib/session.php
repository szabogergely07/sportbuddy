<?PHP
/**
* Session management
*
*/

namespace app\lib;

class session {
    private static $inst=NULL;
    private $sessionName;
    
    private function __construct(){}

    public static function inst(){
        if(self::$inst == NULL ){
            self::$inst = new session;
        }
        self::$inst->sessStart();
        return self::$inst;
    }

    public function sessStart(){
        if( session_status() != PHP_SESSION_ACTIVE ){
            if( self::$inst->sessionName && isset($_POST[self::$inst->sessionName])){
                session_id($_POST[self::$inst->sessionName]);
            }
            session_start();
            self::$inst->sessionName = session_name();

        }
    }

    public function setLogin(){
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['time'] = new \DateTime('NOW');
    }

    public function checkLogin(int $minute = 0 ){
        if( $this->__get('ip') != $_SERVER['REMOTE_ADDR'] 
            || $this->__get('browser') != $_SERVER['HTTP_USER_AGENT'] ) {
            $this->logout();
            return false;
        }
        if( $minute > 0 ){
            $now = new \DateTime('NOW');
            $now->modify('-'.$minute.' minutes');
            if( $now > $this->__get('time') ){
                $this->logout();
                return false;
            }
            else{
                $_SESSION['time'] = new \DateTime('NOW');
            }
        }
        return true;
    }

    public function logout(){
        session_unset();
        session_destroy();
    }

    public function __set($key,$value){
        $_SESSION[$key] = $value;
    }

    public function __get($key){
       if( isset($_SESSION[$key]) ) return  $_SESSION[$key];
       return false;
    }
}

?>