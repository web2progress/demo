<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory; 
class BlogPost extends Model
{
    use HasFactory;
     function modal(){
        return $this->hasOne(Modal::class,'id','modal_id');
     }
}
