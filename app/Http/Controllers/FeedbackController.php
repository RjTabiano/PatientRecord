<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Auth;
class FeedbackController extends Controller
{
    public function feedback(){
        return view('admin.feedback');
    }

    public function store_feedback(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $feedback = new Feedback();
        
        $feedback->title = $request->title;
        $feedback->description = $request->description;
        $feedback->user_id = Auth::id();
        
        $feedback->save();

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}
