<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class DashboardController extends Controller
{
    public function index():view{
        $user = Auth::user();
        $jobs = job::where("user_id",$user->id)->with("applicants")->get();
        return view("dashboard.index",compact("user","jobs"));
    }
}
