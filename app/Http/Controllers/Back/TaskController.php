<?php

namespace App\Http\Controllers\Back;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;


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

        $submission = $request->input('submission');
        $repeat = new Carbon($request->input('repeat'));

        $periods = CarbonPeriod::create($submission, $repeat->addDay())->weeks()->toArray();

        foreach ($periods as $period) {
            $result = Task::create([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'submission' => $period,
                'advance' => $data['advance'],
                'is_repeat' => $data['is_repeat'],
                'repeat' => $data['repeat'],
                'group_id' => str_pad(random_int(0, 99999999), 8, 0, STR_PAD_LEFT),
                'memo' => $data['memo'],
            ]);
        }


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

        $result = Task::find($id)->update($request->all());
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Task::find($id)->delete();
        return redirect()->route('home');
    }

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
