<?php


class LogService{
    const ERROR_FILE="custom_error.log";
    const INFO_FILE="custom_info.log";
    const USER_FILE="user_info.log";
    const DEBUG_FILE="custom_debug.log";



    private static $time_format='d-m-y h:m:s';

    private static $debug_mode=true;
    private static $user_mode=true;
    private static $info_mode=true;
    private static $error_mode=true;

    private static $enabled=false;
    private static $htmlMode=true;
    private static $fileMode='a+';
    private static $logPath="/storage/logs";
    private static $logFile;

    public static function mode(){
        $mode="string";
        if(self::$htmlMode==true){
            $mode="html";
        }
        return $mode;
    }

    public static function get_remote_addr(){
        return isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"";
    }

    public static function get_forwarded_addr(){
        return isset($_SERVER['HTTP_X_FORWARDED_FROM'])?$_SERVER['HTTP_X_FORWARDED_FROM']:"";
    }

    public static function isStringMode(){
        return !self::$htmlMode;
    }

    public static function isHtmlMode(){
        return self::$htmlMode;
    }

    public static function setHtmlMode(){
        self::$htmlMode=true;
    }

    public static function setStringMode(){
        self::$htmlMode=false;
    }

    public static function display ($obj){
        if(!self::$debug_mode) return;

        if(self::$htmlMode) echo "<pre>";

        if(is_array($obj)){
            print_r($obj);
        }

        else if(is_string($obj)){
            echo "$obj";
            if(self::$htmlMode) echo "<br/>";
            else echo "\n";
        }

        else{
            var_dump($obj);
        }
        if(self::$htmlMode) echo "</pre>";
    }

    public static function logPath(){
        return app_path().self::$logPath;
    }

    public static function logFilename(){
        return self::$logFile;
    }

    public static function logFile(){
        return self::logPath()."/".self::logFilename();
    }

    public static function info_log($obj){
        if(!self::$info_mode)return;

        self::$logFile=self::INFO_FILE;
        return self::log($obj);
    }

    public static function user_log($obj){
        if(!self::$user_mode)return;

        self::$logFile=self::USER_FILE;
        return self::log($obj);
    }

    public static function debug_log($obj){
        if(!self::$debug_mode)return;

        self::$logFile=self::DEBUG_FILE;
        return self::log($obj);
    }

    public static function error_log($obj){
        if(!self::$error_mode)return;

        self::$logFile=self::ERROR_FILE;
        return self::log($obj);
    }

    private static function log($obj){
        self::check_file();
        $file=fopen(self::logFile(),self::$fileMode);
        if(is_string($obj)){
            fwrite($file,$obj);
        }else if(is_array($obj)){
            $content=print_r($obj,true);
            fwrite($file,$content);
        }else{
            ob_start();
            var_dump($obj);
            $content = ob_get_clean();
            fwrite($file,$content);
        }
        fwrite($file,"\n".self::getTime()."~|~\n");
        fclose($file);
    }

    private static function check_file(){
        if(!file_exists(self::logPath())){
            //mkdir(self::logPath(), 0755, true);
            self::$fileMode="w+";
        }else{
            self::$fileMode="a+";
        }
    }

    public static function getTime(){
        return date(self::$time_format, time());
    }



}