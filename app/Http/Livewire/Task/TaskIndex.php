<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class TaskIndex extends Component
{
    public $projectId;
    public $tasks;

    public function mount($projectId) {
        $this->tasks = Task::with('user')->where('project_id', $projectId)->get();
    }
    
    public function render()
    {
        return view('livewire.task.task-index');
    }
}
