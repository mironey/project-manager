<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <h3>Project name:</h3>
                            <p>{{$project->name}}</p>
                            <span class="badge bg-primary">{{activityStatus($project->status)}}</span>
                        </div>
                        <div wire:poll.3000ms='timeRemaining'>
                            {!! $countdown !!}
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$project->start_date}}</td>
                                    <td>{{$project->end_date}}</td>
                                    <td>{{activityStatus($project->status)}}</td>
                                    <td><a href="">{{$project->user->name}}</a></td>
                                    <th>
                                    @hasanyrole('super-admin|admin')
                                    <a href="{{route('admin.project.edit', $project->id)}}">Edit</a> | <a href="">Delete</a>
                                    @endhasanyrole
                                    @hasrole('manager')
                                        @if($project->status == 1)
                                            <form wire:submit.prevent="startProject">
                                                @csrf
                                                <button onclick="return confirm('Are you sure to start now ?')" class="p-0 m-0 border-0 text-primary fw-bold">Start Now</button>
                                            </form>
                                        @elseif($project->status == 2)
                                            <a href="{{route('manager.project.submit', $project->id)}}" class="mx-2">Deliver now</a>
                                        @elseif($project->status == 3)
                                            <a href="{{route('manager.project.submit', $project->id)}}" class="mx-2">Deliver again</a>
                                        @else 
                                            Project completed
                                        @endif
                                    @endhasrole 
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-instruction">
                            <h5 class="border-bottom">Requirement:</h5>
                            <p class="text-start">{{$project->description}}</p>
                            <div class="card text-center">
                                <div class="card-body">
                                    <p class="card-text">There have some attached file which you may need to use to complete this project.</p>
                                    <a href="#" class="btn btn-outline-primary">Download File one</a>
                                    <a href="#" class="btn btn-outline-primary">Download File two</a>
                                    <a href="#" class="btn btn-outline-primary">Download File three</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid d-flex gap-2 justify-content-center my-3">
                    @hasanyrole('super-admin|admin')
                    <a class="btn btn-primary col-3" href="{{route('admin.task.create', $project->id)}}">{{ __('Add new task') }}</a>
                    @endhasanyrole
                    @hasrole('manager')
                    <a class="btn btn-primary col-3" href="{{route('manager.task.create', $project->id)}}">{{ __('Add new task') }}</a>
                    @endhasrole

                    @if(!empty($task))
                    <a href="{{route('admin.task.index', $project->id)}}" class="btn btn-primary col-3">View ongoing tasks</a>
                    @endif

                    @if(!empty($project->delivered_files))
                    <a href="{{route('admin.project.delivery', $project->id)}}" class="btn btn-primary col-3">View delivery project</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
