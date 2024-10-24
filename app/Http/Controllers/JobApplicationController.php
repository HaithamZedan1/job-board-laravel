<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(JobOffer $job)
    {
        $this->authorize('apply',$job);
        return view('job_application.create',['job'=>$job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobOffer $job,Request $request)
    {
        $this->authorize('apply',$job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');

        $path = $file->store('cvs','private');
 
        $job->jobApplications()->create([
            'user_id'=>$request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show',$job)->with('success','Job application submitted');
    }

    public function downloadCv(Request $request)
{
    $filePath = $request->query('path');

    if (Storage::disk('private')->exists($filePath)) {
        return Storage::disk('private')->download($filePath);
    }

    return redirect()->back()->with('error', 'File not found');
    }


    public function destroy(string $id)
    {
        //
    }
}
