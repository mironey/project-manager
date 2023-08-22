<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{$assignment->name}}</h3>
                        <p>{{$assignment->description}}</p>
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
                                    <td>{{$assignment->due_date}}</td>
                                    <td>{{activityStatus($assignment->status)}}</td>
                                    <td><a href="">{{$assignment->user->name}}</a></td>
                                    <th>
                                    @hasanyrole('super-admin|admin')
                                        <a href="{{route('admin.assignment.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasanyrole
                                    @hasrole('manager')
                                        <a href="{{route('manager.assignment.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole    
                                    @hasrole('supervisor')
                                    <a href="{{route('supervisor.assignment.edit', ['projectId' => $projectId, 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole    
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
