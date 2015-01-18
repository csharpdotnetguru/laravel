<?php namespace FrontEnd\V2;

use BaseController;
use Input;
use MiscRepositoryInterface as MiscInterface;
use View;
use Response;
use Authenticate;
use FavouriteChannel;

class ChannelController extends BaseController
{

    public function __construct(MiscInterface $misc_interface)
    {
        $this->misc_interface = $misc_interface;
    }

    public function index()
    {
        $all_channels = $this->misc_interface->get_all_channels();
        return View::make('v2.frontend.channels.index')
            ->with('all_channels', $all_channels);
    }

    public function get_modal()
    {
        $channel_code = Input::get('item_id');
        $channel_object = $this->misc_interface->get_channel_object($channel_code);

        $dyn_countries_string = $channel_object->dynamo_country;
        $dyn_countries_array = explode(",", $dyn_countries_string);

        // checks if logged in
        if (Authenticate::is_logged_in()) {
            // checks if marked as favourite
            $uid = Authenticate::get_uid();
            $favourited = FavouriteChannel::where('user_id', $uid)->where('channel_id', $channel_object->id)->first();
            $is_favourited = ($favourited) ? true : false;
        } else {
            $is_favourited = false;
        }

        return View::make('v2.frontend.channels.modal',
            compact('channel_object', 'dyn_countries_string', 'dyn_countries_array', 'is_favourited'));
    }

    public function mark_favourite($channel_code)
    {
        $uid = Authenticate::get_uid();
        $channel = $this->misc_interface->get_channel_object($channel_code);

        // preparing json response
        $response = [
            'success' => false,
            'channel_code' => $channel_code,
            'is_favourited' => false
        ];

        if ($uid && $channel) {

            $favourited = FavouriteChannel::where('user_id', $uid)->where('channel_id', $channel->id)->first();

            // if favourited, delete record
            if ($favourited) {
                $response['success'] = true;
                $favourited->delete();
            } else {
                // else, create a new favouritechannel object
                $response['success'] = true;
                $response['is_favourited'] = true;

                $favourited = new FavouriteChannel;
                $favourited->user_id = $uid;
                $favourited->channel_id = $channel->id;
                $favourited->save();
            }
        }

        return Response::json($response);
    }

}