<?php

use NetworkRepositoryInterface as NetworkInterface;
use SubRepositoryInterface as SubInterface;
use MiscRepositoryInterface as MiscInterface;

class StaticPageController extends BaseController
{
    public function __construct(
        NetworkInterface $network_interface, 
        SubInterface $sub_interface,
        MiscInterface $misc_interface
        )

    {
        $this->network_interface=$network_interface;
        $this->sub_interface = $sub_interface;
        $this->misc_interface = $misc_interface;
    }


    public function index()
    {
        $title = "UnoTelly - QuickStart";

        $param = Input::all();
        $uid = Authenticate::get_uid();
        $email = Session::get('email');
        $sub_info = $this->sub_interface->find_sub_info_legacy($uid);
        $unovpn_pw = $this->sub_interface->find_unovpn_pw($email);
        $unovpn_expiry = $this->sub_interface->find_unovpn_expiry($email);

        $has_vpn = TRUE;

        if ($unovpn_expiry === NULL OR $unovpn_pw === NULL)
        {
            $has_vpn = FALSE;
        }
        
        if ($sub_info === NULL)
        {
            $expiry_date = 'N/A';
            $sub_status = 'N/A';
        }
        else {
            $expiry_date = $sub_info['expiry_date'];
            $sub_status = $sub_info['status'];     
        }



        if ( isset($param['origin']) AND $uid !== -1) {
            
            $this->network_interface->update_first_active_network($uid);

        } else {
            $param['origin'] = null;
        }

        return View::make('static.index')
            ->with('uid', $uid)
            ->with('title', $title)
            ->with('origin', $param['origin'])
            ->with('home','active')
            ->with('email', $email)          
            ->with('expiry_date', $expiry_date)
            ->with('sub_status', $sub_status)
            ->with('unovpn_pw', $unovpn_pw)
            ->with('unovpn_expiry', $unovpn_expiry)
            ->with('has_vpn', $has_vpn);
    }



    public function reviews_index() 
    {
        $reviews = $this->misc_interface->get_all_reviews();
        return View::make('frontend.reviews.index')
            ->with('reviews', $reviews);
    }
}