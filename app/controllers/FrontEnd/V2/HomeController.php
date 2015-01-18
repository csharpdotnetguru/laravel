<?php namespace FrontEnd\V2;

use BaseController;
use View;
use App;
use Agent;
use MiscRepositoryInterface;

class HomeController extends BaseController
{

    public function __construct(MiscRepositoryInterface $misc_interface)
    {
        $this->misc_interface = $misc_interface;
    }

    public function index()
    {
        $is_home = true;

        // serving desktop or mobile splash page
        $view_name = 'v2.frontend.home.' . ((Agent::isMobile()) ? 'mobile' : 'index');

        // fetching testimonials
        $testimonials = $this->misc_interface->get_testimonials(30);

        // NOTE: please see compact() usage as it's the same as:
        // ->withKeyword($param)
        // ->with('keyword', $param)
        // $keyword = $param; compact('keyword')

        return View::make($view_name, compact('is_home', 'testimonials'));
    }

    public function pressReviews()
    {
        $reviews = $this->misc_interface->get_all_reviews();
        return View::make('v2.frontend.home.press_reviews', compact('reviews'));
    }

    public function faqs()
    {
        return View::make('v2.frontend.home.faqs');
    }

    public function signIn()
    {
        return View::make('v2.frontend.home.sign_in');
    }

}