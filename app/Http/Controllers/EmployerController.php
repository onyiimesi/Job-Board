<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index(){

        return view('employer.index');

    }

    public function post(Request $request){

        // Validate the input
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $id = auth()->id();
        // Create a new user
        $todo = Jobs::create([
            'user_id' => $id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->back()
        ->with('success', 'Job posted successfully!');

    }

    public function postjobs(){

        $id = auth()->id();
        
        $jobs = Jobs::where('user_id', $id)
        ->get();

        return view('employer.index', compact('jobs'));

    }

    public function viewjobs($id){

        $id = auth()->id();
        
        $jobs = Jobs::where('user_id', $id)
        ->where('id', $id)
        ->first();

        return view('employer.index', compact('jobs'));

    }

    public function editjobs(Request $request, $id){

        $job = Jobs::findorFail($id);

        $job->title = $request->title;
        $job->description = $request->description;
       
        $job->save();

        return redirect()->back()
        ->with('success', 'Updated successfully!');

    }

    public function deletejobs($id){

        $job = Jobs::findorFail($id);
       
        $job->delete();

        return redirect()->back()
        ->with('success', 'Deleted successfully!');

    }
}
