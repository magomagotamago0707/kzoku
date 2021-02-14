<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalInformation extends Model
{
    use HasFactory;
    // name, email, passwordカラムにデータの挿入を許可する
    protected $fillable = [
        'name', 'email', 'password',
    ];

     /**
     * 目標を追加する
     */
    static function insert_goal($update_request) {
        $result = \DB::table('goal_information')->insert([
            'personal_id' => 1,
            'title' => $update_request['title'],
            'start_date' => $update_request['start_date'],
            'end_date' => $update_request['end_date'],
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
                        ['result_end_date', null],
                    ])
            ->orderByRaw('created_at DESC')
            ->get()->first();
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
        $result = \DB::table('goal_information')
            ->where('goal_information_id', $goal_information_id)
            ->update([
                'count_flg' => 1,
        ]);
        return $result;
    }
}
