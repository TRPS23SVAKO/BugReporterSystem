<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBugRequest;
use App\Http\Requests\UpdateBugRequest;
use App\Models\Bug;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class BugController extends Controller
{
    protected function checkAccess(Bug $bug): void
    {
        $uid = auth()->id();
        $isOwner = ($bug->project?->owner_id === $uid);
        $isMember = ProjectMember::query()
            ->where('project_id', $bug->project_id)
            ->where('user_id', $uid)
            ->exists();
        abort_if(!($isOwner || $isMember), 403, 'Forbidden');
    }

    public function index(): JsonResponse
    {
        $uid = auth()->id();
        $projectIds = ProjectMember::query()
            ->where('user_id', $uid)
            ->pluck('project_id');
        $bugs = Bug::query()
            ->with(['status', 'severity', 'priority', 'project', 'reporter', 'assignee', 'tags'])
            ->whereHas('project', fn ($q) => $q->where('owner_id', $uid))
            ->orWhereIn('project_id', $projectIds)
            ->orderByDesc('updated_at')
            ->get();
        return response()->json($bugs);
    }

    public function store(StoreBugRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['reporter_id'] = auth()->id();
        $uid = auth()->id();
        $isMember = ProjectMember::query()->where('project_id', $data['project_id'])->where('user_id', $uid)->exists();
        $isOwner = Project::query()->where('id', $data['project_id'])->where('owner_id', $uid)->exists();
        abort_if(!($isOwner || $isMember), 403, 'Forbidden');
        $bug = Bug::query()->create($data);
        return response()->json($bug->load(['status', 'severity', 'priority']), 201);
    }

    public function show(Bug $bug): JsonResponse
    {
        $bug->load(['project', 'status', 'severity', 'priority', 'reporter', 'assignee', 'tags', 'comments.user']);
        $this->checkAccess($bug);
        return response()->json($bug);
    }

    public function update(UpdateBugRequest $request, Bug $bug): JsonResponse
    {
        $bug->load('project');
        $this->checkAccess($bug);
        $bug->update($request->validated());
        return response()->json($bug->fresh()->load(['status', 'severity', 'priority', 'assignee']));
    }

    public function destroy(Bug $bug): JsonResponse
    {
        $bug->load('project');
        $this->checkAccess($bug);
        abort_if(!($bug->project->owner_id === auth()->id() || $bug->reporter_id === auth()->id()), 403, 'Forbidden');
        $bug->delete();
        return response()->json(null, 204);
    }

    public function attachTag(Bug $bug, Tag $tag): JsonResponse
    {
        $bug->load('project');
        $this->checkAccess($bug);
        $bug->tags()->syncWithoutDetaching([$tag->id]);
        return response()->json($bug->fresh()->load('tags'));
    }

    public function detachTag(Bug $bug, Tag $tag): JsonResponse
    {
        $bug->load('project');
        $this->checkAccess($bug);
        $bug->tags()->detach($tag->id);
        return response()->json($bug->fresh()->load('tags'));
    }
}
