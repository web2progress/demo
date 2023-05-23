<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Album;
class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ["album_id","imag_title"];
    
}
