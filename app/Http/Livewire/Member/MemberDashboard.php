<?php

namespace App\Http\Livewire\Member;

use App\Models\Assignment;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberDashboard extends Component
{
    public function render()
    {
        return view('livewire.member.member-dashboard', [
            'assignments' => Assignment::with(['task.project'])->where('user_id', Auth::user()->id)->get()->groupBy(['task.project.name', 'task.name'])
        ]);  
    }
}
