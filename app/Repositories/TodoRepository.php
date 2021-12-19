<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository
{
    public function create(array $data)
    {
        return auth()->user()->todos()->create($data);
    }

}