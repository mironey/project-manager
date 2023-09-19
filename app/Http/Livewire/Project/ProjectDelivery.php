<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectDelivery extends Component
{
    public $project;

    public function mount($projectId)
    {
        $this->project = Project::where('id', $projectId)->first();
    }

    public function render()
    {
        return view('livewire.project.project-delivery');
    }

}
