<?php
    class ExtendedBase extends BaseController{
        private static $debugAllow=false;
        private static $debug=true;
        protected $defaultMsg="User doesn't exist";
        public static function startDebug(){
            ExtendBase::$debug=true;
        } 
        public static function stopDebug(){
            return self::$debug=false;
        }
        public static function debug(){
            if(self::$debugAllow)
                return self::$debug;
            else{
                return false;
            }
        }
        public function safe($uid){
            if($uid!=null){
                return true;
            }else{
                return false;
            }
        }
    }
?>