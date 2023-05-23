<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class NewsLatter extends Model
{
    use HasFactory;
    protected $table = 'news_latters';
    protected $fillable = ["id", "email",'created_at'];

    public static function getNewsLatter()
    {
        $records = DB::table('news_latters')->select('id', 'email', 'created_at')->get()->toArray();
        return $records;
    }
}
