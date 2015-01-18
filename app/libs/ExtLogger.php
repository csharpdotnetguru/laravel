<?php namespace UnoTelly;

use Gelf;
use Request;
use Config;
use App;

class ExtLogger {

	public function __construct() {
		$this->logger_server = Config::get('app.graylog_server');
		$this->transport = new Gelf\Transport\UdpTransport($this->logger_server);
		$this->publisher = new Gelf\Publisher();
		$this->publisher->addTransport($this->transport);
		$this->message = new Gelf\Message();
		if (App::environment('development')) {
        	$this->facility = Config::get('app.facility'). ':' . 'development';
        }
        else if(App::environment('staging')) {
        	$this->facility = Config::get('app.facility'). ':' . 'staging';
        } else {
        	$this->facility = Config::get('app.facility'). ':' . 'production';
        }
	}

	public function log_message($level, $short_message, $full_message) {
		$this->message->setShortMessage($short_message)
			->setLevel($level)
			->setFullMessage($full_message)
			->setFacility($this->facility);
		$this->publisher->publish($this->message);
	}

	public function get_basic_info() {
		if(isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		else {
			$ip = 'Missing_User_IP';
		}

	    if(isset($_SERVER['HTTP_USER_AGENT'])) {

	    	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	    }
	    else {
	    	$user_agent = 'Missing_User_Agent';
	    }

		$uri = Request::path();
		$method = Request::method();

		return compact('ip', 'user_agent', 'uri', 'method');
	}
}