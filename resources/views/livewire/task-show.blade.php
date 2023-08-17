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
                                    <th><a href="{{route('task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
