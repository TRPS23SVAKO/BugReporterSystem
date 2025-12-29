<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    protected function checkAccess(Project $project): void
    {
        $uid = auth()->id();
        $isOwner = ($project->owner_id === $uid);
        $isMember = ProjectMember::query()
            ->where('project_id', $project->id)
            ->where('user_id', $uid)
            ->exists();
        abort_if(!($isOwner || $isMember), 403, 'Forbidden');
    }

    public function index(): JsonResponse
    {
        $uid = auth()->id();
        $projects = Project::query()
            ->where('owner_id', $uid)
            ->orWhereIn('id', ProjectMember::query()->where('user_id', $uid)->select('project_id'))
            ->orderByDesc('updated_at')
            ->get();
        return response()->json($projects);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();

        $project = Project::query()->create($data);

        ProjectMember::query()->updateOrCreate(
            ['project_id' => $project->id, 'user_id' => auth()->id()],
            ['project_role' => 'owner', 'joined_at' => now()]
        );

        return response()->json($project, 201);
    }

    public function show(Project $project): JsonResponse
    {
        $this->checkAccess($project);
        $project->load([
            'owner:id,name,email',
            'members:id,name,email'
        ]);
        return response()->json($project);
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $this->checkAccess($project);
        abort_if($project->owner_id !== auth()->id(), 403, 'Tik projekto savininkas gali tai daryti');
        $project->update($request->validated());
        return response()->json($project->fresh());
    }

    public function destroy(Project $project): JsonResponse
    {
        $this->checkAccess($project);
        abort_if($project->owner_id !== auth()->id(), 403, 'Tik projekto savininkas gali tai daryti');
        $project->delete();
        return response()->json(null, 204);
    }

    public function bugs(Project $project): JsonResponse
    {
        $this->checkAccess($project);
        $bugs = $project->bugs()
            ->with(['status', 'severity', 'priority', 'reporter', 'assignee'])
            ->orderByDesc('updated_at')
            ->get();
        return response()->json($bugs);
    }
}
