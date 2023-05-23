<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionUpgrade extends Model
{
    use HasFactory;
    protected $fillable = ['application_id','user_id', 'fullname', 'mobileNumber', 'companyname', 'address', 'altMobileNumber', 'request_doc', 'application', 'status'];
}
