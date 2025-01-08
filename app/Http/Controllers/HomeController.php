<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\job;

class HomeController extends Controller
{
    public function index()
    {
        $job = job::latest()->limit(6)->get();
        return view("home.index")->with("job",$job);
    }
}
