<?php

namespace App\Http\Controllers\Back;

use App\Facades\Slack as FacadesSlack;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Notification;
use App\Notifications\Slack;
use App\Notifications\SlackNotification;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'submission' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('back.tasks.create')
                ->withInput()
                ->withErrors($validator);
        }

        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $group_id = str_pad(random_int(0, 99999999), 8, 0, STR_PAD_LEFT);

        if ($data['is_repeat'] == 0) {
            $submission = $request->input('submission');
            $repeat = new Carbon($request->input('repeat'));
            $periods = CarbonPeriod::create($submission, $repeat->addDay())->weeks()->toArray();
        } else {
            $submission = $request->input('submission');
            $repeat = $data['submission'];
            $periods = CarbonPeriod::create($submission, $repeat)->weeks()->toArray();
        }

        foreach ($periods as $period) {
            $result = Task::create([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'submission' => $period,
                'advance' => $data['advance'],
                'is_repeat' => $data['is_repeat'],
                'repeat' => $data['repeat'],
                'group_id' => $group_id,
                'memo' => $data['memo'],
            ]);
        }
        $user = User::find($data['user_id']);
        Notification::route('slack', $user->slack_url)->notify(new SlackNotification($request->input('title')));

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('back.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'submission' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('back.tasks.create')
                ->withInput()
                ->withErrors($validator);
        }


        if ($request->is_repeat == false) {
            $task = Task::find($id);
            //一旦同じgroup_idを持つタスクを消す
            Task::where(
                [
                    ['group_id', $task->group_id],
                    ['submission', '>=', $task->submission]
                ]
            )->delete();
            //編集した内容で再度タスク生成
            $taskController = new TaskController();
            $tasks = $taskController->store($request);

            return redirect()->route('home');
        } else {
            //繰り返さない課題の編集
            Task::find($id)->update($request->all());
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task->is_repeat == false) {
            $task = Task::find($id);
            //一旦同じgroup_idを持つタスクを消す
            Task::where(
                [
                    ['group_id', $task->group_id],
                    ['submission', '>=', $task->submission]
                ]
            )->delete();
            return redirect()->route('home');
        } else {
            $task->delete();
            return redirect()->route('home');
        }
    }

    // 状態を切り替える
    public function status(Request $request, $id)
    {
        $status = $request->input('status');
        $data = Task::find($id);
        switch ($status) {
            case 0:
                $data->update(['status' => 1]);
                return redirect()->route('home');
                break;
            case 1:
                $data->update(['status' => 2]);
                return redirect()->route('home');
                break;
            case 2:
                $data->update(['status' => 3]);
                return redirect()->route('home');
                break;
            case 3:
                $data->update(['status' => 3]);
                return redirect()->route('home');
                break;
            default;
        }
    }
}
