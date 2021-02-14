<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalInformation extends Model
{
    use HasFactory;
    // name, email, passwordカラムにデータの挿入を許可する
    protected $fillable = [
        'title', 
        'start_date',
        'end_date',
        'progress_status',
        'setting_status',
        'count_flg',
    ];

     /**
     * 目標を追加する
     */
    static function insert_goal($insert_request) {
        $result = \DB::table('goal_information')->insert([
            'personal_id' => $insert_request['personal_id'],
            'title' => $insert_request['title'],
            'start_date' => null,
            'end_date' => null,
            'progress_status' => '0',
            'setting_status' => '1',
            'count_flg' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $result;
    }

    /**
     * 目標を更新する
     */
    public static function update_goal($update_request) {
        $result = \DB::table('goal_information')
            ->where('goal_information_id', $update_request['goal_information_id'])
            ->update([
                'title' => $update_request['title'],
                'start_date' => $update_request['start_date'],
                'end_date' => $update_request['end_date'],
        ]);
        return $result;
    }

    /**
     * 最新の目標を取得する
     */
    public static function get_latest_goal($personal_id) {
        $result = \DB::table('goal_information')
            ->where([
                ['personal_id', $personal_id],
            ])
            ->orderByRaw('created_at DESC')
            ->get()->first();
        return $result;
    }
    /**
     * 目標を全て取得する
     */
    public static function get_all_goal($personal_id, $goal_information_id) {
        $result = \DB::table('goal_information')
            ->where([
                ['personal_id', $personal_id],
                ['goal_information_id', "!=",$goal_information_id],
            ])
            ->orderByRaw('goal_information_id DESC')
            ->get();
        return $result;
    }

    /**
     * 対象の目標を取得する
     */
    public static function get_goal_by_goal_information_id($goal_information_id) {
        $result = \DB::table('goal_information')
                ->where([
                    ['goal_information_id', $goal_information_id],
                ])
                ->get()->first();
        return $result;
    }

    /**
     * 目標達成ボタン押下
     */
    public static function count_target_goal($goal_information_id) {

        $res_goal_information=self::get_goal_by_goal_information_id($goal_information_id);
        if(empty($res_goal_information->start_date)){
            $result = \DB::table('goal_information')
                ->where('goal_information_id', $goal_information_id)
                ->update([
                    'count_flg' => 1,
                    'start_date' => now(),
                    'progress_status'=> 1,//継続中
                ]);
        }else{
            $result = \DB::table('goal_information')
            ->where('goal_information_id', $goal_information_id)
            ->update([
                'count_flg' => 1,
            ]);
        }
        return $result;
    }
}
