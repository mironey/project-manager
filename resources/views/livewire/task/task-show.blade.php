<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{$task->name}}</h3>
                        <p>{{$task->description}}</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$task->due_date}}</td>
                                    <td>{{activityStatus($task->status)}}</td>
                                    <td><a href="">{{$task->user->name}}</a></td>
                                    <th>
                                    @hasanyrole('super-admin|admin')
                                        <a href="{{route('admin.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasanyrole
                                    @hasrole('manager')
                                        <a href="{{route('manager.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole    
                                    @hasrole('member')
                                        <a href="">Start Now</a>
                                    @endhasrole    
                                    </th>
                                </tr>
                            </tbody>
                        </table>
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
                                    @if($assignment->status == 0)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">List group item heading</h5>
                                        <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">Some placeholder content in a paragraph.</p>
                                        <small>And some small print.</small>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="list-group flex-fill">
                                <div class="text-center shadow-sm p-2 bg-body rounded"><h5 class="fw-bold text-primary">In Progress</h5></div>
                                @foreach($assignments as $assignment)
                                    @if($assignment->status == 1)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">List group item heading</h5>
                                        <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">Some placeholder content in a paragraph.</p>
                                        <small>And some small print.</small>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="list-group flex-fill">
                                <div class="text-center shadow-sm p-2 bg-body rounded"><h5 class="fw-bold text-success">Completed</h5></div>
                                @foreach($assignments as $assignment)
                                    @if($assignment->status == 2)
                                    <a href="{{route('supervisor.assignment.show', ['projectId' => $task->project_id, 'taskId' => $task->id, 'assignmentId' => $assignment->id])}}" class="list-group-item list-group-item-action list-group-item-success">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">List group item heading</h5>
                                        <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">Some placeholder content in a paragraph.</p>
                                        <small>And some small print.</small>
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
