<?php

namespace App\Http\Controllers;

use App\Models\GoalInformation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result = GoalInformation::get_latest_goal(1);
        return view('home')->with("goal_info",$result);
    }
}
