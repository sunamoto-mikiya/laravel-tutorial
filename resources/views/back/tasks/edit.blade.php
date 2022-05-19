@extends('adminlte::page')

@section('content')
    {{-- @extendsで継承したファイル内の@yieldの部分に@section~@endsectionの部分を埋め込む --}}
    <section class="content pb-3 w-75 mx-auto">
        <div class="mx-auto w-25 mb-10">
            <form action="{{ route('back.tasks.destroy', $task->id) }}" method="POST">
                @method('delete')
                @csrf
                {{-- 削除ボタン --}}
                <button type="submit" class="btn btn-block btn-danger btn-sm" onclick='return window.confirm("削除しますか？");'
                    control-id="ControlID-35">タスクの削除
                </button>
                <div class="custom-control custom-checkbox mb-10">
                    <input class="custom-control-input" type="hidden" name="delete_check" value="0">
                    @if (!$task->is_repeat)
                        <input class="custom-control-input" type="checkbox" name="delete_check" id="customCheckbox1"
                            value="1" control-id="ControlID-28">
                        <label for="customCheckbox1" class="custom-control-label">この予定以降を全て削除する</label>
                    @endif
                </div>
            </form>
        </div>
        {{-- タスクの編集機能 --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">タスクの編集</h3>
            </div>
            <form action="{{ route('back.tasks.update', $task->id) }}" method="POST">
                @method('put')
                @csrf
                <div class="card-body">
                    {{-- タイトル設定欄 --}}
                    <div class="form-group w-25">
                        <label>タイトル</label>
                        <input type="text" name="title" value="{{ $task->title }}" class="form-control"
                            control-id="ControlID-11">
                    </div>
                    {{-- 期日設定フォーム --}}
                    <div class="form-group w-25">
                        <label>提出日</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="datetime-local" name='submission'
                                value="{{ str_replace(' ', 'T', $task->submission) }}"
                                class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                control-id="ControlID-32">

                        </div>
                    </div>
                    {{-- チェックボックス --}}
                    <div class="custom-control custom-checkbox mb-10">
                        @switch($task->is_repeat)
                            @case(0)
                                <input class="custom-control-input" type="hidden" name="is_repeat" value="0">
                            @break

                            @case(1)
                                <input class="custom-control-input" type="checkbox" name="is_repeat" id="customCheckbox1" value="1"
                                    checked control-id="ControlID-28">
                            @break

                            @default
                        @endswitch
                        <input class="custom-control-input" type="hidden" name="is_repeat" value="0">
                        <input class="custom-control-input" type="checkbox" name="is_repeat" id="customCheckbox2" value="1"
                            control-id="ControlID-28">
                        <label for="customCheckbox2" class="custom-control-label">予定を繰り返えさない</label>
                    </div>
                    {{-- 繰り返す期日 --}}
                    <div class="form-group w-25">
                        <label>繰り返す期日</label>
                        @if ($task->repeat != null)
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="date" name="repeat" value="{{ $task->repeat->format('Y-m-d') }}"
                                    class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                    control-id="ControlID-32">
                            </div>
                        @else
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="date" name="repeat" class="form-control datetimepicker-input"
                                    data-target="#reservationdatetime" control-id="ControlID-32">
                            </div>
                        @endif
                    </div>
                    {{-- 通知を送る設定 --}}
                    <div class="form-group w-25">
                        <label>通知設定</label>
                        <select class="form-control" name="advance" control-id="ControlID-24">
                            <option value={{ $task->advance }} selected hidden>
                                @switch($task->advance)
                                    @case(0)
                                        0日前
                                    @break

                                    @case(1)
                                        1日前
                                    @break

                                    @case(2)
                                        2日前
                                    @break

                                    @case(3)
                                        3日前
                                    @break

                                    @case(4)
                                        4日前
                                    @break

                                    @case(5)
                                        5日前
                                    @break

                                    @case(6)
                                        6日前
                                    @break

                                    @default
                                @endswitch
                            </option>
                            <option value=0>0日前</option>
                            <option value=1>1日前</option>
                            <option value=2>2日前</option>
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
                            <textarea class="form-control" name="memo" rows="3" control-id="ControlID-13">{{ $task->memo }}</textarea>
                        </div>
                    </div>
                    @if (!$task->is_repeat)
                        <div class="custom-control custom-checkbox mb-10">
                            <input class="custom-control-input" type="hidden" name="edit_check" value="0">
                            <input class="custom-control-input" type="checkbox" name="edit_check" id="customCheckbox3"
                                value="1" control-id="ControlID-28">
                            <label for="customCheckbox3" class="custom-control-label">この予定以降を全て編集する</label>
                        </div>
                    @endif
                </div>

                {{-- 決定ボタン --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" control-id="ControlID-5">ok</button>
                </div>
            </form>
        </div>
    </section>
@endsection
