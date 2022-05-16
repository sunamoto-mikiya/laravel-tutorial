@extends('adminlte::page')

@section('content')
    {{-- @extendsで継承したファイル内の@yieldの部分に@section~@endsectionの部分を埋め込む --}}
    <section class="content pb-3 w-75 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">タスクの新規作成</h3>
            </div>
            <form action="{{ route('back.tasks.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    {{-- タイトル設定欄 --}}
                    <div class="form-group">
                        <label>タイトル</label>
                        <input type="text" name="title" class="form-control" control-id="ControlID-11">
                    </div>
                    {{-- 期日設定フォーム --}}
                    <div class="form-group">
                        <label>提出日</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="datetime-local" name='submission' class="form-control datetimepicker-input"
                                data-target="#reservationdatetime" control-id="ControlID-32">

                        </div>
                    </div>
                    {{-- チェックボックス --}}
                    <div class="custom-control custom-checkbox mb-10">
                        <input class="custom-control-input" type="hidden" name="is_repeat" value="0">
                        <input class="custom-control-input" type="checkbox" name="is_repeat" id="customCheckbox0" value="1"
                            control-id="ControlID-28">
                        <label for="customCheckbox0" class="custom-control-label">予定を繰り返さない</label>
                    </div>
                    {{-- 繰り返す期日 --}}
                    <div class="form-group">
                        <label>繰り返す期日</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="date" name="repeat" class="form-control datetimepicker-input"
                                data-target="#reservationdatetime" control-id="ControlID-32">
                        </div>
                    </div>
                    {{-- 通知を送る設定 --}}
                    <div class="form-group">
                        <label>通知設定</label>
                        <select class="form-control" name="advance" control-id="ControlID-24">
                            <option value=0>0日前</option>
                            <option value=1>1日前</option>
                            <option value=2 selected>2日前</option>
                            <option value=3>3日前</option>
                            <option value=4>4日前</option>
                            <option value=5>5日前</option>
                            <option value=6>6日前</option>
                        </select>
                    </div>
                    {{-- メモ欄 --}}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>メモ</label>
                            <textarea class="form-control" name="memo" rows="3" placeholder="課題の詳細…" control-id="ControlID-13"></textarea>
                        </div>
                    </div>
                </div>

                {{-- 決定ボタン --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" control-id="ControlID-5">ok</button>
                </div>
            </form>
        </div>
    </section>
@endsection
