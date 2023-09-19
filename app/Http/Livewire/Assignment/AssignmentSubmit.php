<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AssignmentSubmit extends Component
{
    use WithFileUploads;

    public $projectId;
    public $taskId;
    public $assignmentId;
    public $comment;
    public $attachedFiles = [];

    protected $rules = [
        'comment' => 'required',
        'attachedFiles.*' => 'nullable|file|mimes:pdf,docx,xlsx,txt,zip,mp3,wav,mp4,avi,webm,jpeg,png,jpg|max:2048',
    ];

    public function render()
    {
        return view('livewire.assignment.assignment-submit');
    }

    public function submitAssignment()
    {     
        $this->validate(); 
        $assignment = Assignment::findOrFail($this->assignmentId);
        $task_id = $assignment->task_id;
        $assignment_id = $assignment->id;
        $assignment_name_slug = Str::slug($this->comment, '-');

        $attachedUrl = [];

        if (is_array($this->attachedFiles)) {
            $i = 1;
            foreach ($this->attachedFiles as $attachedFile) {
                $attachedUrl[] = $attachedFile->storeAs('projects/submit/'.$this->projectId.'/'.$task_id.'/'.$assignment_id, $assignment_name_slug.$i.'.'.$attachedFile->extension(), 'public');
                $i++;
            }
        } else {
            $attachedUrl = $this->attachedFiles->storeAs('projects/submit/'.$this->projectId.'/'.$task_id.'/'.$assignment_id, $assignment_name_slug.'.'.$this->attachedFiles->extension(), 'public');
        }

        $serializedFiles = serialize($attachedUrl);
        $assignment->member_comment = $this->comment;
        $assignment->delivered_files = $serializedFiles;
        $assignment->save();

        session()->flash('message', 'Assignment delivered successfully.');
        return redirect()->route('member.assignment.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId, 'assignmentId' => $this->assignmentId]);
    }
}
