<?php

namespace App\Http\Controllers;

use App\Mail\JobApplied;
use App\Models\Applicant;
use App\Models\job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function store(Request $request, job $job):RedirectResponse{
        $user = Auth::user();
        $existing_applicant = Applicant::where("job_id",$job->id)->where("user_id",auth()->id())->exists();
        if($existing_applicant){
            return redirect()->back()->with("error","you already have been send your resume!");
        }
        $validated_data = $request->validate([
            "full_name"=>"required|string",
            "contact_phone"=>"string",
            "contact_email"=>"string",
            "contact_email"=>"required|email|string",
            "message"=>"string|required",
            "location"=>"string|required",
            "resume"=>"required|file|mimes:pdf|max:2048"
        ]);
        if($request->hasFile("resume")){
            $path= $request->file("resume")->store("resumes","public");
            $validated_data["resume_path"] = $path;
        }
        $applicant = new Applicant($validated_data);
        $applicant->user_id = auth()->id();
        $applicant->job_id = $job->id;
        $applicant->save();
//        Mail::to($job->user->email)->send(new JobApplied($applicant,$job));
        return redirect()->back()->with("success","you applied for this job successfully!");
    }

    public function destroy($id):RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return redirect()->route("dashboard")->with("success","Deleted Applicant Successfully!");
    }
}
