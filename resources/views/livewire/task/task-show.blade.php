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
                            <h3>Task name:</h3>
                            <p>{{$task->name}}</p>
                        </div>
                        <div>
                            <span class="badge bg-primary">{{activityStatus($task->status)}}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Due Date</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$task->due_date}}</td>
                                    <td><a href="">{{$task->user->name}}</a></td>
                                    <th>
                                    @hasanyrole('super-admin|admin')
                                        <a href="{{route('admin.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasanyrole
                                    @hasrole('manager')
                                        <a href="{{route('manager.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole
                                    @hasrole('supervisor')
                                        @if($task->status == 1)
                                            <form wire:submit.prevent="startTask">
                                                @csrf
                                                <button onclick="return confirm('Are you sure to start now ?')" class="p-0 m-0 border-0 text-primary fw-bold">Start Now</button>
                                            </form>
                                        @elseif($task->status == 2)
                                            <a href="{{route('supervisor.task.submit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Deliver now</a>
                                        @elseif($task->status == 3)
                                            <a href="{{route('supervisor.task.submit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Deliver again</a>
                                        @else 
                                            Task completed
                                        @endif
                                    @endhasrole 
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-instruction">
                            <h5 class="border-bottom">Requirement:</h5>
                            <p class="text-start">{{$task->description}}</p>
                            <div class="card text-center">
                                <div class="card-body">
                                    <p class="card-text">There have some attached file which you need to use to complete the task.</p>
                                    <a href="#" class="btn btn-primary">Download File one</a>
                                    <a href="#" class="btn btn-primary">Download File two</a>
                                    <a href="#" class="btn btn-primary">Download File three</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Delivered files</h4>
                    </div>
                    <div class="card-body">
                        <div class="assignment-part bg-body-secondary my-2">
                            <div class="card-header fw-bold">
                            Instruction
                            </div>
                            <div class="card-body">
                                @if( !empty($task->related_comment) || !empty($task->delivered_files) )
                                    <p class="card-text">{{$task->related_comment}}</p>
                                    @php 
                                        $filesArray = unserialize($task->delivered_files); 
                                    @endphp
                                    @foreach($filesArray as $file)
                                        <p><span class="fw-semibold">File:</span> <a href="{{asset($file)}}">{{$file}}</a></p>
                                    @endforeach
                                @else
                                Task not started yet.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <h4>{{ __('Assignment List') }}</h4>
                            <p>This package allows for users to be associated with permissions and roles.</p>
                        </div>
                        <div>
                            @hasanyrole('super-admin|admin')
                            <a class="btn btn-primary" href="{{route('admin.assignment.create', ['projectId' => $task->project_id, 'taskId' => $task->id])}}">{{ __('Add Assignment') }}</a>
                            @endhasanyrole
                            @hasrole('manager')
                            <a class="btn btn-primary" href="{{route('manager.assignment.create', ['projectId' => $task->project_id, 'taskId' => $task->id])}}">{{ __('Add Assignment') }}</a>
                            @endhasrole
                            @hasrole('supervisor')
                            <a class="btn btn-primary" href="{{route('supervisor.assignment.create', ['projectId' => $task->project_id, 'taskId' => $task->id])}}">{{ __('Add Assignment') }}</a>
                            @endhasrole
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between gap-3">
                            <div class="list-group flex-fill">
                                <div class="text-center shadow-sm p-2 bg-body rounded"><h5 class="fw-bold text-danger">Not Started</h5></div>
                                @foreach($assignments as $assignment)
                                    @if($assignment->status == 1)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$assignment->name}}</h5>
                                        <small class="text-danger-emphasis fw-semibold">Priority: {{$assignment->priority}}</small>
                                        </div>
                                        <p class="mb-1">{{textExcerpt($assignment->description)}}</p>
                                        <small>Assigned member: {{$assignment->user->name}}</small>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="list-group flex-fill">
                                <div class="text-center shadow-sm p-2 bg-body rounded"><h5 class="fw-bold text-primary">In Progress</h5></div>
                                @foreach($assignments as $assignment)
                                    @if($assignment->status == 2)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$assignment->name}}</h5>
                                        <small class="text-danger-emphasis fw-semibold">Priority: {{$assignment->priority}}</small>
                                        </div>
                                        <p class="mb-1">{{textExcerpt($assignment->description)}}</p>
                                        <small>Assigned member: {{$assignment->user->name}}</small>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="list-group flex-fill">
                                <div class="text-center shadow-sm p-2 bg-body rounded"><h5 class="fw-bold text-primary">Modification</h5></div>
                                @foreach($assignments as $assignment)
                                    @if($assignment->status == 3)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$assignment->name}}</h5>
                                        <small class="text-danger-emphasis fw-semibold">Priority: {{$assignment->priority}}</small>
                                        </div>
                                        <p class="mb-1">{{textExcerpt($assignment->description)}}</p>
                                        <small>Assigned member: {{$assignment->user->name}}</small>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="list-group flex-fill">
                                <div class="text-center shadow-sm p-2 bg-body rounded"><h5 class="fw-bold text-success">Completed</h5></div>
                                @foreach($assignments as $assignment)
                                    @if($assignment->status == 4)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action list-group-item-success">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{$assignment->name}}</h5>
                                            <small class="text-danger-emphasis fw-semibold">Priority: {{$assignment->priority}}</small>
                                        </div>
                                        <p class="mb-1">{{textExcerpt($assignment->description)}}</p>
                                        <small>Assigned member: {{$assignment->user->name}}</small>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
