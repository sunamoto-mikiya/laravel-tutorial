@extends('adminlte::page')

@section('content')
    {{-- @extendsで継承したファイル内の@yieldの部分に@section~@endsectionの部分を埋め込む --}}
    <section class="content pb-3 w-75 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">タスクの新規作成</h3>
            </div>
            <form>
                <div class="card-body">
                    {{-- タイトル設定欄 --}}
                    <div class="form-group">
                        <label>タイトル</label>
                        <input type="text" class="form-control" placeholder="Enter ..." control-id="ControlID-11">
                    </div>
                    {{-- 期日設定フォーム --}}
                    <div class="form-group">
                        <label>提出日</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                control-id="ControlID-32">
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- チェックボックス --}}
                    <div class="custom-control custom-checkbox mb-10">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1"
                            control-id="ControlID-28">
                        <label for="customCheckbox1" class="custom-control-label">予定を繰り返す</label>
                    </div>
                    {{-- 繰り返す曜日 --}}
                    <div class="form-group">
                        <label>繰り返す曜日</label>
                        <select class="form-control" control-id="ControlID-24">
                            <option>日</option>
                            <option>月</option>
                            <option>火</option>
                            <option>水</option>
                            <option>木</option>
                            <option>金</option>
                            <option>土</option>
                        </select>
                    </div>
                    {{-- 繰り返す期日 --}}
                    <div class="form-group">
                        <label>繰り返す期日</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"
                                control-id="ControlID-32">
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    {{-- 通知を送る設定 --}}
                    <div class="form-group">
                        <label>通知設定</label>
                        <select class="form-control" control-id="ControlID-24">
                            <option>0日前</option>
                            <option>1日前</option>
                            <option>2日前</option>
                            <option>3日前</option>
                            <option>4日前</option>
                            <option>5日前</option>
                            <option>6日前</option>
                        </select>
                    </div>
                    {{-- メモ欄 --}}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>メモ</label>
                            <textarea class="form-control" rows="3" placeholder="課題の詳細…" control-id="ControlID-13"></textarea>
                        </div>
                    </div>
                </div>

                {{-- 決定ボタン --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" control-id="ControlID-5">ok</button>
                </div>
            </form>
        </div>
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../plugins/select2/js/select2.full.min.js"></script>
        <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
        <script src="../../plugins/moment/moment.min.js"></script>
        <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
        <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
        <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
        <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
        <script src="../../dist/js/adminlte.min.js?v=3.2.0">
            < script src = "../../plugins/dropzone/min/dropzone.min.js" >
        </script>
        </script>
        <script src="../../dist/js/demo.js"></script>

    </section>
@endsection
