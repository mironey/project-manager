<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class ProjectShow extends Component
{
    public $project;
    public $task;

    public function mount($projectId)
    {
        $this->project = Project::where('id', $projectId)->first();
        $this->task = Task::with('user')->where('project_id', $projectId)->first();
    }

    public function render()
    {
        return view('livewire.project-show');
    }
}
