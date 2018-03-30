<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function subpages()
    {
        return $this -> hasMany('App\Subpage');
    }
}
