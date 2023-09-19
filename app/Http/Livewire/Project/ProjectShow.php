<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;

class ProjectShow extends Component
{
    public $project;
    public $task;

    public $start_date = '2023-09-18';
    public $end_date = '2023-09-22';
    
    public $remaining_day;
    public $remaining_hour;
    public $remaining_min;
    public $remaining_sec;

    public $countdown;

    public function mount($projectId)
    {
        $this->project = Project::where('id', $projectId)->first();
        $this->task = Task::with('user')->where('project_id', $projectId)->first();
        $this->timeRemaining();
    }

    public function render()
    {
        return view('livewire.project.project-show');
    }

    public function timeRemaining() {
        $start = Carbon::parse($this->project->start_date);
        $end = Carbon::parse($this->project->end_date)->endOfDay();
        $now = Carbon::now();

        if($this->project->status != 4) {
            if(now()->lessThan($start)) {
                $remaining = $start->diff($now);
                $remaining_day = sprintf('%02d', $remaining->d); 
                $remaining_hour = sprintf('%02d', $remaining->h);
                $remaining_min = sprintf('%02d', $remaining->i);
                $remaining_sec = sprintf('%02d', $remaining->s);
                $this->countdown = <<<TEXT
                <div class="alert alert-secondary m-1">
                    <h5 class="alert-heading text-center">The project will start after</h5>
                    <div class="d-flex flex-row justify-content-between gap-2">
                        <div class="item text-center">
                            <p class="bg-secondary p-3 m-1 text-white rounded">$remaining_day</p>
                            <p class="mb-0">Day(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-secondary p-3 m-1 text-white rounded">$remaining_hour</p>
                            <p class="mb-0">Hour(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-secondary p-3 m-1 text-white rounded">$remaining_min</p>
                            <p class="mb-0">Minute(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-secondary p-3 m-1 text-white rounded">$remaining_sec</p>
                            <p class="mb-0">Second(s)</p>
                        </div>
                    </div>
                </div>
               TEXT;
            } elseif (now()->between($start, $end)) {
                $remaining = $end->diff($now);
                $remaining_day = sprintf('%02d', $remaining->d); 
                $remaining_hour = sprintf('%02d', $remaining->h);
                $remaining_min = sprintf('%02d', $remaining->i);
                $remaining_sec = sprintf('%02d', $remaining->s);
                $this->countdown = <<<TEXT
                <div class="alert alert-success m-1">
                    <h5 class="alert-heading text-center">The project will end after</h5>
                    <div class="d-flex flex-row justify-content-between gap-2">
                        <div class="item text-center">
                            <p class="bg-success p-3 m-1 text-white rounded">$remaining_day</p>
                            <p class="mb-0">Day(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-success p-3 m-1 text-white rounded">$remaining_hour</p>
                            <p class="mb-0">Hour(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-success p-3 m-1 text-white rounded">$remaining_min</p>
                            <p class="mb-0">Minute(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-success p-3 m-1 text-white rounded">$remaining_sec</p>
                            <p class="mb-0">Second(s)</p>
                        </div>
                    </div>
                </div>
               TEXT;
            } elseif(now()->greaterThan($end)) {
                $remaining = $now->diff($end);
                $remaining_day = sprintf('%02d', $remaining->d); 
                $remaining_hour = sprintf('%02d', $remaining->h);
                $remaining_min = sprintf('%02d', $remaining->i);
                $remaining_sec = sprintf('%02d', $remaining->s);
                $this->countdown = <<<TEXT
                <div class="alert alert-danger m-1">
                    <h5 class="alert-heading text-center">The project is already late</h5>
                    <div class="d-flex flex-row justify-content-between gap-2">
                        <div class="item text-center">
                            <p class="bg-danger p-3 m-1 text-white rounded">$remaining_day</p>
                            <p class="mb-0">Day(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-danger p-3 m-1 text-white rounded">$remaining_hour</p>
                            <p class="mb-0">Hour(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-danger p-3 m-1 text-white rounded">$remaining_min</p>
                            <p class="mb-0">Minute(s)</p>
                        </div>
                        <div class="item text-center">
                            <p class="bg-danger p-3 m-1 text-white rounded">$remaining_sec</p>
                            <p class="mb-0">Second(s)</p>
                        </div>
                    </div>
                </div>
               TEXT;
            }
        } else {
            $this->countdown = <<<TEXT
            <div class="alert alert-success m-1">
                <h5 class="alert-heading text-center">The project is completed successfully.</h5>
            </div>
           TEXT;
        }
    }

    public function startProject() 
    {
        $this->project->status = 2;
        $this->project->save();
        session()->flash('message', 'Project started successfully.');
    }
}
