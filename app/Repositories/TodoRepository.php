<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Models\TodoItem;

class TodoRepository
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index()
    {
        return Todo::with('items')->orderBy('created_at', 'DESC')->get();
    }

    public function find($id)
    {
        return auth()->user()->todos()->find($id);
    }

    public function findWithItems($id)
    {
        return auth()->user()->todos()->with('items')->find($id);
    }

    public function update($id, array $data)
    {
        return auth()->user()->todos()->where('id', $id)->update($data);
    }

    public function create(array $data)
    {
        return auth()->user()->todos()->create($data);
    }

}