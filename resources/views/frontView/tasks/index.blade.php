@extends('adminlte::page')

@section('content')
    {{-- @extendsで継承したファイル内の@yieldの部分に@section~@endsectionの部分を埋め込む --}}
    <section class="content pb-3">
        <div class="mx-auto w-25 mb-10">
            <a href="{{ route('back.tasks.create') }}">
                <button type="button" class="btn btn-block btn-danger btn-sm" control-id="ControlID-35">タスクの新規作成
                </button>
            </a>
        </div>

        <div class="container-fluid h-100">

            <div class="row">
                <div class="card  card-secondary col-sm">
                    <div class="card-header">
                        <h3 class="card-title">
                            To Do
                        </h3>
                    </div>
                    @foreach ($tasks as $task)
                        @if ($task->status == 0)
                            <div class="card-body p-1">
                                <div class="card p-1 card-info card-outline">
                                    <div class="card-header">
                                        <div>
                                            {{ $task->title }}
                                        </div>
                                        <div>
                                            {{ $task->submission }}
                                        </div>
                                        <div class="card-tools">
                                            <a href='#' class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card card-row card-primary col-sm">
                    <div class="card-header">
                        <h3 class="card-title">
                            Doing
                        </h3>
                    </div>
                    @foreach ($tasks as $task)
                        @if ($task->status == 1)
                            <div class="card-body p-1">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card card-row card-default col-sm">
                    <div class="card-header bg-info">
                        <h3 class="card-title">
                            Done
                        </h3>
                    </div>
                    @foreach ($tasks as $task)
                        @if ($task->status == 2)
                            <div class="card-body p-1">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card card-row card-success col-sm">
                    <div class="card-header">
                        <h3 class="card-title">
                            Submitted
                        </h3>
                    </div>
                    @foreach ($tasks as $task)
                        @if ($task->status == 3)
                            <div class="card-body p-1">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
