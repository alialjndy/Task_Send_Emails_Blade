<?php
namespace App\Service;

use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CrudTaskService{
    public function createTask(array $data){
        try{
            $task = Task::create($data);
            return $task ;
        }catch(Exception $e){
            Log::error('Error When Create Task '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    public function showTask(string $id){
        try{
            $task = Task::findOrFail($id);
            return $task ;
        }catch(Exception $e){
            Log::error('Error When show task '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    public function updateTask(array $data , string $task_id){
        try{
            $user = Auth::user();
            $task = Task::findOrFail($task_id);
            if($user->id != $task->user_id){
                return false ;
            }else{
                $task->update($data);
                return true ;
            }
        }catch(Exception $e){
            Log::error('Error When Update task '.$e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
    public function deleteTask(string $task_id){
        try{
            $user = Auth::user();
            $task = Task::findOrFail($task_id);
            if($user->id != $task->user_id){
                return false ;
            }
            $task->delete();
        }catch(Exception $e){
            Log::error('Error When Delete Task '.$e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
