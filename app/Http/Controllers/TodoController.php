<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\TodoItem;
use App\Repositories\TodoRepository;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    protected $todoRepo;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepo = $todoRepository;
    }

    public function index()
    {
        try {
            $result = $this->todoRepo->index();
            return response()->json(['data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['errorMsg' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->input();
            $input['attachment'] = json_encode($input);
            $result = $this->todoRepo->create($input);
            $result = $this->todoRepo->find($result->id);
            return response()->json(['data' => $result]);
        } catch (\Exception $e) {
            \Log::error('error', ['msg' => $e->getMessage()]);
            return response()->json(['errorMsg' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $result = $this->todoRepo->find($id);
            // $result['items']= '';
            return response()->json(['data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['errorMsg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->input();
            $this->todoRepo->update($id, $data);
            $result = $this->todoRepo->find($id);
            return response()->json(['data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['errorMsg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = auth()->user();
            Todo::where('user_id', '=', $user->id)->where('id', '=', $id)->firstOrFail()->delete();
            TodoItem::where('todo_id', '=', $id)->delete();
            return response()->json(['statusCode' => \Symfony\Component\HttpFoundation\Response::HTTP_OK]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
