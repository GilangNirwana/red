<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saveEmail extends Model
{
    //
    protected $fillable = [
        'email', 'ip', 'target'
    ];
}
