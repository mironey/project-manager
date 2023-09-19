<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class TaskSubmit extends Component
{
    use WithFileUploads;

    public $projectId;
    public $taskId;
    public $comment;
    public $attachedFiles = [];

    protected $rules = [
        'comment' => 'required',
        'attachedFiles.*' => 'nullable|file|mimes:pdf,docx,xlsx,txt,zip,mp3,wav,mp4,avi,webm,jpeg,png,jpg|max:2048',
    ];

    public function render()
    {
        return view('livewire.task.task-submit');
    }

    public function submitTask()
    {     
        $this->validate(); 
        $task = Task::findOrFail($this->taskId);
        $project_id = $task->project_id;
        $task_id = $task->id;
        $task_name_slug = Str::slug($this->comment, '-');

        $attachedUrl = [];

        if (is_array($this->attachedFiles)) {
            $i = 1;
            foreach ($this->attachedFiles as $attachedFile) {
                $attachedUrl[] = $attachedFile->storeAs('projects/submit/'.$this->projectId.'/'.$task_id, $task_name_slug.$i.'.'.$attachedFile->extension(), 'public');
                $i++;
            }
        } else {
            $attachedUrl = $this->attachedFiles->storeAs('projects/submit/'.$this->projectId.'/'.$task_id, $task_name_slug.'.'.$this->attachedFiles->extension(), 'public');
        }

        $serializedFiles = serialize($attachedUrl);
        $task->related_comment = $this->comment;
        $task->delivered_files = $serializedFiles;
        $task->save();

        session()->flash('message', 'Task delivered successfully.');
        return redirect()->route('supervisor.task.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId]);
    }
}
