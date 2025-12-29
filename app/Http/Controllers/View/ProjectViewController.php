<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectViewController extends Controller
{
    public function create(): Factory|View
    {
        return view('projects.create');
    }

    public function viewSingle(Project $project): Factory|View
    {
        return view('projects.view', compact('project'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('projects')->where(fn ($q) =>
                    $q->where('owner_id', auth()->id())
                ),
            ],
            'description' => ['nullable', 'string'],
        ]);

        Project::query()->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('home');
    }
}
