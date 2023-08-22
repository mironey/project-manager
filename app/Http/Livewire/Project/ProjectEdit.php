<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class ProjectEdit extends Component
{
    public $projectId;
    public $project;
    public $users;
    public $name;
    public $description;
    public $start_date;
    public $end_date;
    public $status;
    public $assigned_user;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'status' => 'required|numeric',
        'assigned_user' => 'required|integer',
    ];

    public function mount()
    {
        $this->project = Project::with('user')->where('id', $this->projectId)->first();
        $this->users = User::role('manager')->get();

        $this->name = $this->project->name;
        $this->description = $this->project->description;
        $this->start_date = $this->project->start_date;
        $this->end_date = $this->project->end_date;
        $this->status = $this->project->status;
        $this->assigned_user = $this->project->user_id;
    }

    public function render()
    {
        return view('livewire.project.project-edit');
    }

    public function updateProject()
    {
        $this->validate();
        $this->project->name = $this->name;
        $this->project->description = $this->description;
        $this->project->start_date = $this->start_date;
        $this->project->end_date = $this->end_date;
        $this->project->status = $this->status;
        $this->project->user_id = $this->assigned_user;
        $this->project->save();
        session()->flash('message', 'Project updated successfully.');
        return redirect()->route('admin.project.show', $this->projectId);
    }
}
