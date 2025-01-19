<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadVideoRequest;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoController extends Controller
{
    /**
     * Display a paginated list of videos.
     */
    public function index(Request $request): JsonResponse
    {
        $videos = Video::paginate($request->pageSize ?? 10);

        return response()->json($videos);
    }

    /**
     * Store a newly uploaded video and thumbnail in storage.
     */
    public function store(UploadVideoRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Store video file
        $videoFile = $validated['video'];
        $videoPath = $videoFile->store('videos', 'public');

        // Store thumbnail file
        $thumbnailFile = $validated['thumbnail'];
        $thumbnailPath = $thumbnailFile->store('thumbnails', 'public');

        // Save video metadata to database
        $video = Video::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
        ]);

        return response()->json([
            'message' => 'Video uploaded successfully',
            'video' => $video,
        ], 201);
    }

    /**
     * Display the specified video details.
     */
    public function show(Video $video): JsonResponse
    {
        return response()->json($video);
    }

    /**
     * Remove the specified video from storage.
     */
    public function destroy(Video $video): JsonResponse
    {
        Storage::disk('public')->delete($video->file_path);
        Storage::disk('public')->delete($video->thumbnail_path);
        
        $video->delete();

        return response()->json([
            'message' => 'Video deleted successfully',
        ], 200);
    }


    public function serveVideo(Video $video): BinaryFileResponse
    {
        $videoPath = storage_path('app/public/' . $video->file_path);

        if (!file_exists($videoPath)) {
            abort(404, 'Video file not found.');
        }

        return response()->file($videoPath);
    }

    public function serveThumbnail(Video $video): BinaryFileResponse
    {
        $thumbnailPath = storage_path('app/public/' . $video->thumbnail_path);

        if (!file_exists($thumbnailPath)) {
            abort(404, 'Thumbnail image not found.');
        }

        return response()->file($thumbnailPath);
    }
}