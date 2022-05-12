<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Notifications\Notifiable;
use App\Http\Requests\SlackRequest;
use App\Notifications\Slack;
use App\Notifications\SlackNotification;

class SlackController extends Controller
{
    use Notifiable;

    /**
     * Slackに通知する文字列入力ページの表示
     *
     * @return view
     */
    public function index()
    {
        return view('back.slacks.index');
    }

    /**
     * Slackへの通知
     *
     * @param SlackRequest $request
     * @return redirect
     */
    public function send(SlackRequest $request)
    {

        $requestBody = $request->validated();
        $this->notify(new SlackNotification($requestBody['title']));

        return redirect(route('back.slack.index'));
    }

    /**
     * 通知を行うWebhook URLの設定
     *
     * @param mix $notification
     * @return slackWebhookUrl
     */
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_url');
    }
}
