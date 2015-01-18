<?php

class WorldCup2014 extends Eloquent{


    protected $table = "worldcup_2014";
    protected $guarded = ['id'];

    public function select_future_matches($number_of_matches) {
    	return WorldCup2014::whereRaw('match_time > (now() - 7200) ')->limit($number_of_matches)->orderBy('match_time', 'ASC')->get();
    }

    public function supported_channels() {
    	return $this->belongsToMany('SupportedChannel', 'channel_device_rel', 'device_id', 'channel_code');
    }



    public function assemble_matches($number_of_matches) {
    	$matches = $this->select_future_matches($number_of_matches);
    	$my_matches = [];

    	foreach($matches as $match) {
    		$my_match =  new StdClass;

    		$my_match->teams =  explode(',', $match->teams);

    		$channels = explode(';', $match->channel_codes);
    		$date_time = new DateTime($match->match_time, new DateTimeZone('UTC'));

            $current_time = new DateTime();
            $current_time->setTimezone(new DateTimeZone('UTC'));

            $time_till_kickoff = $date_time->diff($current_time)->format('%ad %hh %imin');
            // var_dump($time_till_kickoff);
            // die();
    		$iso_time = $date_time->format($date_time::ISO8601);
    		$iso_time = explode('+', $iso_time);

    		$my_match->match_time = $iso_time[0] . 'Z';

            $my_match->hours_count_down = $time_till_kickoff;
    		$my_match->channels = $channels;


    		array_push($my_matches, $my_match);
    	}
    	return $my_matches;
    }
}