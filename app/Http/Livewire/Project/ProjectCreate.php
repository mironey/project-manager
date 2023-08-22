<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class ProjectCreate extends Component
{
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
        $this->users = User::role('manager')->get();
    }

    public function render()
    {
        return view('livewire.project.project-create');
    }

    public function createProject()
    {
        $this->validate();
        Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'start_date'   => $this->start_date,
            'end_date'   => $this->end_date,
            'status'   => $this->status,
            'user_id'   => $this->assigned_user
        ]);
        $this->reset(['name', 'description', 'start_date', 'end_date', 'status', 'assigned_user']);
        session()->flash('message', 'Entry created successfully.');
        return redirect()->route('project.index');
    }
}
