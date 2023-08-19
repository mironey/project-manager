<?php

namespace App\Http\Livewire\Member;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberDashboard extends Component
{
    public function render()
    {
        return view('livewire.member.member-dashboard', [
            'tasks' => Task::where('user_id' , Auth::user()->id)->with('project')->get()
        ]);   
    }
}
