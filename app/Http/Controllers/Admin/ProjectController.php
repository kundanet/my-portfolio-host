<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $search = request('search');

        $projects = Project::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('title')
            ->paginate(9)
            ->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'required|image',
        ]);

        $path = $request->file('image')->store('projects', 'public');

        Project::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $path,
        ]);

        return redirect('/admin/projects')->with('success', 'Project added!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = $path;
        }

        $project->update($data);

        return redirect('/admin/projects')->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/admin/projects')->with('success', 'Project deleted!');
    }
}
