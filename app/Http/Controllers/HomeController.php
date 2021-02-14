<?php

namespace App\Http\Controllers;

use App\Models\GoalInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $personal_id = Auth::id();
        $latest_goal = GoalInformation::get_latest_goal($personal_id);
        $all_goal = null;
        if(!empty($latest_goal)){
            $all_goal = GoalInformation::get_all_goal($personal_id,$latest_goal->goal_information_id);
        }
        
        return view('home')->with("goal_info", $latest_goal)->with("all_goal_info", $all_goal);
    }
}
