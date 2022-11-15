<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TaskController extends Controller
{
    private Task|Builder $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('query')) {
            $query = $request->input('query');

            $this->task = $this->task
                ->whereLike('title', $query)
                ->orWhereLike('content', $query)
                ->orWhereLike('status', $query);
        }

        $this->task = $this->task->with('tags');

        return new TaskCollection($this->task->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $tagIds = Arr::pluck($request->validated('tags'), 'id');

        $this->task->fill($request->validated())->save();

        $this->task->tags()->attach($tagIds);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTaskRequest  $request
     * @param  string $taskId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $taskId)
    {
        $tagIds = Arr::pluck($request->validated('tags'), 'id');

        $task = $this->task->findOrFail($taskId);

        $task->update($request->validated());
        $task->tags()->sync($tagIds);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $taskId
     * @return \Illuminate\Http\Response
     */
    public function destroy($taskId)
    {
        $task = $this->task->findOrFail($taskId);

        $task->tags()->detach();
        $task->delete();

        return response()->noContent();
    }
}
