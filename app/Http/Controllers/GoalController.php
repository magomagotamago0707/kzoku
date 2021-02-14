<?php

namespace App\Http\Controllers;

use App\Models\GoalInformation;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    //
    public function edit(Request $request)
    {
        $goal_information_id = $request->input('goal_id');
        $result = GoalInformation::get_goal_by_goal_information_id($goal_information_id);
        if(!empty($result)){
            return view('goal')->with('goal',$result);
        }else{
            return view('goal');
        }
    }

    public function regist()
    {
        return view('goal');
    }

    public function update(Request $request)
    {
        $title = $request->input('title');
        $goal_information_id = $request->input('goal_information_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $update_request = array(
            'goal_information_id' => $goal_information_id ,
            'title' => $title ,
            'start_date' => $start_date ,
            'end_date' => $end_date ,
        );

        // 更新対象の目標を取得する
        $result = GoalInformation::get_goal_by_goal_information_id($update_request['goal_information_id']);

        if(!empty($result->result_end_date)){
            return view('goal')->with('error',"既に完了した目標は更新できません。")->with('goal', $result);
        }

        // 目標を更新する
        if(empty($update_request)){
            // 値が不正だった場合エラーを返す
            return view('goal')->with('error',"目標のタイトルを設定してください。");
        }else{
            // 目標の更新を行う
            $result = GoalInformation::update_goal($update_request);
            if(!empty($result)){
                $result = GoalInformation::get_goal_by_goal_information_id($update_request['goal_information_id']);
                return view('goal')->with('success',"登録が完了しました。")->with('goal', $result);
            }else{
                $result = GoalInformation::get_goal_by_goal_information_id($update_request['goal_information_id']);
                return view('goal')->with('error',"更新を行いませんでした。入力値を確認してください。")->with('goal', $result);
            }
        }
    }

    public function insert(Request $request)
    {
        $title = $request->input('title');
        $goal_information_id = $request->input('goal_information_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $insert_request = array(
            'goal_information_id' => $goal_information_id ,
            'title' => $title ,
            'start_date' => $start_date ,
            'end_date' => $end_date ,
        );
        
        // 登録更新する目標を取得する
        if(empty($insert_request)){
            // 値が不正だった場合エラーを返す
            return view('goal')->with('error',"目標のタイトルを設定してください。");
        }else{
            // 目標の登録を行う
            $result = GoalInformation::insert_goal($insert_request);
            if(!empty($result)){
                $result = GoalInformation::get_latest_goal(1);
                return view('goal')->with('success',"登録が完了しました。")->with('goal', $result);
            }else{
                return view('goal')->with('error',"登録を行いませんでした。入力値を確認してください。")->with('goal', $update_request);
            }
        }
    }

    public function count(Request $request)
    {
        $goal_information_id = $request->input('goal_information_id');
        $result = GoalInformation::count_target_goal($goal_information_id);
        return redirect('/home');
    }
}