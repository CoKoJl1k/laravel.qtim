<?php

namespace App\Http\Controllers;


use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class RedisController extends Controller
{

    private NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
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

    public function setKeyValue(Request $request)
    {

        Redis::set('key', 'value');
        return response()->json(['message' => 'Key-Value pair set in Redis']);
    }

    public function getValue(Request $request)
    {
        $value = Redis::get('key');
        return response()->json(['value' => $value]);
    }

}
