<?php 

class EloquentDynamoRepository implements DynamoRepositoryInterface {
	

	public function find_active_dyn_channels()
	{
		return $active_dyn_channels = DynChannel::where('display', '=', '1')->get();
	}

	public function find_channel_options($channel_id)
	{
        return $channel_options = DynChannelAssoc::where('channel_id', '=', $channel_id)->get();
	}

	public function find_dyn_pref($uid, $channel_id)
	{
        return $dyn_pref = DynPref::where('user_id', '=', $uid)->where('channel_id', '=', $channel_id)->first();
	}


	public function assemble_dyn_prefs($uid)
	{
		$active_dyn_channels = $this->find_active_dyn_channels();
		$dyn_pref_collec = new StdClass;
		$dyn_pref_collec->uid = $uid;
		$dyn_pref_collec->prefs = array();

		foreach($active_dyn_channels as $active_dyn_channel) 
		{
			$channel_id = $active_dyn_channel->id;
			$dyn_pref_result = $this->find_dyn_pref($uid, $channel_id);
			if ($dyn_pref_result !== NULL)
			{
				$dyn_pref_collec->prefs[$channel_id] = $dyn_pref_result->country_id;
			}

		}
		return $dyn_pref_collec;

	}

	public function assemble_channels()
	{
		$active_dyn_channels = $this->find_active_dyn_channels();

	    $channel_collec = array();

	    foreach($active_dyn_channels as $active_dyn_channel)
	    {
	        $channel_obj = new StdClass();
	        $channel_obj->channel_id = $active_dyn_channel->id;
	        $channel_obj->code = $active_dyn_channel->channel;
	        $channel_obj->name = $active_dyn_channel->name;
	        $channel_obj->options = array();


	        $channel_options = $this->find_channel_options($channel_obj->channel_id);


	        foreach($channel_options as $channel_option)
	        {
	            foreach( $channel_option->country()->get() as $channel_country)
	            {
	                $option_obj = new StdClass();
	                $option_obj->country_id = $channel_country->id;
	                $option_obj->country_code = $channel_country->code;
	                $option_obj->country_name = $channel_country->name;
	   
	                array_push($channel_obj->options, $option_obj);
	            }
	        }
	        array_push($channel_collec, $channel_obj);
	    }

	    return $channel_collec;

	}

	public function update_dyn_pref($uid, $channel_id, $country_id)
	{
		$dyn_pref = $this->find_dyn_pref($uid, $channel_id);

		if($dyn_pref === NULL)
		{
			return $this->store_dyn_pref($uid, $channel_id, $country_id);
		}


		$dyn_pref->country_id = $country_id;
		$dyn_pref->save();
		return $dyn_pref;

	}

	public function store_dyn_pref($uid, $channel_id, $country_id)
	{
		$dyn_pref = [
			'user_id' => $uid,
			'country_id' => $country_id,
			'channel_id' => $channel_id
		];

		return $result = DynPref::create($dyn_pref);
	}


    public function viewData()
    {
        //Globel settings used to contain all of the dynamo channel data
        $settings = [];
        $index = 1;




        //Gets all channel allowed to be displayed
        //orders them in the display order
        $allchannel = $this->get_channel_info();




        foreach ($allchannel as $channel) {
            //$default_icon="http://upload.wikimedia.org/wikipedia/commons/2/25/Icon-round-Question_mark.jpg";
            //A value can be pass to get a default icon for channels without an image in the db
            $default_icon = "";



            //All details regarding a channel
            $settingsList = [];
            $settingsList['index'] = $index++;
            $settingsList['channel_id'] = $channel->id;
            $settingsList['channel_name'] = $channel->name;
            $settingsList['subtitle'] = $channel->subtitle;
            $settingsList['icon'] = strlen($channel->icon_path) > 0 ? "$channel->icon_path" : $default_icon;
            $settingsList['channel_description'] = $channel->description;


            //user preference for that channel
            $user_pref = $this->get_user_channel_pref(Authenticate::get_uid(), $channel->id);

            if (!is_null($user_pref) && !is_null($user_pref->country)) {
                $settingsList['user_channel'] = !is_null($user_pref) ? $user_pref->country->name : '?';
                $settingsList['user_flag'] = $this->getFlag($user_pref->country->code);
            } else {
                $settingsList['user_channel'] = '?';
            }
            //end of user data

            //All countries associated with specified channel
            $settingsList['country'] = [];
            $prefs = $this->get_channel_options($channel->id);
            foreach ($prefs as $pref) {
                $countryOptions = [];
                $country = DynCountry::find($pref->country_id);

                //this is to avoid error in the database
                //ideally the country should be set
                //but incase it is not we still want to avoid errors for the user
                if (is_null($country))
                    continue;

                $countryOptions['country_id'] = $country->id;
                $countryOptions['country_name'] = $country->name;
                $countryOptions['country_flag'] = $this->getFlag($country->code);
                $countryOptions['content'] = [];


                $urls = $this->get_channel_url($pref->id);


                foreach ($urls as $url) {
                    $countryContentOption = [];
                    if ($url != null) {
                        $channelList = SupportedChannel::where('id', '=' , $url->channel_id)->get()->first();

                        //this is to avoid error in the database
                        //ideally the channelList should be set
                        //but incase it is not we still want to avoid errors for the user
                        if ($channelList == null)
                            continue;


                        $countryContentOption['channel_name'] = $channelList->name;
                        $countryContentOption['channel_url'] = $channelList->channel_url;
                        array_push($countryOptions['content'], $countryContentOption);
                    }
                }


                array_push($settingsList['country'], $countryOptions);
            }
            array_push($settings, $settingsList);

        }
        return $settings;

        /*
         *Array push is used to group all channel and it's details into one index
         * this index is the looped through in the view
         * */
    }

