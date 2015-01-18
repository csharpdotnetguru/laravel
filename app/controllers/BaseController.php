<?php



class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

    public static $count=0;

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function getInput(){
        // leave ::get() there otherwise it'll break updateAjax
        $input=Input::get();
        unset($input['_method']);
        unset($input['_token']);
        unset($input['submit']);
        foreach($input as $key=>$value){
            if(strpos($key,'admin')!==false){
                unset($input[$key]);
            }
        }
        return $input;
    }

    protected function tempStore($key,$value=null){
        if(Session::has($key)){
            return Session::get('$key');
        }else{
            return null;
        }
    }

    protected function print_array($array,$class='message'){
        if(self::$count==0)$string="<div class=\"$class\">";
        else $string="";

        self::$count++;
        foreach($array as $val){
           if(is_array($val)){
               $string.=$this->print_array($val);
           }else{
               if(!is_string($val)&&!is_numeric($val))continue;
               $string.='<div class="item">'.$val.'</div>';
           }
        }
        self::$count--;
        if(self::$count==0) $string.="</div>";
        return $string;
    }

    /* Will var_dump  return in a pre format */
    protected function die_d($array)
    {
        echo "<pre>";
        var_dump($array);
        echo "</pre>";
        die();
    }
}