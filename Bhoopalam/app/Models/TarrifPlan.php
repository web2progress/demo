<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarrifPlan extends Model
{
    use HasFactory;
    protected $fillable = ['statname','oprtype','oprname','plantype','amount','oldamt','vdays','description','slno','boxtype','orn','status'];
}
