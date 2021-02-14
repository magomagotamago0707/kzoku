@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <p>あなたの目標</p>
                        @if (isset($goal_info))
                            <p>{{ $goal_info->title }}</p>
                            <p>{{ $goal_info->start_date}}</p>
                            <p>{{ $goal_info->end_date }}</p>
                            @if ($goal_info->count_flg==0)
                                <form action="/goal/count">
                                    <input type="hidden" name="goal_information_id" value={{ $goal_info->goal_information_id }}>
                                    <button type="submit">今日の目標を達成する</button>
                                </form>    
                            @else
                                <p>本日の目標は達成済みです</p>
                            @endif
                            
                            <a href= "/goal/edit?goal_id={{ $goal_info->goal_information_id }}" >目標を編集する</a><br>
                        @else
                            <p style="color:red">目標が設定されていません。</p>
                        @endif
                        <a href= "/goal/regist" >目標を新規登録する</a><br>
                    </div>
                    @if (isset($goal_info))
                        <div>
                            <br>
                            <p>過去の目標</p>
                            <div>
                            <table>
                                <tr>
                                    <th>作成日時</th>
                                    <th>タイトル</th>
                                    <th>開始日時</th>
                                    <th>終了日時</th>
                                    <th>継続日数</th>
                                </tr>
                                @foreach($all_goal_info as $target_goal_info)
                                    <tr>
                                        <td>{{ $target_goal_info->created_at }}</td>
                                        <td>{{ $target_goal_info->title }}</td>
                                        <td>{{ isset($target_goal_info->start_date) ? $target_goal_info->start_date : '-' }}</td>
                                        <td>{{ isset($target_goal_info->end_date) ? $target_goal_info->end_date : '-' }}</td>
                                        <td>{{isset($target_goal_info->end_date) && isset($target_goal_info->start_date)? floor(((strtotime($target_goal_info->end_date)-strtotime($target_goal_info->start_date))) / (60 * 60 * 24)). '日': '-'}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
table{
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
}

table th,table td{
  padding: 10px 0;
  text-align: center;
}

table tr:nth-child(odd){
  background-color: #eee
}
</style>
@endsection
