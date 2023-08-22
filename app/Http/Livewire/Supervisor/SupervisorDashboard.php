<?php

namespace App\Http\Livewire\Supervisor;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SupervisorDashboard extends Component
{
    public function render()
    {
        return view('livewire.supervisor.supervisor-dashboard', [
            'tasks' => Task::where('user_id' , Auth::user()->id)->with('project')->get()
        ]);   
    }
}
