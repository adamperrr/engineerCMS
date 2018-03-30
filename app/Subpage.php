<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpage extends Model
{
    protected $fillable = [ 'title', 'titleVisibility', 'description',
    'descVisibility', 'type', 'content', 'order', 'page_id' ];

    public function pages()
    {
        return $this -> belongsTo('App\Page');
    }
}
