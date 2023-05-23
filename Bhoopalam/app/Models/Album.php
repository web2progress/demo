<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
class Album extends Model
{
    use HasFactory;

    public function gallery(){
        return $this->belongsTo(Gallery::class,'id','album_id')->latest();
    }
      
}
