<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny',JobOffer::class);
        $filters=request()->only('search', 'min_salary','max_salary','experience','category');

        return view('jobs.index',['jobs'=>JobOffer::with('employer')->latest()->filter($filters)->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobOffer $job)
    {
        $this->authorize('view',$job);
        return view('jobs.show',['job'=>$job->load('employer.jobOffers')]);
    }
    
}
