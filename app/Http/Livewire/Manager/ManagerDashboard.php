<?php

namespace App\Http\Livewire\Manager;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ManagerDashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.manager.manager-dashboard', [
            'projects' => Project::where('user_id' , Auth::user()->id)->with('taskWithMember')->get()
        ]);
    }
}
