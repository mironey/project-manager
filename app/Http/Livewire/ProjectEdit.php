<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectEdit extends Component
{
    public $project;

    public function mount($projectId)
    {
        $this->project = Project::where('id', $projectId)->first();
    }

    public function render()
    {
        return view('livewire.project-edit');
    }
}
