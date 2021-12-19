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
        return Todo::where('user_id', $this->user->id)->orderBy('created_at', 'DESC')->get();
    }

    public function find($id)
    {
        return Todo::where('user_id', $this->user->id)->find($id);
    }

    public function update($id, array $data)
    {
        $todo = Todo::where('user_id', $this->user->id)->find($id);
        return $todo ? $todo->update($data) : false;
    }

    public function create(array $data)
    {
        return auth()->user()->todos()->create($data);
    }

}