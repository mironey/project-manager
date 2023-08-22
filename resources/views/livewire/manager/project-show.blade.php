<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{$project->name}}</h3>
                        <p>{{$project->description}}</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$project->start_date}}</td>
                                    <td>{{$project->end_date}}</td>
                                    <td>{{activityStatus($project->status)}}</td>
                                    <td>Start Now</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <h4>{{ __('Task List') }}</h4>
                            <p>This package allows for users to be associated with permissions and roles.</p>
                        </div>
                        <div>
                            <a class="btn btn-primary" href="{{route('manager.task.create', $project->id)}}">{{ __('Add Task') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ol class="list-group list-group-numbered">
                            @foreach($project->tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{$task->name}}</div>
                                    {{$task->description}}
                                    <div class="d-flex flex-row justify-content-between">
                                        <p><strong>Due date:</strong> {{$task->due_date}}</p>
                                        <p><strong>Priority:</strong> {{$task->priority}}</p>
                                        <p><strong>Assigned to:</strong> {{$task->user->name}}</p>
                                    </div>
                                    <div class="d-inline-flex">
                                        <a href="{{route('manager.task.show', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" 
                                        class="mx-2">View</a>
                                        <a href="{{route('manager.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a>
                                        <a href="" class="mx-2">Delete</a>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill">In Progress</span>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
