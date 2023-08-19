<?php

namespace App\Http\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $project = Project::all();
        return view('livewire.admin.admin-dashboard', [
            'project' => $project
        ]);
    }
}
