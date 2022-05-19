@extends('adminlte::page')

@section('content')
    {{-- @extendsで継承したファイル内の@yieldの部分に@section~@endsectionの部分を埋め込む --}}
    <div class="mx-auto w-25 pt-2">
        <a href="{{ route('back.tasks.create') }}">
            <button type="button" class=" btn btn-block btn-dark" control-id="ControlID-35">タスクの新規作成
            </button>
        </a>
    </div>
    <section class="content p-5">
        {{-- ToDo看板 --}}
        <div class="container-xxl h-25">
            <div class="row">
                <div class="card  card-secondary col-sm">
                    <div class="card-header">
                        <h3 class="card-title">
                            To Do
                        </h3>
                    </div>
                    {{-- 看板の中身の実際のタスク --}}
                    @foreach ($tasks as $task)
                        @if ($task->status == 0)
                            <div class="card-body p-1">
                                <div class="card p-1 card-info card-outline">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div>
                                                    {{ $task->title }}
                                                </div>
                                                <div>
                                                    {{ $task->submission }}
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('back.status', $task->id) }}" method='POST'>
                                                    @method('put')
                                                    @csrf
                                                    <button type="submit" name="status" value="{{ $task->status }}"
                                                        class="btn btn-primary" control-id="ControlID-5">Doing</button>
                                                </form>
                                                <div class="card-tools">
                                                    <a href={{ route('back.tasks.edit', $task->id) }}
                                                        class="btn btn-tool">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{-- Doing看板 --}}
                <div class="card card-row card-primary col-sm">
                    <div class="card-header">
                        <h3 class="card-title">
                            Doing
                        </h3>
                    </div>
                    {{-- Doing看板の中身の実際のタスク --}}
                    @foreach ($tasks as $task)
                        @if ($task->status == 1)
                            <div class="card-body p-1">
                                <div class="card p-1 card-info card-outline">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div>
                                                    {{ $task->title }}
                                                </div>
                                                <div>
                                                    {{ $task->submission }}
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('back.status', $task->id) }}" method='POST'>
                                                    @method('put')
                                                    @csrf
                                                    <button type="submit" name="status" value="{{ $task->status }}"
                                                        class="btn btn-warning" control-id="ControlID-5">Done</button>
                                                </form>
                                                <div class="card-tools">
                                                    <a href={{ route('back.tasks.edit', $task->id) }}
                                                        class="btn btn-tool">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card card-row card-default col-sm">
                    <div class="card-header bg-warning">
                        <h3 class="card-title">
                            Done
                        </h3>
                    </div>
                    @foreach ($tasks as $task)
                        @if ($task->status == 2)
                            <div class="card-body p-1">
                                <div class="card p-1 card-info card-outline">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div>
                                                    {{ $task->title }}
                                                </div>
                                                <div>
                                                    {{ $task->submission }}
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('back.status', $task->id) }}" method='POST'>
                                                    @method('put')
                                                    @csrf
                                                    <button type="submit" name="status" value="{{ $task->status }}"
                                                        class="btn btn-success" control-id="ControlID-5">Submitted</button>
                                                </form>
                                                <div class="card-tools">
                                                    <a href={{ route('back.tasks.edit', $task->id) }}
                                                        class="btn btn-tool">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div>
                                            </div>
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
                                <div class="card p-1 card-info card-outline">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div>
                                                    {{ $task->title }}
                                                </div>
                                                <div>
                                                    {{ $task->submission }}
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('back.tasks.destroy', $task->id) }}"
                                                    method='POST'>
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" name="status" value="{{ $task->status }}"
                                                        class="btn btn-primary" control-id="ControlID-5">Delete</button>
                                                </form>
                                                <div class="card-tools">
                                                    <a href={{ route('back.tasks.edit', $task->id) }}
                                                        class="btn btn-tool">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
