<?php

namespace App\Http\Controllers\Api\Diary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\Task\StoreTaskRequest;
use App\Models\Diary\Task;
use HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Task::where('user_id', auth()->id())->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        try {
            $task = Task::create($data);

            auth()->user()->tasks()->save($task);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['success' => true, 'data' => $task], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        if (auth()->id() !== $task->user_id) {
            return response()->isServerError();
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $task = Task::findOrFail($id);

            $task->update($data);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['success' => true, 'data' => $task->toArray()], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
