<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index()
    {
      return 'Silence is golden!';
    }

    public function create()
    {
      return view('welcome');
    }
}
