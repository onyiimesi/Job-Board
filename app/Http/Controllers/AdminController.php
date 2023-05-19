<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){

        return view('admin.index');

    }

    public function users(){

        return view('admin.users');

    }

    public function getjobs(){

        $jobs = Jobs::get();

        return view('admin.index', compact('jobs'));

    }

    public function approvejobs($id){

        $jobs = Jobs::findorFail($id);

        $jobs->status = 'Active';

        $jobs->save();

        return redirect()->back()->with('success', 'Job approved successfully!');

    }

    public function disapprovejobs($id){

        $jobs = Jobs::findorFail($id);

        $jobs->status = 'Inactive';

        $jobs->save();

        return redirect()->back()->with('success', 'Job disapproved successfully!');

    }

    public function deletejob($id){

        $job = Jobs::findorFail($id);
       
        $job->delete();

        return redirect()->back()
        ->with('success', 'Deleted successfully!');

    }
}
