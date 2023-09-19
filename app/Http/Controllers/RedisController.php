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
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $news = $this->newsRepository->all();
        $news = serialize($news);
        Redis::set('news', $news);
        return response()->json(['news' => $news]);
    }

    public function setKeyValue(Request $request)
    {
        Redis::set('key', 'value');
        return response()->json(['message' => 'Key-Value pair set in Redis']);
    }

    public function getValue(Request $request)
    {
        $value = Redis::get('news');
        $value = unserialize($value);
        return response()->json(['value' => $value]);
    }

}
