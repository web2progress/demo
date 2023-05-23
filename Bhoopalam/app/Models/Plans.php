<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
    protected $fillable = ['parameter','plan_id','plan_name','speed','fup','beyound_fup','applicability','security_fees','minimum_period','free_calls','additional','remarks','amount','amount6','amount12'];
}
