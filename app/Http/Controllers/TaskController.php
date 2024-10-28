<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Service\CrudTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    protected $crudTaskService ;
    public function __construct(CrudTaskService $crudTaskService){
        $this->crudTaskService = $crudTaskService;
    }
    /**
     * show all tasks view and Cache result for one hour
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $allTasks = Cache::remember('Tasks',3600,function(){
            return Task::select('id','title','due_date','status')->get();
        });
        return view('allTasks',compact('allTasks'));
    }

    /**
     * view Create Task Page to store new task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $user = Auth::user();
        return view('addTask',compact('user'));
    }

    /**
     * Store new Task And Forget Cache From Memory
     * @param \App\Http\Requests\Task\CreateTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTaskRequest $request)
    {
        Cache::forget('Tasks');
        $data = $request->validated();
        $this->crudTaskService->createTask($data);
        return redirect()->route('tasks.index')->with('success','task created successfully');
    }

    /**
     * show specific task and Cache View in Memory
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $task = Cache::remember('Task'.$id , 3600 , function() use($id){
            return $this->crudTaskService->showTask($id);
        });
        return view('TaskInfo',compact('task'));
    }

    /**
     * View Edit Page
     * @param \App\Models\Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        $user = Auth::user();
        return view('updateTask',compact('user','task'));
    }

    /**
     * Update Specific Task with id
     * @param \App\Http\Requests\Task\UpdateTaskRequest $request
     * @param string $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request, string $task_id)
    {
        Cache::forget('Tasks');
        Cache::forget('Task'.$task_id);
        $data = $request->validated();
        if($this->crudTaskService->updateTask($data , $task_id)){

            return redirect()->route('tasks.show',$task_id)->with('success','task udpated successfully');
        }
        return redirect()->back()->with('error','you cant update this task');
    }

    /**
     * Delete Task And Froget Cache Form Memory
     * @param string $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $task_id)
    {
        Cache::forget('Tasks');
        if($this->crudTaskService->deleteTask($task_id)){
            return redirect()->route('tasks.index')->with('success','task deleted successfully');
        }else{
            return redirect()->back()->with('error','you cant delete this task');
        }
    }
}
