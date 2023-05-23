<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\StoraAndUpdateTagRequest;
use App\Http\Resources\Api\Dashboard\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read-tags'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        return $this->sendResponse(TagResource::collection(Tag::paginate(10)));
    }

    public function show(Tag $tag)
    {
        abort_if(Gate::denies('read-tags'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        return $this->sendResponse(TagResource::make($tag));
    }

    public function store(StoraAndUpdateTagRequest $request)
    {
        abort_if(Gate::denies('create-tags'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $tag = Tag::create($request->validated());

        Auth::user()->logs()->create(['description' => 'Создал тег ' . $tag->name]);

        return $this->sendResponse(TagResource::make($tag), '', Response::HTTP_CREATED);
    }

    public function update(StoraAndUpdateTagRequest $request, Tag $tag)
    {
        abort_if(Gate::denies('update-tags'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $tag->update($request->validated());

        Auth::user()->logs()->create(['description' => 'Обновил тег ' . $tag->name]);

        return $this->sendResponse(TagResource::make($tag), '', Response::HTTP_ACCEPTED);
    }

    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('delete-tags'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $tag->delete();

        Auth::user()->logs()->create(['description' => 'Удалил тег ' . $tag->name]);


        return $this->sendResponse([], '', Response::HTTP_NO_CONTENT);
    }
}
