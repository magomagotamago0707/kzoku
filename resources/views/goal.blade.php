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
                        <p>現在の目標</p><br>
                        @if(isset( $error ))
                            <p style="color:red">{{ $error }}</p>
                        @endif
                        @if(isset( $success ))
                            <p style="color:blue">{{ $success }}</p>
                        @endif
                        @csrf
                        <form action="/goal/{{ isset($goal) ? "update" : "insert"}}">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('タイトル') }}</label>
                                <div class="col-md-6">
                                    <input id="" type="text" class="form-controlr"  name="title" value="{{isset($goal->title) ? $goal->title : ''}}">
                                </div>
                                {{-- <label class="col-md-4 col-form-label text-md-right">{{ __('開始日時') }}</label>
                                <div class="col-md-6">
                                    <input id="" type="date" class="form-controlr" name="start_date" value={{isset($goal->start_date) ? $goal->start_date : ''}} >
                                </div> --}}
                                {{-- <label class="col-md-4 col-form-label text-md-right">{{ __('終了日時') }}</label>
                                <div class="col-md-6">
                                    <input id="" type="date" class="form-controlr" name="end_date" value={{isset($goal->end_date) ? $goal->end_date : ''}} >
                                </div> --}}
                                <input type="hidden" name="goal_information_id" value={{isset($goal->goal_information_id) ? $goal->goal_information_id : ''}}>
                                <button type="submit">登録する</button><br>
                                <a href= "/home" >戻る</a><br>
                            <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
