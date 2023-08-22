<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignmentEdit extends Component
{
    public $projectId;
    public $taskId;
    public $assignmentId;
    public $assignment;
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
        'assigned_user' => 'required|integer',
    ];

    public function mount()
    {
        $this->assignment = Assignment::with('user')->where('task_id', $this->taskId)->where('id', $this->assignmentId)->first();
        $this->users = User::role('member')->get();

        $this->name = $this->assignment->name;
        $this->description = $this->assignment->description;
        $this->due_date = $this->assignment->due_date;
        $this->status = $this->assignment->status;
        $this->assigned_user = $this->assignment->user_id;
    }

    public function render()
    {
        return view('livewire.assignment.assignment-edit');
    }

    public function updateAssignment()
    {
        $this->validate();
        $this->assignment->name = $this->name;
        $this->assignment->description = $this->description;
        $this->assignment->due_date = $this->due_date;
        $this->assignment->priority = 1;
        $this->assignment->status = $this->status;
        $this->assignment->user_id = $this->assigned_user;
        $this->assignment->save();
        session()->flash('message', 'Assignment updated successfully.');
        if(Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.assignment.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId]);
        } elseif (Auth::user()->hasRole('manager')) {
            return redirect()->route('manager.assignment.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId]);
        } elseif (Auth::user()->hasRole('supervisor')) {
            return redirect()->route('supervisor.assignment.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId, 'assignmentId' => $this->assignmentId]);
        }
    }
}
