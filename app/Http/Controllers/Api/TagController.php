<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Tag::query()->orderBy('name')->get());
    }

    public function store(StoreTagRequest $request): JsonResponse
    {
        $tag = Tag::query()->create($request->validated());
        return response()->json($tag, 201);
    }

    public function show(Tag $tag): JsonResponse
    {
        return response()->json($tag);
    }

    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $tag->update($request->validated());
        return response()->json($tag->fresh());
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();
        return response()->json(null, 204);
    }
}
