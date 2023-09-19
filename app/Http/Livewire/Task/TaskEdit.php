<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskEdit extends Component
{
    public $projectId;
    public $taskId;
    public $task;
    public $users;
    public $name;
    public $description;
    public $due_date;
    public $status;
    public $assigned_user;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string|max:255',
        'due_date' => 'required|date',
        'status' => 'required|numeric',
        'assigned_user' => 'required|integer',
    ];

    public function mount()
    {
        $this->task = Task::with('user')->where('project_id', $this->projectId)->where('id', $this->taskId)->first();
        $this->users = User::role('supervisor')->get();

        $this->name = $this->task->name;
        $this->description = $this->task->description;
        $this->due_date = $this->task->due_date;
        $this->status = $this->task->status;
        $this->assigned_user = $this->task->user_id;
    }

    public function render()
    {
        return view('livewire.task.task-edit');
    }

    public function updateTask()
    {
        $this->validate();
        $this->task->name = $this->name;
        $this->task->description = $this->description;
        $this->task->due_date = $this->due_date;
        $this->task->priority = 1;
        $this->task->status = $this->status;
        $this->task->user_id = $this->assigned_user;
        $this->task->save();
        session()->flash('message', 'Task updated successfully.');
        if(Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.task.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId]);
        } elseif (Auth::user()->hasRole('manager')) {
            return redirect()->route('manager.task.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId]);
        }
    }
}
