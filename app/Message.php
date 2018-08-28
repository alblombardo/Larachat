<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [];


    public function user()
    {
        $this->belongsTo(User::class);
}



