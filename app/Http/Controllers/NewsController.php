<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewsController extends Controller
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->newsService = $newsService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $news = News::all();
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
        $news = DB::table('news')->where('id', '=', $id)->get();
        if (!empty($news)) {
            return response()->json(['news' => $news]);
        } else {
            return response()->json(['status' => 'fail', 'msg' => 'No data found']);
        }
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

        $title = $request->input('title');
        $description = $request->input('description');

        $res = DB::table('news')->where('id', '=', $id)->update(
            ["title" => $title, "description" => $description]);
        if ($res) {
            return response()->json(['status' => 'success', 'msg' => 'News updated']);
        } else {
            return response()->json(['status' => 'fail','msg' => 'News already updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $res = DB::table('news')->where('id', '=', $id)->delete();
        if ($res) {
            return response()->json(['status' => 'success', 'msg' => 'News deleted']);
        } else {
            return response()->json(['status' => 'fail', 'msg' => 'News already deleted']);
        }
    }
}
