<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\job;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $job = job::latest()->paginate(3);
        return view("jobs.index",compact("job"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated_data = $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "tags" => "nullable|string",
            "salary" => "required|integer",
            "job_type" => "required|string",
            "remote" => "required|boolean",
            "requirements" => "nullable|string",
            "benefits" => "nullable|string",
            "address" => "nullable|string",
            "city" => "required|string",
            "state" => "required|string",
            "zipcode" => "nullable|string",
            "contact_email" => "required|string",
            "contact_phone" => "nullable|string",
            "company_name" => "required|string",
            "company_description" => "nullable|string",
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048",
            "company_website" => "nullable|url"
        ]);

        $validated_data["user_id"] = auth()->user()->id;

        if($request->file("company_logo")){
            $path = $request->file("company_logo")->store("logos","public");
            $validated_data["company_logo"]=$path;
        }
        job::create($validated_data);
        return redirect()->route("job.index")->with('success', 'Job listing created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(job $job)
    {
        return view("jobs.show",compact("job"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(job $job)
    {
        $this->authorize("update",$job);
        return view("jobs.edit",compact("job"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, job $job): string
    {
        $this->authorize("update",$job);
        $validated_data = $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "tags" => "nullable|string",
            "salary" => "required|integer",
            "job_type" => "required|string",
            "remote" => "required|boolean",
            "requirements" => "nullable|string",
            "benefits" => "nullable|string",
            "address" => "nullable|string",
            "city" => "required|string",
            "state" => "required|string",
            "zipcode" => "nullable|string",
            "contact_email" => "required|string",
            "contact_phone" => "nullable|string",
            "company_name" => "required|string",
            "company_description" => "nullable|string",
            "company_logo" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048",
            "company_website" => "nullable|url"
        ]);

        if($request->hasFile("company_logo")){
            if($job->company_logo){
                unlink("storage/logos/".basename($job->company_logo));
            }
            $path = $request->file("company_logo")->store("logos","public");
            $validated_data["company_logo"]=$path;
        }
        $job->update($validated_data);
        return(redirect()->route("job.index")->with('success', 'Job Listing Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(job $job):RedirectResponse
    {
        $this->authorize("delete",$job);
        if($job->company_logo){
            unlink("storage/logos/".basename($job->company_logo));
        }
        $job->delete();
        if(request()->query('from')=="dashboard"){
            return(redirect()->route("dashboard")->with("success","Job Deleted Successfuly!"));
        }else{
            return(redirect()->route("job.index")->with("success","Job Deleted Successfuly!"));
        }

    }

    public function search(Request $request):View{
        $keywords = strtolower($request->input("keywords"));
        $location = strtolower($request->input("location"));
        $query = job::query();

        if($keywords){
            $query->where(function ($q) use ($keywords){
                $q->whereRaw("LOWER(title) like ?",["%".$keywords."%"])
                    ->orWhereRaw("LOWER(description) like ?",["%".$keywords."%"])
                    ->orWhereRaw("LOWER(tags) like ?",["%".$keywords."%"]);
            });
        }
        if($location){
            $query->where(function ($q) use ($location){
                $q->whereRaw('LOWER(city) like ?',['%'.$location.'%'])
                    ->orWhereRaw('LOWER(state) like ?',['%'.$location.'%'])
                    ->orWhereRaw('LOWER(zipcode) like ?',["%".$location."%"])
                    ->orWhereRaw("LOWER(address) like ?",["%".$location."%"]);
            });
        }
        $job = $query->paginate(12);
        return view("jobs.index",compact("job"));
    }

}
