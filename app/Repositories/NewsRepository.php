<?php

namespace App\Repositories;
use App\Models\News;
use App\Models\User;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class NewsRepository implements NewsRepositoryInterface
{
    public function all()
    {
        return News::all();
    }

    public function getById($id)
    {
        return News::find($id);
    }

    public function getByUser(User $user)
    {
        return News::find($user->id);
    }
}
