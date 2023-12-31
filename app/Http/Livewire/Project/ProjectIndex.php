<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.project.project-index', [
            'projects' => Project::with('user')->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function destroy($projectId) {
        $project = Project::findOrFail($projectId);
        $project->delete();
        session()->flash('message', 'Project deleted successfully.');
    }
}
