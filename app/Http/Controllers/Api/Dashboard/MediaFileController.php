<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Filters\MediaFileFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\StoreMediaFileRequest;
use App\Http\Resources\Api\Dashboard\MediaFileResource;
use App\Models\MediaFile;
use App\Services\MediaFileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;

class MediaFileController extends Controller
{
    public function index(MediaFileFilter $filter)
    {
        abort_if(Gate::denies('read-media_files'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $mediaFiles = MediaFileResource::collection(MediaFile::filter($filter)->get());

        return $this->sendResponse($mediaFiles);
    }

    public function store(StoreMediaFileRequest $request)
    {
        abort_if(Gate::denies('create-media_files'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $mediaFile = MediaFileService::create($request->validated());

        return $this->sendResponse(MediaFileResource::make($mediaFile), '',Response::HTTP_CREATED);
    }

    public function show(MediaFile $mediaFile)
    {
        //
    }

    public function destroy(MediaFile $mediaFile)
    {
        //
    }
}
