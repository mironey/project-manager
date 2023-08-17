<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskShow extends Component
{
    public $task;

    public function mount($projectId, $taskId)
    {
        $this->task = Task::with('user')
        ->where('project_id', $projectId)
        ->where('id', $taskId)
        ->first();
    }

    public function render()
    {
        return view('livewire.task-show');
    }
}
