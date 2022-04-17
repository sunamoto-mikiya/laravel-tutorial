<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */

//マイグレーションファイルに記述されたテーブル定義情報を元にダミーデータを作成する
//ここで作成されたダミーデータの定義情報を元にseederで指定した件数のダミーデータが作られる
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random_date = $this->faker->dateTimeBetween('-1year', '-1day'); //一年前から一日前前の間でランダムに日付を取得する
        return [
            'title' => $this->faker->realText(rand(20, 50)),
            'body' => $this->faker->realText(rand(100, 200)),
            'is_public' => $this->faker->boolean(90), //引数はtrueが出る確率
            'published_at' => $random_date,
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}

//fakerとはダミーデータ作成用のライブラリ
