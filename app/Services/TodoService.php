<?php
namespace App\Services;
use App\Models\Todo;

class TodoService
{

    public function addTodo(array $data): bool
    {
    
        $todo = new Todo();

        $todo->title = $data['title'];
        $todo->description = $data['description'];  
        $todo->task_status = $data['task_status'];
        $todo->assigned_to = $data['assigned_to'];
        $todo->save();
        return true;
    }

    public function updateTodo($id, array $data): bool
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->title = $data['title'] ?? $todo->title;
            $todo->description = $data['description'] ?? $todo->description;
            $todo->task_status = $data['task_status'] ?? $todo->task_status;
            $todo->assigned_to = $data['assigned_to'] ?? $todo->assigned_to;
            $todo->save();
            return true;
        }

        return false;
    }

    public static function deleteTodo($id): bool
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
            return true;
        }

        return false;
    }

}
