<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['user_id', 'content','del_flg' ];

    public function thred_id(){
        return $this -> belongsTo('App\Thread','thread_id','id');
    }
}
