<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects/create', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        Project::create([
            'name' => $request->name,
            'author' => $request->author,
            'status' => $request->status
        ]);
        return response()->json([
            'message' => '💖❤️💕💕💖❤️❤️💖😍',
        ]);
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        dd($request->name);
        $project = Project::find($id);
        $project->update([
           'name' => $request->name,
           'author' => $request->author,
           'status' => $request->status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return response()->json([
            'message' => 'پروژه با موفقیت حذف شد',
        ]);
    }
}
