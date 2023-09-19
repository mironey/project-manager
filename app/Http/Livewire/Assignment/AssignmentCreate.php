<?php

namespace App\Http\Livewire\Assignment;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AssignmentCreate extends Component
{
    use WithFileUploads;

    public $projectId;
    public $taskId;
    public $users;
    public $name;
    public $description;
    public $due_date;
    public $status;
    public $assigned_user;
    public $attachedKits = [];

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string|max:255',
        'due_date' => 'required|date',
        'attachedKits.*' => 'nullable|file|mimes:pdf,docx,xlsx,txt,zip,mp3,wav,mp4,avi,webm,jpeg,png,jpg|max:2048',
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

        $task_id = $this->taskId;
       // $assignment_id = $assignment->id;
        $assignment_name_slug = Str::slug($this->name, '-');

        $attachedUrl = [];

        if (is_array($this->attachedKits)) {
            $i = 1;
            foreach ($this->attachedKits as $attachedKit) {
                $attachedUrl[] = $attachedKit->storeAs('projects/helping/'.$this->projectId.'/'.$task_id, $assignment_name_slug.$i.'.'.$attachedKit->extension(), 'public');
                $i++;
            }
        } else {
            $attachedUrl = $this->attachedKits->storeAs('projects/helping/'.$this->projectId.'/'.$task_id, $assignment_name_slug.'.'.$this->attachedKits->extension(), 'public');
        }

        $serializedFiles = serialize($attachedUrl);
        
        $assignment = Assignment::create([
            'task_id' => $this->taskId,
            'name' => $this->name,
            'description' => $this->description,
            'due_date'   => $this->due_date,
            'priority' => 1,
            'status'   => $this->status,
            'user_id'   => $this->assigned_user,
            'helping_kits' => $serializedFiles
        ]);

        $this->reset(['name', 'description', 'due_date', 'status', 'assigned_user', 'attachedKits']);
        session()->flash('message', 'Assignment created successfully.');

        if(Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.project.show', $this->taskId);
        } elseif (Auth::user()->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        } elseif (Auth::user()->hasRole('supervisor')) {
            return redirect()->route('supervisor.assignment.show', ['projectId' => $this->projectId, 'taskId' => $this->taskId, 'assignmentId' => $assignment->id]);
        }
    }
}
