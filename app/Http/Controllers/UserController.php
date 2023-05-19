<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use App\Models\Jobs;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function frontendjobs(){

        $jobs = Jobs::where('status', 'Active')->get();

        return view('welcome', compact('jobs'));

    }

    public function apply(Request $request, $id){

        $jobs = new JobApply();

        $jobs->candidate_id = 1;
        $jobs->job_id = $id;
        $jobs->job_title = $request->job_title;
        $jobs->job_description = $request->job_description;

        $jobs->save();

        return redirect()->back()->with('success', 'Applied successfully!');

    }

    public function dashboard(){

        return view('user.index');

    }
}
