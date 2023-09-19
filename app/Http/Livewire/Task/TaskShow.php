<?php

namespace App\Http\Livewire\Task;

use App\Models\Assignment;
use App\Models\Task;
use Livewire\Component;

class TaskShow extends Component
{
    public $task;
    public $assignments;

    public function mount($projectId, $taskId)
    {
        $this->task = Task::with('user')->where('project_id', $projectId)->where('id', $taskId)->first();
       // $this->assignments = $this->task->assignmentsByStatus();

        $this->assignments = Assignment::with('user')->where('task_id', $taskId)->get();
    }

    public function render()
    {
        return view('livewire.task.task-show');
    }

    public function startTask() 
    {
        $this->task->status = 2;
        $this->task->save();
        session()->flash('message', 'Task started successfully.');
    }
}
