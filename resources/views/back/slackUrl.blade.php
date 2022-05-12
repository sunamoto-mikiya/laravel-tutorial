@extends('adminlte::page')
@section('content')
    <div class="card card-primary w-25 mx-auto">
        <div class="card-header">
            <h3 class="card-title">WebHookUrlの入力</h3>
        </div>


        <form action="{{ route('back.user.update', Auth::id()) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">WebHookUrl</label>
                    <input type="text" name="slack_url" class="form-control" id="exampleInputEmail1"
                        control-id="ControlID-1">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" control-id="ControlID-5">登録</button>
            </div>
        </form>
    </div>
@endsection
