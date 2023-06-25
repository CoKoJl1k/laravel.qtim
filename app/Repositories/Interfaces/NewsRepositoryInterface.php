<?php


namespace App\Repositories\Interfaces;

use App\Models\User;


interface NewsRepositoryInterface
{
    public function all();

    public function getById($id);

    public function getByUser(User $user);
}
