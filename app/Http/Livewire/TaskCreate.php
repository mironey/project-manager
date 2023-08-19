<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskCreate extends Component
{
    public $projectId;
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
        'assigned_user' => 'required|integer'
    ];

    public function mount()
    {
        $this->users = User::role('member')->get();
    }

    public function render()
    {
        return view('livewire.task-create');
    }

    public function createTask()
    {
        $this->validate();
        Task::create([
            'project_id' => $this->projectId,
            'name' => $this->name,
            'description' => $this->description,
            'due_date'   => $this->due_date,
            'priority' => 1,
            'status'   => $this->status,
            'user_id'   => $this->assigned_user
        ]);
        $this->reset(['name', 'description', 'due_date', 'status', 'assigned_user']);
        session()->flash('message', 'Task created successfully.');

        if(Auth::user()->hasRole('admin')) {
            return redirect()->route('project.show', $this->projectId);
        } elseif (Auth::user()->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        }
    }
}
