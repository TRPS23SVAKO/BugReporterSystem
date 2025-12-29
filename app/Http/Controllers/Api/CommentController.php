<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Bug;
use App\Models\Comment;
use App\Models\ProjectMember;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
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
        return response()->json([
            'message' => 'Use GET /api/bugs/{bug} to get comments, or implement ?bug_id= filtering if needed.'
        ]);
    }

    public function store(StoreCommentRequest $request): JsonResponse
    {
        $data = $request->validated();
        $bug = Bug::with('project')->findOrFail($data['bug_id']);
        $this->checkAccess($bug);
        $data['user_id'] = auth()->id();
        $comment = Comment::query()->create($data);
        return response()->json($comment->load('user'), 201);
    }

    public function show(Comment $comment): JsonResponse
    {
        $comment->load(['user', 'bug.project']);
        $this->checkAccess($comment->bug);
        return response()->json($comment, 200);
    }

    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        $comment->load(['bug.project']);
        $this->checkAccess($comment->bug);
        abort_if($comment->user_id !== auth()->id(), 403, 'Tik autorius gali redaguoti');
        $comment->update($request->validated());
        return response()->json($comment->fresh()->load('user'));
    }

    public function destroy(Comment $comment)
    {
        $comment->load(['bug.project']);
        $this->checkAccess($comment->bug);
        abort_if(!($comment->user_id === auth()->id() || $comment->bug->project->owner_id === auth()->id()), 403, 'Forbidden');
        $comment->delete();
        return response()->json(null, 204);
    }
}
