<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function multiComment(){
     return   $this->hasOne('App\Models\CommentMultilabel', 'comment_id', 'id');
    }

    public function blogPost(){
        return $this->hasOne('App\Models\BlogPost', 'id', 'post_id');
    }
}
