<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Models\TodoItem;

class TodoRepository
{
    public function index()
    {
         $user = auth()->user();
         return Todo::where('user_id', $user->id)->orderBy('created_at','DESC')->get();
    }

    public function create(array $data)
    {
        return auth()->user()->todos()->create($data);
    }

}