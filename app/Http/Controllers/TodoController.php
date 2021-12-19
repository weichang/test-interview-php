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
            // $result['items']= '';
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
            $result =$this->todoRepo->update($id, $data);
            return response()->json(['data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['errorMsg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {

    }
}
