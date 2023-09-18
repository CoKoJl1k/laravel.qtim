<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Services\NewsService;
use Illuminate\Http\Request;


class NewsController extends Controller
{
    private NewsService $newsService;
    private NewsRepositoryInterface $newsRepository;

    public function __construct(NewsService $newsService, NewsRepositoryInterface $newsRepository)
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->newsService = $newsService;
        $this->newsRepository = $newsRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $news = $this->newsRepository->all();
        return response()->json(['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $errors = $this->newsService->validate($request);
        if(!empty($errors['message'])) {
            return response()->json(['status' => 'fail', 'message' => $errors['message']]);
        }

        $user = auth('api')->user();
        $news = new News;
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->user_id = $user->id;

        if ($news->save()) {
            return response()->json(['status' => 'success', 'message' => 'News created']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'News doesnt created']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Illuminate\Http\JsonResponse
    {
        $news = $this->newsRepository->getById($id);
        if (empty($news)) {
            return response()->json(['status' => 'fail', 'msg' => 'No data found']);
        }
        return response()->json(['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $errors = $this->newsService->validate($request);
        if(!empty($errors['message'])) {
            return response()->json(['status' => 'fail', 'message' => $errors['message']]);
        }
        $news = $this->newsRepository->getById($id);

        if(empty($news)) {
            return response()->json(['status' => 'fail', 'msg' => 'Not found news']);
        }
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->update();
        return response()->json(['status' => 'success', 'msg' => 'News updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $news = $this->newsRepository->getById($id);
        if(empty($news)) {
            return response()->json(['status' => 'fail', 'msg' => 'Not found news']);
        }
        $news->delete();
        return response()->json(['status' => 'success', 'msg' => 'News deleted']);
    }
}
