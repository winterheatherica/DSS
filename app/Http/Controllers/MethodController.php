<?php

namespace App\Http\Controllers;

use App\Models\DSS_Method;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    public function index()
    {
        return view('/data/method', ['title' => 'Method List', 'total_method' => DSS_Method::all()]);
    }
}
