<?php

namespace App\Http\Controllers;

use App\Mail\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Message;

class FrontController extends Controller
{
    public function home()
    {
        $skills = Skill::all();
        $projects = Project::latest()->take(6)->get(); // for later use

        return view('front.home', compact('skills', 'projects'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function skills()
    {
        $skills = Skill::all();
        return view('front.skills', compact('skills'));
    }

    public function projects()
    {
        $projects = Project::all();
        return view('front.projects', compact('projects'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Save to DB
        Message::create($request->all());

        // Send email
        Mail::to('yourgmail@gmail.com')
            ->send(new ContactNotification($request->all()));

        return back()->with('success', 'Message sent successfully! I will reply soon.');
    }
}
