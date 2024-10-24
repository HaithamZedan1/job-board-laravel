<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\JobOffer;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAnyEmployer',JobOffer::class);
        return view('my_job.index',
        ['jobs'=>auth()->user()->employer->jobOffers()
        ->with(['employer','jobApplications','jobApplications.user'])
        ->get()
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',JobOffer::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $this->authorize('create',JobOffer::class);
        auth()->user()->employer->jobOffers()->create($request->validated());

        return redirect()->route('my-jobs.index')
        ->with('success','Job Offer Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobOffer $myJob)
    {
        $this->authorize('update',$myJob);
        return view('my_job.edit',['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, JobOffer $myJob)
    {
        $this->authorize('update',$myJob);
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
        ->with('success','Job Offer Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobOffer $myJob)
    {
        $this->authorize('forceDelete',$myJob);
        $myJob->delete();
        return redirect()->route('my-jobs.index')->with('success','Job Offer Deleted Successfully');
    }
}
