<?php

namespace App\Http\Controllers;

use App\Models\Project;

class MainController extends Controller
{
    public function index()
    {
        $projects = Project::with('owner')
            ->orderByDesc('updated_at')
            ->get();

        return view('main', compact('projects'));
    }
}
