<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class Task extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getTask($id)
    {
        return self::where('user_id', $id)->get();
    }


    // protected $casts = [
    //     'repeat' => 'date:Y-m-d',
    // ];
}
