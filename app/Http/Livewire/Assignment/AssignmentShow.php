<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use Livewire\Component;

class AssignmentShow extends Component
{
    public $projectId;
    public $taskId;
    public $assignmentId;
    public $assignment;

    public $enableStatusForm = false;

    public $statusOption = ['Not started', 'In progress', 'In modification', 'Completed'];
    public $selectStatus;

    public function mount($projectId, $taskId, $assignmentId)
    {
        $this->assignment = Assignment::with('user')->where('task_id', $taskId)->where('id', $assignmentId)->first();
        $this->selectStatus = $this->assignment->status;
    }

    public function render()
    {
        return view('livewire.assignment.assignment-show');
    }

    public function changeStatusForm() {
        $this->enableStatusForm = true;
    }

    public function updateStatus() {
        $this->assignment->status = $this->selectStatus;
        $this->assignment->save();
        session()->flash('message', 'Assignment updated successfully.');
        $this->enableStatusForm = false;
    }

    public function startAssignment() 
    {
        $this->assignment->status = 2;
        $this->assignment->save();
        session()->flash('message', 'Assignment started successfully.');
    }
}
