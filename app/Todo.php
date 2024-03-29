<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model //Modelを継承したクラス生成
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'user_id',
    ];
    
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}