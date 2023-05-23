<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionApply extends Model
{
    use HasFactory;

    protected $fillable = ['application_id','user_id','fullname', 'address', 'email', 'mobileNumber', 'altMobileNumber', 'pincode', 'area', 'companyname', 'extention', 'doorNoAndstreet', 'rentalDocument', 'panCard', 'adharCard', 'companyRegistrationDoc', 'status'];
}
