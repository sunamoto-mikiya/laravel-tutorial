<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //作成するテーブルの設定を行う。

    public function up()
    {
        //Schemaはファザード
        Schema::create('posts', function (Blueprint $table) { //create('テーブル名',無名関数(BluePoint←型などのメソッドを提供するスキーマビルダ))
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->boolean('is_public')->default(true)->comment('公開・非公開'); //commentメソッド→テーブルに説明を追加するP
            $table->dateTime('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('公開日');
            //foreginIdで外部キー制約
            //usersテーブルのIDと紐付ける
            //constrainedで参照先のテーブルと紐づける。カラム名と一致しているときは引数なし
            $table->foreignId('user_id')->constrained();
            $table->timestamps(); //timestampメソッドはupdated_atとcreated_atを自動更新する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    //データベースを以前の状態に戻す際に設定を書く
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