    public function get_channel_info()
    {
        $channel_info = DynChannel::where('display', 1)->orderBy('display_order')->get();
        return $channel_info;
    }

    public function get_user_channel_pref($uid, $dynchannel_id)
    {
        $pref = DynPref::where('user_id', $uid)->where('channel_id', $dynchannel_id)->first();
        return $pref;
    }

    public function getFlag($country_code)
    {
        //default location of the view
        $flag_icon_folder="/assets/images/flags/";

        return URL::asset( $flag_icon_folder. $country_code . ".png");
    }

    public function get_channel_options($dynChannel_id)
    {
        return DynChannelAssoc::where('channel_id', $dynChannel_id)->get();
    }

    public function get_channel_url($dyn_channel_assoc_id)
    {
        return ChannelUrl::where('dyn_channel_assoc_id', $dyn_channel_assoc_id)->get();
    }


    public function process_ajax($uid, $channel, $country_id, $server_code)
    {
        $pref = DynPref::where('user_id', '=', $uid)->where('channel_id', '=', $channel)->first();


        if ($pref == null) {
            $pref = DynPref::create(['channel_id' => $channel, 'country_id' => $country_id, 'user_id' => $uid]);
        } else {
            $pref->country_id = $country_id;
        }


        $pref->save();


        $country = DynCountry::find($country_id);

        $message = [];
        $message['status'] = 1;
        $message['server_code']=$server_code;
        $message['html_replacement'] = HTML::image($this->getFlag($country->code)) . " $country->name";
        $message['feedback'] = ucfirst(DynChannel::find($channel)->name) . " has been updated to ". ucwords($country->name);
        return $message;
    }

    public function process_normal_update($uid, $channel, $country)
    {
        $pref = DynPref::where('user_id', '=', $uid)->where('channel_id', '=', $channel)->first();

        if ( $pref == null ) {
            $pref = DynPref::create(['channel_id' => $channel, 'country_id' => $country, 'user_id' => $uid]);
        } 
        else {
            $pref->country_id = $country;
        }

        if( !$pref->save() ){
            return $success=FALSE;
        }

        return TRUE;     
    }

    public function get_all_dyn_channels() {
        $dyn_channels = DynChannel::where('display', '=', '1')->get();
        if($dyn_channels->first() === NULL) {
            $error_id = uniqid();
            Log::error('Fatal: get_all_dyn_channels() is empty.', [
                'error_id' => $error_id,
                'uri' => Request::path()
            ]);
            throw new Exception('Fatal: Dynamo Channel list is empty.');
        }
        return $dyn_channels;
    }

    public function get_user_dyn_prefs($uid) {
        return DynPref::where('user_id', '=', $uid)->get();
    }

    public function construct_dyn_channels_obj($uid) {
        $dyn_channels = $this->get_all_dyn_channels();


        $user_dyn_prefs = $this->get_user_dyn_prefs($uid);

        $dyn_channel_objects = [];

        foreach($dyn_channels as $dyn_channel) {
            $dyn_channel->dyn_countries = $dyn_channel->dyn_countries()->get();

            $dyn_channel_obj = new StdClass();
            $dyn_channel_obj->dyn_channel_id = $dyn_channel->id;
            $dyn_channel_obj->dyn_channel_name = $dyn_channel->name;
            $dyn_channel_obj->dyn_channel_display_order = $dyn_channel->display_order;
            $dyn_channel_obj->dyn_channel_subtitle = $dyn_channel->subtitle;
            $dyn_channel_obj->dyn_channel_description = $dyn_channel->description;
            $dyn_channel_obj->dyn_channel_icon_path = $dyn_channel->icon_path;
            $dyn_channel_obj->dyn_countries = [];

            foreach($dyn_channel->dyn_countries as $dyn_country) {
                $dyn_country_obj = new StdClass();
                $dyn_country_obj->dyn_country_id = $dyn_country->id;
                $dyn_country_obj->dyn_country_name = $dyn_country->name;
                $dyn_country_obj->dyn_country_code = $dyn_country->code;
                $dyn_country_obj->user_pref = 0;


                if($user_dyn_prefs->first() !== NULL) {
                    foreach($user_dyn_prefs as $user_dyn_pref) {
                        if( ($user_dyn_pref->channel_id == $dyn_channel->id) AND 
                            ($user_dyn_pref->country_id == $dyn_country->id) 
                        ) {
                            $dyn_country_obj->user_pref = 1;
                        }
                    }                   
                }

                array_push($dyn_channel_obj->dyn_countries, $dyn_country_obj);
            }

            array_push($dyn_channel_objects, $dyn_channel_obj);
        }

        return $dyn_channel_objects;
    }
}


