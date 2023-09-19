<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProjectSubmit extends Component
{
    use WithFileUploads;

    public $projectId;
    public $comment;
    public $attachedFiles = [];

    protected $rules = [
        'comment' => 'required',
        'attachedFiles.*' => 'nullable|file|mimes:pdf,docx,xlsx,txt,zip,mp3,wav,mp4,avi,webm,jpeg,png,jpg|max:2048',
    ];

    public function render()
    {
        return view('livewire.project.project-submit');
    }

    public function submitProject()
    {     
        $this->validate(); 
        $project = Project::findOrFail($this->projectId);
        $project_name_slug = Str::slug($this->comment, '-');

        $attachedUrl = [];

        if (is_array($this->attachedFiles)) {
            $i = 1;
            foreach ($this->attachedFiles as $attachedFile) {
                $attachedUrl[] = $attachedFile->storeAs('projects/submit/'.$this->projectId, $project_name_slug.$i.'.'.$attachedFile->extension(), 'public');
                $i++;
            }
        } else {
            $attachedUrl = $this->attachedFiles->storeAs('projects/submit/'.$this->projectId, $project_name_slug.'.'.$this->attachedFiles->extension(), 'public');
        }

        $serializedFiles = serialize($attachedUrl);
        $project->related_comment = $this->comment;
        $project->delivered_files = $serializedFiles;
        $project->save();

        session()->flash('message', 'Project delivered successfully.');
        return redirect()->route('manager.project.show', $this->projectId);
    }
}
