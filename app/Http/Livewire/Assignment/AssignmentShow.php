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

    public function mount($projectId, $taskId, $assignmentId)
    {
        $this->assignment = Assignment::with('user')->where('task_id', $taskId)->where('id', $assignmentId)->first();
    }

    public function render()
    {
        return view('livewire.assignment.assignment-show');
    }
}
