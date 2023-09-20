<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTask;

use App\Models\News;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
class QueueController extends Controller
{

    private NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd(config('logging.channels.single'));

        //dd($this->app['config']["logging.channels.{$name}"]);
        Log::info(1111);
        die();
        $data = $this->newsRepository->all();
        for ($i = 0 ; $i <= 3; $i++) {
            //ProcessTask::dispatch($data)->delay(Carbon::now()->addSeconds(5));
            ProcessTask::dispatch($data)->onQueue('default');
        }
        for ($i = 0 ; $i <= 3; $i++) {
            ProcessTask::dispatch($data)->onQueue('default2');
        }
        for ($i = 0 ; $i <= 3; $i++) {
            ProcessTask::dispatch($data)->onQueue('default3');
        }

    }


    public function create(Request $request)
    {
        $newsData = $this->newsRepository->all();
        //  $newsData = serialize($newsData);
        $newsData = json_encode($newsData);
        $news = new News();
        $news->user_id = 1;
        $news->json = $newsData;
        $news->title = 'title';
        $news->description =  'description';
        $news->save();
        return response()->json(['message' => 'news created', 'news' => $news]);
    }

    public function show(Request $request)
    {
        $news = $this->newsRepository->all();
        $news = $news->map(function ($item, $key) {
            $item->json = json_decode($item->json);
            return $item;
        });
        return response()->json(['value' => $news]);
    }
}
