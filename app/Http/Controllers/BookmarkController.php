<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function index():view{
        $user = Auth::user();
        $bookmarks = $user->bookmarkedJobs()->orderBy("job_user_bookmarks.created_at","desc")->paginate(9);
        return view("jobs.bookmark",compact("bookmarks"));
    }
    public function store(job $job):RedirectResponse{
        $user = Auth::user();
        if($user->bookmarkedJobs()->where("job_id",$job->id)->exists()){
            return back()->with("status","This job is Already BookMarked!");
        }
         $user->bookmarkedJobs()->attach($job->id);
         return back()->with("success","Job Bookmarked Successfully!");
    }
    public function destroy(job $job):RedirectResponse{
        $user = Auth::user();
        if(!$user->bookmarkedJobs()->where("job_id",$job->id)->exists()){
            return back()->with("error","Job is not bookmarked");
        }
        $user->bookmarkedJobs()->detach($job->id);
        return back()->with("success","Job bookmark deleted successfully!");
    }
}
