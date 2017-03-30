<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    
    public static function whereUserId()
    {
        print_r($this);
        exit();
    }
}
