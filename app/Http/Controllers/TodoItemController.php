<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    public function delete(int $todoId, int $itemId)
    {
        try {
            TodoItem::where('todo_id', $todoId)->where('id', $itemId)->delete();
            return response()->json();
        } catch (\Exception $e) {
            return response()->json(['errorMsg' => $e->getMessage()]);
        }
    }
}
