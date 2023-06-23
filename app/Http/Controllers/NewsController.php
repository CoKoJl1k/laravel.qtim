<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['index']]);
         /*dd($auth);
        if (!$auth) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Need authentication',
            ]);
        }*/
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

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $news = new News;
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->user_id = $user->id;

        if ($news->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'News created',
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'News doesnt created',
            ]);
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
    public function edit(string $id)
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
        $title = $request->input('title');
        $description = $request->input('description');
        $res = DB::table('news')->where('id', '=', $id)->update(
            ["title" => $title, "description" => $description]);
        if ($res) {
            return response()->json(['status' => 'success', 'msg' => 'News updated']);
        } else {
            return response()->json(['status' => 'fail', 'msg' => 'News already updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = DB::table('news')->where('id', '=', $id)->delete();

        if ($res) {
            return response()->json(['status' => 'success', 'msg' => 'News deleted']);
        } else {
            return response()->json(['status' => 'fail', 'msg' => 'News already deleted']);
        }
    }
}
