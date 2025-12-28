<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(): Factory|View
    {
        $user = Auth::user();
        $uid = $user->getAuthIdentifier();

        $projectIds = ProjectMember::query()
            ->where('user_id', $uid)
            ->pluck('project_id');

        $projects = Project::with('owner')
            ->where('owner_id', $uid)
            ->orWhereIn('id', $projectIds)
            ->orderByDesc('updated_at')
            ->get();

        $bugs = Bug::with(['project', 'status', 'severity', 'priority', 'reporter', 'assignee'])
            ->where('reporter_id', $uid)
            ->orWhere('assigned_to', $uid)
            ->orWhereIn('project_id', $projects->pluck('id'))
            ->orderByDesc('updated_at')
            ->limit(50)
            ->get();

        return view('profile.index', compact('user', 'projects', 'bugs'));
    }
}
