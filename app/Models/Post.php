<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property bool $is_public
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    //
    //fillableで指定したカラムのみ記述可能となりそれ以外は上書き不可
    protected $fillable = [
        'title', 'body', 'is_public', 'published_at'
    ];
    //追記
    //型変換で使う(データ取得時の型の指定？？)
    protected $casts = ['is_public' => 'bool', 'published_at' => 'datetime'];


    //scopeとはcontorllarで書いていたwhere句等の繰り返し処理をまとめたもの
    //scope+メソッド名で宣言し、呼び出しはClass名::メソッド名

    public function scopePublic(Builder $query)
    {
        return $query->where('is_public', true);
    }

    public function scopePublicList(Builder $query)
    {
        return $query->public()->latest('published_at')->paginate(10);
    }

    public function scopePublicFindById(Builder $query, int $id)
    {
        return $query->public()->findOrFail($id);
    }

    public function getPublshedFormatAttribute()
    {
        return $this->published_atformat('Y年m月d日');
    }
}

//デフォルトで定義されているEloquentモデルに定義を変えるときに書く
//このモデルクラスのおかげで簡単にテーブルからデータを取得したり変更したりできる
//Eloquentはテーブルの操作を簡単にできるモデル