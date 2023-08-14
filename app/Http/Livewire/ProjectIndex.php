<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.project-index', [
            'projects' => Project::with('user')->paginate(10)
        ]);
    }
}
