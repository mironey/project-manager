<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <h3>Welcome to {{Auth::user()->name}}</h3>
                <div class="card">
                    <div class="card-header">
                        <div>{{ __('All Task') }}</div>
                    </div>
                    <div class="card-body">
                        @foreach($tasks as $task)
                        <table class="table table-success table-striped">
                            <thead class="table-light">
                                <tr><th colspan="5" class="text-center">Project Name: {{$task->project->name}}</th></tr>
                                <tr class="table-active">
                                    <th>#</th>
                                    <th>Task Name</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$task->name}}</td>
                                    <td>{{$task->description}}</td>
                                    <td>{{$task->due_date}}</td>
                                    <th>
                                    <a href="{{route('supervisor.task.show', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" 
                                        class="mx-2">View</a>  
                                    </th>
                                </tr>
                            </tbody>
                        </table>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


