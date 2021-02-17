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
                        <div class="demo demo5">
                            <div class="heading"><span>現在の目標</span></div>
                        </div>
                        @if (isset($goal_info))
                        <table class="company">
                            <tbody>
                                <tr>
                                    <th class="arrow_box">タイトル</div></th>
                                    <td>{{ $goal_info->title }}</td>
                                </tr>
                                <tr>
                                    <th class="arrow_box">開始日時</th>
                                    <td>{{ $goal_info->start_date }}</td>
                                </tr>
                                    <tr>
                                    <th>終了日時</th>
                                    <td>{{ $goal_info->end_date }}</td>
                                </tr>
                                </tr>
                                    <tr>
                                    <th>継続日数</th>
                                    <td>{{isset($goal_info->start_date)? floor(((strtotime(now())-strtotime($goal_info->start_date))) / (60 * 60 * 24)). '日': '-'}}</td>
                                </tr>
                            </tbody>
                        </table>
                            @if ($goal_info->count_flg==0)
                                <div class="box11">
                                    <p>継続未完了です🔥🔥🔥</p>
                                </div>
                                <form action="/goal/count">
                                    <input type="hidden" name="goal_information_id" value={{ $goal_info->goal_information_id }}>
                                    <button type="submit">今日の目標を達成する</button>
                                </form>    
                            @else
                                <div class="box10">
                                    <p>継続完了です🎉</p>
                                </div>
                            @endif
                            
                            <a href= "/goal/edit?goal_id={{ $goal_info->goal_information_id }}" class="btn-square">目標を編集する</a><br>
                        @else
                            <div class="box10">
                                <p style="color:red">目標が設定されていません。</p>
                            </div>
                        @endif
                        <a href= "/goal/regist" class="btn-square">目標を新規登録する</a><br>
                    </div>
                    @if (isset($goal_info))
                        <div>
                            <br>
                            <div class="demo demo5">
                                <div class="heading"><span>過去の目標</span></div>
                            </div>
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
  border-spacing: 0;
}

table th,table td{
  padding: 10px 0;
  text-align: center;
}

table tr:nth-child(odd){
  background-color: #eee
}

.demo {
width: 100%;
margin: 0 auto;
padding: 10px 0;
font-family: sans-serif;
font-size: 20px;
color:black;
}
.heading {
margin: 10px 0
}
.demo5 .heading {
overflow: hidden;
position: relative;
padding-bottom: 3px;
}
.demo5 .heading span{
padding: 8px;
}
.demo5 .heading:before {
content: "";
border-bottom: 3px solid #295890;
bottom: 0;
height: 0;
position: absolute;
width: 100%;
z-index: 0;
}
.demo5 .heading:after {
border-bottom: 3px solid #ddd;
bottom: 0;
content: "";
position: absolute;
width: 500px;
z-index: 1;
}

table.company {
width: 500px;
margin: 0 auto;
border-collapse: separate;
border-spacing: 0px 3px;
font-size: 12px;
}

table.company th,
table.company td {
padding: 10px;
}

table.company th {
background: #295890;
vertical-align: middle;
text-align: left;
width: 100px;
overflow: visible;
position: relative;
color: #fff;
font-weight: normal;
font-size: 15px;
}

table.company th:after {
left: 100%;
top: 50%;
border: solid transparent;
content: " ";
height: 0;
width: 0;
position: absolute;
pointer-events: none;
border-color: rgba(136, 183, 213, 0);
border-left-color: #295890;
border-width: 10px;
margin-top: -10px;
}
/* firefox */
@-moz-document url-prefix() {
table.company th::after {
float: right;
padding: 0;
left: 30px;
top: 10px;
content: " ";
height: 0;
width: 0;
position: relative;
pointer-events: none;
border: 10px solid transparent;
border-left: #295890 10px solid;
margin-top: -10px;
}
}

table.company td {
background: #f8f8f8;
width: 360px;
padding-left: 20px;
}

table.company{
    width:100%
}

.box10 {
    padding: 0.5em 1em;
    margin: 2em 0;
    color: #295890;
    background: #f8f8f8;/*背景色*/
    border-top: solid 6px #295890;
    box-shadow: 0 3px 4px rgba(0, 0, 0, 0.32);/*影*/
}
.box10 p {
    margin: 0; 
    padding: 0;
}

.box11 {
    padding: 0.5em 1em;
    margin: 2em 0;
    color: red;
    background: #f8f8f8;/*背景色*/
    border-top: solid 6px #295890;
    box-shadow: 0 3px 4px rgba(0, 0, 0, 0.32);/*影*/
}
.box11 p {
    margin: 0; 
    padding: 0;
}

.btn-square {
  display: inline-block;
  padding: 0.5em 1em;
  text-decoration: none;
  background: #295890;/*ボタン色*/
  color: #FFF;
  border-bottom: solid 4px #627295;
  border-radius: 3px;
}
.btn-square:active {
  /*ボタンを押したとき*/
  -webkit-transform: translateY(4px);
  transform: translateY(4px);/*下に動く*/
  border-bottom: none;/*線を消す*/
}

button{
  background:#1AAB8A;
  color:#fff;
  border:none;
  position:relative;
  height:60px;
  font-size:1.6em;
  padding:0 2em;
  cursor:pointer;
  transition:800ms ease all;
  outline:none;
}
button:hover{
  background:#fff;
  color:#1AAB8A;
}
button:before,button:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #1AAB8A;
  transition:400ms ease all;
}
button:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
button:hover:before,button:hover:after{
  width:100%;
  transition:800ms ease all;
}

</style>
@endsection
