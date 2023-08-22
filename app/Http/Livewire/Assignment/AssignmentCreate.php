<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignmentCreate extends Component
{
    public $projectId;
    public $taskId;
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
        return view('livewire.assignment.assignment-create');
    }

    public function createAssignment()
    {
        $this->validate();
        Assignment::create([
            'task_id' => $this->taskId,
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
            return redirect()->route('admin.project.show', $this->taskId);
        } elseif (Auth::user()->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        } elseif (Auth::user()->hasRole('supervisor')) {
            return redirect()->route('supervisor.task.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId]);
        }
    }
}
