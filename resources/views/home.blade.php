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
                        <p>あなたの目標</p><br>
                        @if (isset($goal_info))
                            <p>{{ $goal_info->title }}</p>
                            <p>{{ $goal_info->start_date }}</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
